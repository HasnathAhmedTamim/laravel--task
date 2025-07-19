# Laravel Coding Round - API Implementation

Complete Laravel 11 API implementation for coding round with all 3 required tasks.

## 🚀 Quick Setup

```bash
git clone https://github.com/HasnathAhmedTamim/laravel--task.git
cd laravel--task
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

**Server:** `http://127.0.0.1:8000`

## 📋 API Endpoints

### Task 1: Blog Posts
```
POST   /api/posts        # Create: {"title":"...", "content":"..."}
GET    /api/posts        # List all posts
GET    /api/posts/{id}   # View single post
```

### Task 2: User Registration
```
POST   /api/register     # Register: {"name":"...", "email":"...", "password":"..."}
```

### Task 3: Tasks
```
POST   /api/tasks        # Create: {"title":"..."}
PUT    /api/tasks/{id}   # Update: {"is_completed": true}
GET    /api/tasks/pending # List pending tasks
```

## 🧪 Test Examples

```bash
# Register User
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Jane Doe","email":"jane@example.com","password":"password123"}'

# Create Post
curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Content-Type: application/json" \
  -d '{"title":"My Post","content":"Post content"}'

# Create Task
curl -X POST http://127.0.0.1:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{"title":"Complete project"}'
```

## ✅ Features
- ✅ Laravel 11 + SQLite
- ✅ All 3 tasks completed
- ✅ Proper validation & error handling
- ✅ Clean JSON responses
