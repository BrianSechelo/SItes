# 👗 Wardrobe Management System

This is a full-stack Wardrobe Management System built with **Vue 3 (Vite)** on the frontend and **Laravel 11** on the backend. Users can register, log in, and manage clothing items by adding, editing, deleting, and filtering wardrobe entries.

---

## 🛠 Tech Stack

- **Frontend:** Vue 3 + TypeScript + TailwindCSS + Axios
- **Backend:** Laravel 11 + Sanctum Authentication
- **Database:** MySQL or SQLite (configurable)

---

## 📦 Project Structure

frontend/ # Vue 3 app

backend/ # Laravel 11 API

---

## 🚀 Setup Instructions

### 📁 1. Clone the Repository

```bash
git clone https://github.com/your-username/wardrobe-management.git
cd wardrobe-management
Backend Setup (Laravel)
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
Ensure your .env file has correct DB credentials.

Sanctum is used for auth; CSRF token is required for login/register.
Frontend Setup (Vue 3)
cd frontend
npm install
npm run dev
Make sure the Axios instance (src/lib/axios.ts) points to the correct backend base URL:
// src/lib/axios.ts
const axiosInstance = axios.create({
  baseURL: "http://localhost:8000/api",
  withCredentials: true,
  withXSRFToken: true,
});
Auth Features

    Registration & Login

    Protected Dashboard

    Persistent session with Sanctum
Clothing Management Features

    Add new clothing items with name, category, and color

    Edit existing items

    Delete items

    Filter by category

    Search by name

    Responsive & user-friendly UI
