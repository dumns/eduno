# Laravel LMS (Eduno)

## Introduction

Eduno is a Learning Management System (LMS) built with Laravel 10, Livewire 3, Filament, and Tailwind CSS. It features course management, episode streaming, quizzes, and role-based access control.

## Features

- Course & episode management
- Student quizzes and results
- Role & permission management (Spatie)
- Admin panel (Filament)
- Responsive UI (Tailwind CSS)
- Livewire-powered interactivity

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or compatible database

## Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/dumns/eduno
cd eduno
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JS & CSS Dependencies

```bash
npm install
```

### 4. Build Frontend Assets

For development (watch mode):

```bash
npm run dev
```

For production build:

```bash
npm run build
```

### 5. Set Up Environment File

```bash
cp .env.example .env
```

### 6. Configure the Database

Edit `.env` and set your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eduno
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Generate Application Key

```bash
php artisan key:generate
```

### 8. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

### 9. Link Storage

```bash
php artisan storage:link
```

### 10. Start the Development Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

### 11. Test Login (Default Admin)

```
Email: admin@example.com
Password: 12345678
```

## Testing

Run all tests (Pest):

```bash
./vendor/bin/pest
```

## Tech Stack

- Laravel 10
- Livewire 3
- Filament 3
- Tailwind CSS
- Stripe (Cashier)
- Spatie Laravel Permission
- Pest (Testing)
