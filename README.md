# Laravel Coding Round - Complete Implementation

This repository contains the complete implementation of all 3 required tasks for the Laravel coding round, built with Laravel 11 and following all specified requirements.

## 🎯 Completed Tasks

✅ **Task 1: Blog Post CRUD API** (10 minutes)  
✅ **Task 2: User Registration API** (10 minutes)  
✅ **Task 3: Task Management API** (10 minutes)

## 🚀 Setup Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer
- SQLite (included in PHP)

### Installation Steps

```bash
# Clone the repository
git clone https://github.com/HasnathAhmedTamim/laravel--task.git
cd laravel--task

# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup (SQLite)
touch database/database.sqlite
php artisan migrate

# Start the development server
php artisan serve
```

**Server URL:** `http://127.0.0.1:8000`

## 📋 API Documentation

### Task 2: User Registration API

**Endpoint:** `POST /api/register`

**Request:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "id": 1,
  "name": "Jane Doe", 
  "email": "jane@example.com",
  "created_at": "2024-12-18T10:00:00Z"
}
```

**Validation Rules:**
- `name`: Required, minimum 3 characters
- `email`: Required, valid email, unique in users table
- `password`: Required, minimum 8 characters

---

### Task 1: Blog Post CRUD API

#### Create a Post
**Endpoint:** `POST /api/posts`

**Request:**
```json
{
  "title": "My First Post",
  "content": "This is my content."
}
```

**Response:**
```json
{
  "id": 1,
  "title": "My First Post",
  "content": "This is my content.",
  "created_at": "2024-12-18T10:00:00Z"
}
```

#### List All Posts
**Endpoint:** `GET /api/posts`

**Response:**
```json
[
  {
    "id": 1,
    "title": "My First Post",
    "content": "This is my content.",
    "created_at": "2024-12-18T10:00:00Z"
  }
]
```

#### View a Single Post
**Endpoint:** `GET /api/posts/{id}`

**Response:**
```json
{
  "id": 1,
  "title": "My First Post", 
  "content": "This is my content.",
  "created_at": "2024-12-18T10:00:00Z"
}
```

---

### Task 3: Task Management API

#### Add a Task
**Endpoint:** `POST /api/tasks`

**Request:**
```json
{
  "title": "Finish Laravel test"
}
```

**Response:**
```json
{
  "id": 1,
  "title": "Finish Laravel test",
  "is_completed": false,
  "created_at": "2024-12-18T10:00:00Z"
}
```

#### Mark Task as Completed
**Endpoint:** `PATCH /api/tasks/{id}`

**Request:**
```json
{
  "is_completed": true
}
```

**Response:**
```json
{
  "id": 1,
  "title": "Finish Laravel test",
  "is_completed": true,
  "created_at": "2024-12-18T10:00:00Z"
}
```

#### Get Pending Tasks
**Endpoint:** `GET /api/tasks/pending`

**Response:**
```json
[
  {
    "id": 2,
    "title": "Another pending task",
    "is_completed": false,
    "created_at": "2024-12-18T10:00:00Z"
  }
]
```

## 🗂️ Project Structure

```
laravel--task/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php      # User registration
│   │       ├── BlogPostController.php  # Blog post CRUD
│   │       └── TaskController.php      # Task management
│   └── Models/
│       ├── User.php                    # User model
│       ├── Post.php                    # Blog post model
│       └── Task.php                    # Task model
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_07_19_123745_create_posts_table.php
│   │   └── 2025_07_19_123844_create_tasks_table.php
│   └── database.sqlite                 # SQLite database
├── routes/
│   └── api.php                         # API routes
└── README.md                           # This file
```

## 🧪 Testing the APIs

### Using cURL

**User Registration:**
```bash
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Jane Doe","email":"jane@example.com","password":"password123"}'
```

**Create Blog Post:**
```bash
curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Content-Type: application/json" \
  -d '{"title":"My First Post","content":"This is my content."}'
```

**Get All Posts:**
```bash
curl -X GET http://127.0.0.1:8000/api/posts
```

**Create Task:**
```bash
curl -X POST http://127.0.0.1:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{"title":"Finish Laravel test"}'
```

**Mark Task Completed:**
```bash
curl -X PATCH http://127.0.0.1:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{"is_completed":true}'
```

**Get Pending Tasks:**
```bash
curl -X GET http://127.0.0.1:8000/api/tasks/pending
```

## 🛠️ Technical Implementation

- **Framework:** Laravel 11
- **Database:** SQLite (for easy setup)
- **Architecture:** MVC pattern with proper separation of concerns
- **Validation:** Laravel's built-in request validation
- **ORM:** Eloquent ORM for database operations
- **Response Format:** JSON API responses with proper HTTP status codes

## ✅ Requirements Compliance

✅ All three tasks completed within time limit  
✅ Laravel built-in features used (Eloquent ORM, request validation, migrations)  
✅ Proper commit messages and clear folder structure  
✅ Complete README.md with setup and usage instructions  
✅ All API endpoints match exact specifications  
✅ Proper input validation and error handling  
✅ Database tables with specified structure and constraints  

## 📝 Notes

- All passwords are hashed using Laravel's default bcrypt algorithm
- Unique email constraint enforced at database level
- Proper HTTP status codes used (200, 201, 404, 422)
- Clean, well-commented code following Laravel conventions
- Error handling for not found resources and validation failures
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
