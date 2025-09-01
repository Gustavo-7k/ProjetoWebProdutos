# Mini Sistema PHP (Auth + Produtos + Categorias)

Este é um mini sistema em PHP com autenticação e CRUDs de produtos e categorias, usando MySQLi e Bootstrap 5.

## Requisitos
- PHP 8+ (XAMPP/WAMP/MAMP)
- MySQL 5.7+ ou MariaDB

## Instalação
1. Crie o banco e tabelas:
   - Importe o arquivo `schema.sql` no seu MySQL (phpMyAdmin ou CLI).
   - Usuário padrão criado: `admin` / senha: `admin123`.

2. Configure o DocumentRoot
   - Em XAMPP, copie a pasta `projeto_marco` para `C:\\xampp\\htdocs\\projeto_marco`.
   - Acesse: `http://localhost/projeto_marco/auth/login.php`.

3. Configuração de URL base (opcional)
   - Se desejar alterar a subpasta, edite `config/app.php` e ajuste a constante `SITE_BASE`.
   - Exemplo: `define('SITE_BASE', '/projeto_marco');`

4. Configuração do banco
   - Ajuste credenciais em `config/db.php` se necessário (host, usuário, senha, nome).

## Uso
- Faça login com `admin / admin123`.
- Use o menu para gerenciar produtos e categorias.

## Estrutura
- `auth/` login/logout
- `products/` CRUD de produtos
- `categories/` CRUD de categorias
- `includes/` header/footer e guarda de autenticação
- `config/` conexão ao DB e config da aplicação

## Notas
- Todos os acessos (exceto login) exigem autenticação.
- Validação básica no servidor e uso de prepared statements com MySQLi.
- Layout responsivo com Bootstrap 5.
# Mini Sistema (PHP + MySQL)

Pequeno sistema web com autenticação e CRUD de Produtos e Categorias, usando PHP (mysqli) + Bootstrap 5.

## Funcionalidades
- Login de usuário com verificação no banco (tabela `users`).
- Proteção de rotas: todas as páginas (exceto login) exigem autenticação.
- CRUD completo de Categorias (`categorias`).
- CRUD completo de Produtos (`produtos`) com campos: nome, descrição, categoria (select), preço e disponibilidade (radio).
- Layout compartilhado (header/footer) com Bootstrap 5 e partial para campos de produto.

## Requisitos
- PHP 8.x
- MySQL/MariaDB (pode usar XAMPP/Apache + MySQL)

## Instalação
1) Crie o banco e tabelas
- Importe o arquivo `schema.sql` no MySQL (phpMyAdmin ou cliente MySQL). Ele cria o banco `mini_sistema`, tabelas e um usuário padrão:
  - Usuário: `admin`
  - Senha: `admin123`

2) Configure acesso ao banco
- Ajuste as credenciais em `config/db.php` se necessário (host, usuário, senha, porta e nome do DB).

3) Execute o servidor
- Opção A (PHP embutido):
  Abra o PowerShell na pasta do projeto e rode:
  ```powershell
  php -S 127.0.0.1:8080 -t .
  ```
  Depois acesse: http://127.0.0.1:8080/auth/login.php

- Opção B (XAMPP):
  Copie a pasta do projeto para `c:\xampp\htdocs\mini_sistema` e acesse:
  `http://localhost/mini_sistema/auth/login.php`

## Estrutura
- `config/db.php`: conexão ao MySQL.
- `includes/auth.php`: helpers de sessão e guard de autenticação.
- `includes/header.php` e `includes/footer.php`: layout base.
- `auth/login.php` e `auth/logout.php`: autenticação.
- `index.php`: dashboard (protegido por login).
- `categories/*`: CRUD de categorias.
- `products/*`: CRUD de produtos e partial `form_fields.php`.

## Notas
- Senhas são armazenadas com `password_hash`/`password_verify`.
- Exclusão de categoria bloqueia se houver produtos vinculados.
- Ajuste a `timezone` no `php.ini` se necessário para timestamps corretos.

## Credenciais padrão
- Login: `admin`
- Senha: `admin123`

Boa prática: troque a senha do usuário padrão e crie contas adicionais conforme necessário.
