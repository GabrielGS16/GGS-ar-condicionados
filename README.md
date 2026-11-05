# GGS Ar Condicionados

Sistema administrativo Laravel para cadastro de clientes, endereços e agendamentos de instalação/manutenção de ar-condicionado.

## Requisitos
- PHP compatível com a versão do Laravel instalada (Laravel 11/12)
- Composer
- MySQL
- Node.js/NPM (opcional para assets adicionais)

## Instalação

Crie um projeto Laravel e copie os arquivos desta estrutura para dentro dele:

```bash
composer create-project laravel/laravel ggs-ar-condicionados
cd ggs-ar-condicionados
```

Extraia/copie os arquivos deste pacote mantendo os caminhos e substituindo os arquivos quando solicitado.

Configure o banco no arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ggs_ar_condicionados
DB_USERNAME=root
DB_PASSWORD=
```

Crie o banco `ggs_ar_condicionados` no MySQL/phpMyAdmin. Depois execute:

```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Abra `http://127.0.0.1:8000`.

## Funcionalidades incluídas
- Dashboard com indicadores e últimos agendamentos.
- CRUD de clientes.
- CRUD de endereços vinculados a clientes.
- CRUD de agendamentos.
- Serviços iniciais criados pelo seeder.
- Validação dos formulários no backend.
- Proteção contra exclusão de clientes/endereços que tenham agendamentos vinculados.
- Interface responsiva com menu lateral, barra superior, menu de conta e rodapé.
- Login administrativo com sessão segura e opção de manter conectado.
- Cadastro do primeiro administrador no primeiro acesso.
- Cadastro de novos administradores somente por um administrador já autenticado.
- Rotas do painel protegidas por autenticação.

## Observações importantes
- Os preços dos serviços começam em R$ 0,00 e devem ser configurados conforme a política comercial da empresa.
- O primeiro administrador deve ser criado em `/primeiro-acesso` após executar as migrations. Depois disso, essa tela é bloqueada automaticamente. Para cadastrar outros administradores, entre no painel e use “Cadastrar administrador” no menu lateral.
- O sistema usa a tabela `users` padrão do Laravel e adiciona a coluna `is_admin`. Contas comuns não recebem acesso ao painel.
- Antes de publicar, configure HTTPS, backups e política de senhas. A criação de administradores deve permanecer restrita.
- Esta versão é um painel administrativo. Para receber agendamentos diretamente do público, o próximo passo é criar uma página pública de solicitação e um fluxo de confirmação pela empresa.
- Não publique em produção sem configurar autenticação, HTTPS, backups e proteção contra spam.
