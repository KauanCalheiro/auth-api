# API de Autenticação

---

## Como Iniciar o Projeto

1. Certifique-se de ter o PHP (>= 8.3), Composer e um banco de dados relacional de sua escolha (como MySQL, PostgreSQL ou SQLite) instalados em sua máquina.

2. Clone o repositório do projeto:

   ```bash
   git clone https://github.com/KauanCalheiro/auth-api.git
   ```

3. Acesse o diretório do projeto:

   ```bash
   cd auth-api
   ```

4. Instale as dependências do Composer:

   ```bash
   composer install
   ```

5. Copie o arquivo `.env.example` para `.env`:

   ```bash
   cp .env.example .env
   ```

6. Configure o arquivo `.env` com as credenciais do banco de dados.

7. Gere a chave da aplicação:

   ```bash
   php artisan key:generate
   ```

8. Execute as migrations para configurar o banco de dados:

   ```bash
   php artisan migrate
   ```

9. Inicie o servidor local:

   ```bash
   php artisan serve
   ```

10. Acesse a aplicação em seu navegador em `http://127.0.0.1:8000`.

---

## Importando a Collection no Postman

1. Certifique-se de ter o [Postman](https://www.postman.com/) instalado.
2. Na raiz do projeto, você encontrará um arquivo chamado `Auth.postman_collection.json`.
3. Abra o Postman e siga os passos:
   - Clique em **Importar**.
   - Selecione o arquivo `Auth.postman_collection.json`.
   - Clique em **Importar**.
4. A collection será adicionada ao seu Postman, com todos os endpoints configurados.

---

## Endpoints Disponíveis

### 1. Login

**URL:** `{{URL}}/auth/login`

**Método:** `POST`

**Headers:**

- `Accept: application/json`

**Body:**

```json
{
  "email": "seuemail@dominio.com",
  "password": "suasenha",
  "remember_me": false
}
```

<br>

### 2. Logout

**URL:** `{{URL}}/auth/logout`

**Método:** `GET`

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {token}`

<br>

### 3. Registrar Usuário

**URL:** `{{URL}}/auth/register`

**Método:** `POST`

**Headers:**

- `Accept: application/json`

**Body:**

```json
{
  "name": "Nome do Usuário",
  "email": "email@dominio.com",
  "password": "senha",
  "c_password": "senha"
}
```

<br>

### 4. Obter Usuário Autenticado

**URL:** `{{URL}}/auth/user`

**Método:** `GET`

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {token}`





---

## Observações

- Substitua `{{URL}}` pela URL base da sua aplicação.
- Certifique-se de configurar as variáveis de ambiente corretamente no Postman para facilitar os testes.
- A collection disponibiliza exemplos de respostas esperadas para cada endpoint.

