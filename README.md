# 🧩 Volunteer Coordination Web App

A Laravel-based web application designed to manage volunteers, tasks, and work locations, allowing an admin to efficiently assign volunteers to specific roles and workplaces.
Developed as an individual final project for the university’s Web Development course.

---

## 🎯 Project Overview

This system is intended for a single administrator who oversees all operations.
The platform simplifies volunteer coordination by allowing structured management of:
- Volunteers — Add, edit, delete, and view volunteer records
- Tasks — Define various responsibilities (e.g., logistics, medical aid, supervision)
- Work Locations — Manage workplaces such as hospitals, centers, or field sites
- Assignments — Assign volunteers to specific tasks at a given location

---

## ⚙️ Features

| Category | Features |
|-----------|-----------|
| **Authentication** | Secure login and logout for admin |
| **Volunteer Management** | CRUD operations for volunteers |
| **Task Management** | CRUD operations for tasks |
| **Work Location Management** | CRUD operations for work locations |
| **Assignments** | Assign volunteers to specific tasks and locations |
| **Validation** | Server-side form validation using Laravel Requests |
| **Eloquent ORM** | Fully implemented Eloquent relationships (`hasMany`, `belongsTo`, etc.) |
| **Soft Deletes** | Implemented for safe record removal and restore |
| **Frontend Template** | Integrated with a ready-made Bootstrap-based admin dashboard |

---

## 🧱 System Architecture

- Framework: Laravel 11
- Language: PHP 8+
- Database: MySQL
- Frontend: Blade + Bootstrap (pre-built template)
- Authentication: Laravel’s built-in Auth system
- ORM: Eloquent ORM with relationships among models
- Routing: RESTful routes for all modules

---

## 🗃️ Eloquent Models and Relationships

| Model | Description | Key Relationships |
|--------|--------------|------------------|
| `Volunteer` | Stores volunteer info | `hasMany(Assignment)` |
| `Task` | Defines a task or role | `hasMany(Assignment)` |
| `WorkLocation` | Represents a workplace | `hasMany(Assignment)` |
| `Assignment` | Links volunteer, task, and location | `belongsTo(Volunteer)`, `belongsTo(Task)`, `belongsTo(WorkLocation)` |
| `User` | Represents the system admin | Authentication model |

---

## 🔐 API Endpoints

| Method | Endpoint | Description |
|---------|-----------|-------------|
| `POST` | `/login` | Admin login |
| `POST` | `/logout` | Admin logout |
| `GET` | `/volunteers` | View volunteers |
| `POST` | `/volunteers` | Add volunteer |
| `PUT` | `/volunteers/{id}` | Update volunteer |
| `DELETE` | `/volunteers/{id}` | Delete volunteer |
| `GET` | `/tasks` | View tasks |
| `POST` | `/tasks` | Add task |
| `PUT` | `/tasks/{id}` | Update task |
| `DELETE` | `/tasks/{id}` | Delete task |
| `GET` | `/work-locations` | View work locations |
| `POST` | `/work-locations` | Add work location |
| `PUT` | `/work-locations/{id}` | Update work location |
| `DELETE` | `/work-locations/{id}` | Delete work location |
| `GET` | `/assignments` | View assignments |
| `POST` | `/assignments` | Add assignment |
| `PUT` | `/assignments/{id}` | Update assignment |
| `DELETE` | `/assignments/{id}` | Delete assignment |

---

## 🧰 Setup Instructions

1. Clone Repository

```bash
git clone https://github.com/Maryam-Skaik/volunteer-coordination-system.git
cd volunteer-coordination
```

2. Install Dependencies

```bash
composer install
npm install
```

3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```
Update your `.env` file with MySQL credentials.

4. Run Migrations

```bash
php artisan migrate
```

5. Serve Application

```bash
php artisan serve
```
Access via [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔙 Frontend (React + Vite + CoreUI)

The frontend is a single-page React application built with **Vite**, styled using **TailwindCSS**, and structured with the **CoreUI Admin Template** for a responsive, modern UI.

- Framework: React
- Bundler: Vite
- UI Template: CoreUI
- Styling: TailwindCSS
- Runs on: [http://localhost:3000](http://localhost:3000)

**To Run the Frontend:**

```bash
cd frontend
npm install
npm start
```


## 🔐 First Page to Open

Start from the login page:
➡️ [http://localhost:3000/#/custom-login](http://localhost:3000/#/custom-login)

This is the custom login route for the application.

---

## 🧪 Testing

Basic feature tests are included for authentication and CRUD modules.
Run:

```bash
php artisan test
```

---

## 📦 Project Structure

```bash
app/
 ├── Http/
 │   ├── Controllers/
 │   │   ├── VolunteerController.php
 │   │   ├── TaskController.php
 │   │   ├── WorkLocationController.php
 │   │   └── AssignmentController.php
 │   └── Middleware/
 ├── Models/
 │   ├── Volunteer.php
 │   ├── Task.php
 │   ├── WorkLocation.php
 │   └── Assignment.php
resources/
 ├── views/
 └── js/
routes/
 ├── web.php
 └── api.php
```

---

## 🏆 Academic Context

- **Course:** Web Development (Final Project)  
- **Evaluation:** Assessed on functionality, Laravel implementation, and project organization  
- **Result:** Achieved full mark (15/15)  
- **Submission Date:** 27 June 2025

---

## 👤 Author

**Maryam Refaa Skaik**
