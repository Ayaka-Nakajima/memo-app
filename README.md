# memo-app

A memo application built with **Laravel** (backend API) and **Vue 3** (frontend SPA) for learning and practice purposes.

## Features

- Create, read, update, and delete memos
- REST API powered by Laravel
- Single-page application powered by Vue 3 + Vue Router
- Styled with Tailwind CSS

## Requirements

- PHP 8.3+
- Composer
- Node.js 18+
- npm

## Setup

### 1. Install PHP dependencies

```bash
composer install
```

### 2. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Set up the database

The default configuration uses SQLite. Run migrations:

```bash
php artisan migrate
```

### 4. Install JavaScript dependencies and build assets

```bash
npm install
npm run build
```

For development with hot-reload:

```bash
npm run dev
```

### 5. Start the development server

```bash
php artisan serve
```

Open <http://localhost:8000> in your browser.

## API Endpoints

| Method   | URL                | Description       |
|----------|--------------------|-------------------|
| GET      | `/api/memos`       | List all memos    |
| POST     | `/api/memos`       | Create a memo     |
| GET      | `/api/memos/{id}`  | Show a memo       |
| PUT      | `/api/memos/{id}`  | Update a memo     |
| DELETE   | `/api/memos/{id}`  | Delete a memo     |

## Testing

```bash
php artisan test
```
