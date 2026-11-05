document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const accountToggle = document.getElementById('accountToggle');
    const accountDropdown = document.getElementById('accountDropdown');

    menuToggle?.addEventListener('click', () => sidebar?.classList.toggle('open'));
    accountToggle?.addEventListener('click', (event) => {
        event.stopPropagation();
        accountDropdown?.classList.toggle('open');
    });
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.account-menu')) accountDropdown?.classList.remove('open');
        if (window.innerWidth <= 760 && sidebar?.classList.contains('open') &&
            !event.target.closest('.sidebar') && !event.target.closest('#menuToggle')) sidebar.classList.remove('open');
    });

    // Modal elegante de confirmação: o formulário só é enviado após confirmação.
    const modal = document.getElementById('confirmModal');
    const modalMessage = document.getElementById('confirmMessage');
    const cancelDelete = document.getElementById('cancelDelete');
    const acceptDelete = document.getElementById('acceptDelete');
    let pendingForm = null;
    document.querySelectorAll('form[data-confirm]').forEach(form => {
        form.addEventListener('submit', event => {
            if (form.dataset.confirmed === 'true') return;
            event.preventDefault();
            pendingForm = form;
            if (modal) {
                modalMessage.textContent = form.dataset.confirm || 'Tem certeza de que deseja excluir este registro?';
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
                cancelDelete?.focus();
            } else if (window.confirm(form.dataset.confirm || 'Tem certeza?')) {
                form.dataset.confirmed = 'true'; form.submit();
            }
        });
    });
    const closeModal = () => {
        modal?.classList.remove('open'); modal?.setAttribute('aria-hidden', 'true'); pendingForm = null;
    };
    cancelDelete?.addEventListener('click', closeModal);
    modal?.addEventListener('click', event => { if (event.target === modal) closeModal(); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && modal?.classList.contains('open')) closeModal(); });
    acceptDelete?.addEventListener('click', () => {
        if (!pendingForm) return;
        const form = pendingForm; form.dataset.confirmed = 'true';
        acceptDelete.disabled = true; acceptDelete.textContent = 'Excluindo...';
        form.submit();
    });

    // Exibe os erros enviados pelo Laravel diretamente abaixo do campo correspondente.
    const errorsElement = document.getElementById('validation-errors');
    let serverErrors = {};
    try { serverErrors = JSON.parse(errorsElement?.dataset.errors || '{}'); } catch (_) { serverErrors = {}; }

    function wrapperFor(field) { return field.closest('.field, .admin-field, .form-group') || field.parentElement; }
    function clearError(field) {
        const wrapper = wrapperFor(field);
        wrapper?.classList.remove('has-error');
        wrapper?.querySelector('.field-error')?.remove();
        field.removeAttribute('aria-invalid');
    }
    function showError(field, message) {
        if (!field || !message) return;
        clearError(field);
        const wrapper = wrapperFor(field);
        wrapper?.classList.add('has-error');
        field.setAttribute('aria-invalid', 'true');
        const note = document.createElement('small'); note.className = 'field-error'; note.textContent = message;
        wrapper?.appendChild(note);
    }
    Object.entries(serverErrors).forEach(([name, messages]) => {
        const field = document.querySelector(`[name="${CSS.escape(name)}"]`);
        if (field) showError(field, messages[0]);
    });

    document.querySelectorAll('form:not([data-confirm])').forEach(form => {
        // Usa mensagens próprias em vez dos balões padrão do navegador.
        if (form.querySelector('[required]')) form.setAttribute('novalidate', 'novalidate');
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', () => clearError(field));
            field.addEventListener('change', () => clearError(field));
        });
        form.addEventListener('submit', event => {
            let firstInvalid = null;
            form.querySelectorAll('[required]').forEach(field => {
                let message = '';
                if (!String(field.value || '').trim()) message = 'Este campo é obrigatório. Preencha para continuar.';
                else if (field.type === 'email' && !field.validity.valid) message = 'Digite um endereço de e-mail válido.';
                else if (field.type === 'date') {
                    if (!/^\d{4}-\d{2}-\d{2}$/.test(field.value) || !field.validity.valid) message = 'Escolha uma data válida no calendário.';
                    else if (field.min && field.value < field.min) message = 'A data não pode ser anterior a hoje.';
                } else if (field.type === 'time' && !/^([01]\d|2[0-3]):[0-5]\d$/.test(field.value)) {
                    message = 'Informe um horário válido no formato HH:MM.';
                } else if (field.name === 'password' && field.value.length < 8) message = 'A senha deve ter pelo menos 8 caracteres.';
                else if (field.name === 'password_confirmation') {
                    const password = form.querySelector('[name="password"]');
                    if (password && field.value !== password.value) message = 'As senhas não coincidem. Confira os dois campos.';
                }
                if (message) { showError(field, message); if (!firstInvalid) firstInvalid = field; }
                else if (!serverErrors[field.name]) clearError(field);
            });
            if (firstInvalid) { event.preventDefault(); firstInvalid.focus(); }
        });
    });

    // Mostra apenas os endereços pertencentes ao cliente selecionado.
    const clienteSelect = document.getElementById('clienteSelect');
    const enderecoSelect = document.getElementById('enderecoSelect');
    function filtrarEnderecos() {
        if (!clienteSelect || !enderecoSelect) return;
        const clienteId = clienteSelect.value;
        Array.from(enderecoSelect.options).forEach((option, index) => {
            if (index === 0) return;
            option.hidden = Boolean(clienteId) && option.dataset.cliente !== clienteId;
            option.disabled = option.hidden;
        });
        const selected = enderecoSelect.selectedOptions[0];
        if (selected && selected.disabled) enderecoSelect.value = '';
    }
    clienteSelect?.addEventListener('change', filtrarEnderecos); filtrarEnderecos();
    document.querySelectorAll('input[name="estado"]').forEach(input => {
        input.addEventListener('input', () => input.value = input.value.toUpperCase());
    });
});
