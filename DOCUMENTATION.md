
# **Documentação Completa do Sistema de Pizzaria API**

## **Introdução**

Este documento descreve o funcionamento do sistema de API para uma pizzaria, explica o fluxo completo de uso, além de detalhes importantes para garantir o correto funcionamento da aplicação. O sistema foi desenvolvido utilizando **Laravel** com **Passport** para autenticação com **JWT**, incluindo mecanismos de log, tratamento de erros e validações.

## **Pré-requisitos**

### 1. Instalação do PHP
Antes de tudo, verifique se você tem o PHP instalado. Use o comando:

```bash
php -v
```

Se não estiver instalado, siga as instruções do [site oficial do PHP](https://www.php.net/downloads) para instalar a versão mais recente.

### 2. Instalação do Composer
O Composer é necessário para gerenciar as dependências do Laravel. Verifique se o Composer está instalado com:

```bash
composer -v
```

Se não estiver, baixe-o [aqui](https://getcomposer.org/download/).

### 3. Instalação do Laravel
Para instalar o Laravel globalmente, execute:

```bash
composer global require laravel/installer
```

Verifique se a instalação foi bem-sucedida com o comando:

```bash
laravel --version
```

### 4. Instalação da extensão do PHP no VS Code
Abra o VS Code e instale a extensão de PHP para facilitar o desenvolvimento e depuração.

- Vá para a aba de extensões (ícone de quadrados na barra lateral).
- Busque por "PHP Extension Pack" e instale.

### **5. Instalação do Projeto**
Após clonar o repositório, navegue até a pasta do projeto e instale as dependências do Composer:

```bash
composer install
```

### **6. Configuração do `.env`**
O arquivo `.env` deve conter as seguintes informações ajustadas conforme seu ambiente:

```plaintext
APP_NAME="Sistema de Pizzaria"
APP_ENV=local
APP_KEY=base64:chave_gerada_pelo_artisan_key_generate
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_pizzaria
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

PASSPORT_CLIENT_ID=seu_client_id
PASSPORT_CLIENT_SECRET=sua_client_secret
JWT_SECRET=sua_jwt_secret
```

### **7. Gerando o JWT_SECRET**
Para gerar o JWT secret, execute o comando abaixo:

```bash
php artisan jwt:secret
```
Isso irá adicionar a chave `JWT_SECRET` ao seu arquivo `.env`.

### **8. Gerar o `APP_KEY`**
Caso o `APP_KEY` ainda não esteja definido no `.env`, execute o comando:

```bash
php artisan key:generate
```

### **9. Executando as Migrações**
Agora, com o banco de dados configurado, rode as migrações:

```bash
php artisan migrate
```

### **10. Criando o Passport Client**
O Laravel Passport requer que você crie um client para autenticação. Para criar o client, execute:

```bash
php artisan passport:install
```

Após criar o client, copie o `client_id` e `client_secret` gerados e adicione-os ao seu arquivo `.env` nas seguintes variáveis:

```plaintext
PASSPORT_CLIENT_ID=client_id_gerado
PASSPORT_CLIENT_SECRET=client_secret_gerado
```

### **11. Limpar e Otimizar o Cache**
Para garantir que não haja conflitos ou informações em cache que possam causar problemas, execute os seguintes comandos para limpar e otimizar o sistema:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

Esses comandos garantem que o cache do sistema seja limpo e que todas as alterações feitas sejam aplicadas corretamente.

---

## **Listagem de Rotas e Explicação**

### **Rota de Teste**
- **Rota:** `GET /api/test`
- **Descrição:** Esta rota é usada para testar o servidor e garantir que ele esteja funcionando corretamente. Retorna um simples JSON com status `ok`.

---

### **Rotas de Autenticação (Públicas)**

#### **Login**
- **Rota:** `POST /api/public/login`
- **Descrição:** Realiza o login de um usuário com base nas credenciais (email e senha). Se autenticado com sucesso, retorna um token JWT.
  
Exemplo de body (JSON):
```json
{
  "email": "admin@example.com",
  "password": "Admin@123"
}
```

#### **Cadastro de Usuário**
- **Rota:** `POST /api/public/cadastrar`
- **Descrição:** Realiza o cadastro de um novo usuário. É necessário fornecer nome, email, senha e a confirmação da senha.

Exemplo de body (JSON):
```json
{
  "name": "Admin",
  "email": "admin@example.com",
  "password": "Admin@123",
  "password_confirmation": "Admin@123"
}
```

**Atenção:** A senha deve atender às seguintes regras:
- No mínimo 8 caracteres.
- Deve conter letras maiúsculas e minúsculas, números e símbolos.

---

### **Rotas Protegidas (Necessário Token de Autenticação)**

#### **Logout**
- **Rota:** `POST /api/logout`
- **Descrição:** Realiza o logout do usuário e revoga o token JWT.
  
#### **Listar Usuários**
- **Rota:** `GET /api/user`
- **Descrição:** Retorna uma lista de usuários cadastrados no sistema.

#### **Visualizar Usuário**
- **Rota:** `GET /api/user/visualizar/{id}`
- **Descrição:** Retorna os detalhes de um usuário específico com base no ID.

#### **Atualizar Usuário**
- **Rota:** `PUT /api/user/atualizar/{id}`
- **Descrição:** Atualiza os dados de um usuário.

Exemplo de body (JSON):
```json
{
  "name": "Novo Nome",
  "email": "novoemail@example.com",
  "password": "NewPass@123",
  "password_confirmation": "NewPass@123"
}
```

#### **Deletar Usuário**
- **Rota:** `DELETE /api/user/deletar/{id}`
- **Descrição:** Deleta um usuário específico com base no ID.

---

### **Rotas Relacionadas a Pizzas**

#### **Listar Pizzas (Pública)**
- **Rota:** `GET /api/pizza`
- **Descrição:** Retorna uma lista de pizzas cadastradas no sistema. Esta rota é pública, qualquer usuário pode acessá-la.

#### **Cadastrar Pizza (Protegida)**
- **Rota:** `POST /api/pizza/cadastrar`
- **Descrição:** Cadastra uma nova pizza no sistema.

Exemplo de body (JSON):
```json
{
  "name": "Pizza Margherita",
  "description": "Pizza com molho de tomate e queijo",
  "size": "médio",
  "format": "redonda",
  "price": 25.00
}
```

**Atenção:** O campo `price` deve ser um valor numérico (exemplo: 25.00). Qualquer valor fora desse padrão será rejeitado pela validação.

#### **Visualizar Pizza (Pública)**
- **Rota:** `GET /api/pizza/visualizar/{id}`
- **Descrição:** Retorna os detalhes de uma pizza específica com base no ID.

#### **Atualizar Pizza (Protegida)**
- **Rota:** `PUT /api/pizza/atualizar/{id}`
- **Descrição:** Atualiza as informações de uma pizza existente.

#### **Deletar Pizza (Protegida)**
- **Rota:** `DELETE /api/pizza/deletar/{id}`
- **Descrição:** Deleta uma pizza do sistema com base no ID.

---

## **Tratamento de Erros e Logs**

O sistema faz uso de blocos `try-catch` para capturar erros e exceções, garantindo que, em caso de falhas, o sistema retorne mensagens apropriadas para o cliente da API e registre os detalhes do erro nos logs.

- **Logs:** São gravados no arquivo `storage/logs/laravel.log`.
- **Exemplo de Log:** Cada vez que um método importante é executado, um log é gerado, como quando um usuário é cadastrado, atualizado ou deletado.
