# Laravel 13 API - Role-Based Access Control (RBAC)

This repository contains the implementation of Role-Based Access Control (RBAC) using Laravel 13 and Laravel Sanctum for API Authorization.

## Protected API Routes

| Endpoint | HTTP Method | Allowed Roles | Description |
|---|---|---|---|
| `/api/register` | `POST` | Public | Register new student accounts |
| `/api/login` | `POST` | Public | Authenticate user and issue Sanctum token |
| `/api/profile` | `GET` | Authenticated | View current authenticated user details |
| `/api/logout` | `POST` | Authenticated | Revoke access token |
| `/api/students` | `GET` | `admin`, `student` | Shared endpoint listing student records |
| `/api/admin/dashboard` | `GET` | `admin` | Restricted dashboard for Admin only |
| `/api/student/dashboard` | `GET` | `student` | Restricted dashboard for Student only |

---

## Reflection Answers

### 1. What is the difference between authentication and authorization?
- **Authentication** verifies *who* a user is (confirming identity using credentials such as email and password to issue a Bearer token).
- **Authorization** verifies *what* an authenticated user is permitted to do (checking permissions and roles such as `admin` vs. `student`).

### 2. Why does a student receive `403` when accessing the admin dashboard, but a request without a token receives `401`?
- A request without a token returns **`401 Unauthorized`** (Unauthenticated) because the system cannot identify who is making the request.
- A student accessing the admin dashboard returns **`403 Forbidden`** because authentication succeeded (the system knows the user is a `student`), but authorization failed since the user lacks the required `admin` role.
