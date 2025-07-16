# AppointEase

A web application for booking appointments with doctors built with Laravel 10.

## Features

- Doctor management system
- Patient registration and management
- Appointment scheduling
- Transaction tracking
- User authentication with Laravel Fortify
- Responsive design with Tailwind CSS

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL/PostgreSQL

## Installation

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install Node.js dependencies:
   ```bash
   npm install
   ```
4. Copy environment file:
   ```bash
   cp .env.example .env
   ```
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Configure database in `.env` file
7. Run migrations:
   ```bash
   php artisan migrate
   ```
8. Build assets:
   ```bash
   npm run build
   ```

## Development

Start the development server:
```bash
php artisan serve
```

For asset compilation during development:
```bash
npm run dev
```

## Tech Stack

- **Backend**: Laravel 10, PHP 8.1+
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL/PostgreSQL
- **Build Tool**: Vite
