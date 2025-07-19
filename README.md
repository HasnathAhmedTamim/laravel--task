# Laravel Coding Round - API Implementation

Complete implementation of all 3 required tasks for the Laravel coding round.

## 🎯 Implemented Tasks

✅ **Task 1: Blog Post CRUD API** (10 minutes)  
✅ **Task 2: User Registration API** (10 minutes)  
✅ **Task 3: Task Management API** (10 minutes)

## 🚀 Setup Instructions

```bash
# Clone the repository
git clone https://github.com/HasnathAhmedTamim/laravel--task.git
cd laravel-app

# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup (SQLite)
touch database/database.sqlite
php artisan migrate

# Start the server
php artisan serve
```

**Server URL:** `http://127.0.0.1:8000`

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

## 📋 API Endpoints

### Task 1: Blog Post CRUD API

**Create a Post:**
```http
POST /api/posts
Content-Type: application/json

{
  "title": "My First Post",
  "content": "This is my content."
}
```

**List All Posts:**
```http
GET /api/posts
```

**View Single Post:**
```http
GET /api/posts/{id}
```

### Task 2: User Registration API

**Register User:**
```http
POST /api/register
Content-Type: application/json

{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password123"
}
```

**Validation Rules:**
- `name`: minimum 3 characters
- `email`: valid format, must be unique
- `password`: minimum 8 characters

### Task 3: Task Management API

**Add a Task:**
```http
POST /api/tasks
Content-Type: application/json

{
  "title": "Finish Laravel test"
}
```

**Mark Task as Completed:**
```http
PATCH /api/tasks/{id}
Content-Type: application/json

{
  "is_completed": true
}
```

**Get Pending Tasks:**
```http
GET /api/tasks/pending
```

## 🗂️ Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php      # Task 2: User Registration
│   ├── BlogPostController.php  # Task 1: Blog CRUD
│   └── TaskController.php      # Task 3: Task Management
├── Models/
│   ├── User.php
│   ├── Post.php
│   └── Task.php
database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_posts_table.php
│   └── create_tasks_table.php
routes/
└── api.php                     # All API routes
```

## ⚡ Testing the APIs

Use any API client (Postman, Insomnia, curl) to test the endpoints:

**Test User Registration:**
```bash
curl -X POST http://127.0.0.1:8000/api/register 
  -H "Content-Type: application/json" 
  -d '{"name":"Test User","email":"test@example.com","password":"password123"}'
```

**Test Blog Post Creation:**
```bash
curl -X POST http://127.0.0.1:8000/api/posts 
  -H "Content-Type: application/json" 
  -d '{"title":"Test Post","content":"This is a test post"}'
```

**Test Task Creation:**
```bash
curl -X POST http://127.0.0.1:8000/api/tasks 
  -H "Content-Type: application/json" 
  -d '{"title":"Complete Laravel coding round"}'
```

## ✅ Requirements Fulfilled

- ✅ All 3 tasks implemented using Laravel's built-in features
- ✅ Eloquent ORM for database operations
- ✅ Request validation for all inputs
- ✅ Proper migrations for database structure
- ✅ Clean folder structure (controllers, models, migrations)
- ✅ Proper commit messages
- ✅ Complete README with setup instructions

**Time Completed:** Under 30 minutes as required.

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
