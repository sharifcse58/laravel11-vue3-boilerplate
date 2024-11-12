# Laravel 11 + Vue 3 Boilerplate

This project is a full-featured boilerplate for Laravel 11 and Vue 3, built to support both session-based and token-based (API) authentication using Laravel Sanctum. It includes role-based access control, profile management, CI/CD, and more. This boilerplate can be used for web applications that require flexibility for both web and mobile app integrations.

## Features

-   **Login System**: Supports session-based and API-based authentication with secure token handling via Sanctum.
-   **Registration System**: Includes both session-based and API-based workflows, multiple select fields, and user details.
-   **Role-Based Access Control**: Automatically assigns the "user" role upon registration. Routes restricted to the "admin" role.
-   **Profile Management**: Profile editing component for personal detail updates, handled via a dedicated API.
-   **Authentication Middleware**: Ensures unauthorized users cannot access restricted routes post-logout.
-   **Logout Functionality**: Secure logout method with token deletion and session clearing.
-   **Vue 3 Component-Based Structure**: Each feature (login, registration, etc.) is encapsulated in Vue 3 components for modularity.
-   **Seeders and Initial Settings**: Includes seeders for initial roles, an admin user, and basic settings.

-   **GitHub CI/CD Integration**: Configured for CI/CD using GitHub Actions. [View the CI/CD workflow](https://github.com/sharifcse58/laravel11-vue3-boilerplate/blob/master/.github/workflows/deploy.yml)

## Getting Started

These instructions will help you set up the project locally.

### Prerequisites

-   PHP (>= 8.1)
-   Node.js (>= 16)
-   Composer
-   NPM or Yarn
-   MySQL or another supported database

### Installation

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/sharifcse58/laravel11-vue3-boilerplate.git
    cd laravel11-vue3-boilerplate
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    npm run dev
    php artisan serve
    ```

## API Endpoints

-   **Login:** `POST /api/login` - User login (API-based)
-   **Register:** `POST /api/register` - User registration (API-based)
-   **Get User Profile:** `GET /api/user` - Fetch authenticated user profile
-   **Logout:** `POST /api/logout` - User logout

### Session-Based Endpoints

The application also provides session-based routes accessible through web routes.

### Role-Based Access Control

The app includes routes restricted to the "admin" role:

-   **Admin-only routes** are grouped under middleware to prevent unauthorized access.
-   **Example:** `/dashboard/admin` route is accessible only to users with the "admin" role.

### Seeders

The project includes seeders to set up roles and an initial admin user:

-   **Roles Table Seeder:** Creates "admin" and "user" roles.
-   **Admin User Seeder:** Sets up an initial admin user with the "admin" role.

### Project Structure

-   **Backend:** Laravel 11 with Sanctum for authentication.
-   **Frontend:** Vue 3 components for each feature (login, registration, profile edit).
-   **Database:** MySQL (or other configured database).
