# Teacher Registration Application

A simple full-stack Laravel application that allows teachers to register for an account with their personal information and subjects taught.

## Features

- **Single-Page Registration Form** with a modern, user-friendly interface
- **Form Fields:**
  - First Name
  - Last Name
  - Email
  - Subjects Taught (multiple selections allowed)
- **Validation and Error Handling:** Comprehensive form validation with clear, user-friendly error messages
- **Backend API:** RESTful API endpoint for form submissions
- **Docker Support:** Complete containerization setup for easy deployment

## Technology Stack

- **Backend:** PHP 8.2 with Laravel 10
- **Frontend:** Laravel Blade Templates with modern CSS
- **Database:** MySQL 8.0
- **Web Server:** Nginx
- **Containerization:** Docker & Docker Compose

## Prerequisites

- Docker and Docker Compose installed on your system
- Git (optional, for cloning)

## Installation & Setup

### Using Docker (Recommended)

1. **Clone or extract the project:**
   ```bash
   cd teacher-registration-app
   ```

2. **Copy the environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Update the `.env` file with your database configuration:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=teacher_registration
   DB_USERNAME=root
   DB_PASSWORD=root
   APP_URL=http://localhost:8000
   ```

4. **Build and start the Docker containers:**
   ```bash
   docker-compose up -d --build
   ```

5. **Install PHP dependencies:**
   ```bash
   docker-compose exec app composer install
   ```

6. **Generate application key:**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

7. **Run database migrations:**
   ```bash
   docker-compose exec app php artisan migrate
   ```

8. **Set proper permissions:**
   ```bash
   docker-compose exec app chmod -R 775 storage bootstrap/cache
   docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
   ```

### Local Setup (Without Docker)

1. **Install PHP dependencies:**
   ```bash
   composer install
   ```

2. **Copy environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

4. **Configure your database in `.env` file**

5. **Run migrations:**
   ```bash
   php artisan migrate
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage

### Web Interface

Once the application is running, navigate to:
- **With Docker:** http://localhost:8000
- **Local:** http://localhost:8000 (or the port specified by `php artisan serve`)

Fill out the registration form with:
- First Name
- Last Name
- Email (must be unique)
- At least one subject from the available options

### API Endpoint

You can also register teachers via the API:

**Endpoint:** `POST /api/teachers/register`

**Request Body:**
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    "subjects": ["Mathematics", "Science", "Computer Science"]
}
```

**Success Response (201):**
```json
{
    "success": true,
    "message": "Registration successful!",
    "data": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "subjects": ["Mathematics", "Science", "Computer Science"]
    }
}
```

**Error Response (422):**
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "email": ["This email is already registered."],
        "subjects": ["Please select at least one subject."]
    }
}
```

## Project Structure

```
teacher-registration-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── TeacherRegistrationApiController.php
│   │   │   └── TeacherRegistrationController.php
│   │   └── Middleware/
│   ├── Models/
│   │   └── Teacher.php
│   └── Providers/
├── config/
├── database/
│   └── migrations/
│       └── 2024_01_01_000001_create_teachers_table.php
├── docker/
│   ├── nginx/
│   └── php/
├── public/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── registration.blade.php
├── routes/
│   ├── api.php
│   └── web.php
├── .env.example
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## Validation Rules

- **First Name:** Required, string, max 255 characters
- **Last Name:** Required, string, max 255 characters
- **Email:** Required, valid email format, unique, max 255 characters
- **Subjects:** Required, array with at least one subject selected

## Docker Commands

- **Start containers:** `docker-compose up -d`
- **Stop containers:** `docker-compose down`
- **View logs:** `docker-compose logs -f`
- **Execute commands in app container:** `docker-compose exec app <command>`
- **Rebuild containers:** `docker-compose up -d --build`

## Security Features

- CSRF protection for web forms
- Input validation and sanitization
- SQL injection prevention (using Eloquent ORM)
- XSS protection (Blade templating engine)
- Secure password handling (if authentication is added)

## Testing

To run tests (when implemented):
```bash
docker-compose exec app php artisan test
```

## Troubleshooting

### Database Connection Issues
- Ensure the database container is running: `docker-compose ps`
- Check database credentials in `.env` file
- Verify database service is accessible: `docker-compose exec db mysql -u root -p`

### Permission Issues
- Run: `docker-compose exec app chmod -R 775 storage bootstrap/cache`
- Run: `docker-compose exec app chown -R www-data:www-data storage bootstrap/cache`

### Port Already in Use
- Change the port mapping in `docker-compose.yml` (e.g., `"8001:80"`)

## License

MIT License

## Author

Created as a technical assignment demonstrating full-stack development capabilities with Laravel.

