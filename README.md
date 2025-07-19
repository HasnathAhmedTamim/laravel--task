# Laravel API Project

Laravel 11 REST API implementing 3 core functionalities: User Registration, Blog Post CRUD, and Task Management.

## 🚀 Features

- **User Registration API**: POST `/api/register` with validation
- **Blog Post CRUD API**: Full CRUD operations at `/api/posts`  
- **Task Management API**: Create tasks and mark as completed

## ⚡ Quick Setup

```bash
# Clone and install
git clone https://github.com/HasnathAhmedTamim/laravel--task.git
cd laravel-app
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Access at: `http://127.0.0.1:8000`

## 📋 API Endpoints

### 1. User Registration
```http
POST /api/register
Content-Type: application/json

{
  "name": "Jane Doe",
  "email": "jane@example.com", 
  "password": "password123"
}
```

### 2. Blog Posts
```http
GET    /api/posts        # List all posts
POST   /api/posts        # Create: {"title":"...", "content":"..."}
GET    /api/posts/{id}   # View single post
```

### 3. Task Management  
```http
POST   /api/tasks        # Create: {"title": "Finish Laravel test"}
PATCH  /api/tasks/{id}   # Update: {"is_completed": true}
GET    /api/tasks/pending # Get incomplete tasks
```

## 🧪 Testing

```bash
# Run test scripts
php test_api.php
php test_task_api.php
```

## 🗄️ Database Tables

- **users**: id, name, email, password, created_at
- **posts**: id, title, content, created_at  
- **tasks**: id, title, is_completed, created_at

**Tech Stack**: Laravel 11 • SQLite • RESTful API
