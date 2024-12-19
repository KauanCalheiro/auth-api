# Auth API

---

## How to Start the Project

1. Ensure you have PHP (>= 8.3), Composer, and a relational database of your choice (such as MySQL, PostgreSQL, or SQLite) installed on your machine.

2. Clone the project repository:

   ```bash
   git clone https://github.com/KauanCalheiro/auth-api.git
   ```

3. Navigate to the project directory:

   ```bash
   cd auth-api
   ```

4. Install Composer dependencies:

   ```bash
   composer install
   ```

5. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

6. Configure the `.env` file with your database credentials.

7. Generate the application key:

   ```bash
   php artisan key:generate
   ```

8. Run migrations to set up the database:

   ```bash
   php artisan migrate
   ```

9. Start the local server:

   ```bash
   php artisan serve
   ```

10. Access the application in your browser at `http://127.0.0.1:8000`.

---

## Importing the Collection into Postman

1. Ensure you have [Postman](https://www.postman.com/) installed.
2. In the project root, you will find a file named `Auth.postman_collection.json`.
3. Open Postman and follow these steps:
   - Click on **Import**.
   - Select the `Auth.postman_collection.json` file.
   - Click **Import**.
4. The collection will be added to your Postman, with all endpoints configured.

---

## Available Endpoints

### 1. Login

**URL:** `{{URL}}/auth/login`

**Method:** `POST`

**Headers:**

- `Accept: application/json`

**Body:**

```json
{
  "email": "your-email@domain.com",
  "password": "your-password",
  "remember_me": false
}
```

<br>

### 2. Logout

**URL:** `{{URL}}/auth/logout`

**Method:** `GET`

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {token}`

<br>

### 3. Register User

**URL:** `{{URL}}/auth/register`

**Method:** `POST`

**Headers:**

- `Accept: application/json`

**Body:**

```json
{
  "name": "User Name",
  "email": "email@domain.com",
  "password": "password",
  "c_password": "password"
}
```

<br>

### 4. Get Authenticated User

**URL:** `{{URL}}/auth/user`

**Method:** `GET`

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {token}`

---

## Notes

- Replace `{{URL}}` with the base URL of your application.
- Ensure you configure the environment variables correctly in Postman to facilitate testing.
- The collection provides examples of expected responses for each endpoint.

