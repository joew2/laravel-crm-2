# 🚀 Quick Setup Guide

## Prerequisites

-   MAMP Pro running with MySQL
-   PHP 8.2+
-   Composer
-   Node.js & NPM

## ⚡ Quick Start (5 minutes)

### 1. Database Setup in MAMP Pro

-   Open MAMP Pro
-   Create a new database called `laravel_crm`
-   Note your MySQL credentials (usually `root`/`root`)

### 2. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Edit .env file with your database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crm
DB_USERNAME=root
DB_PASSWORD=root
```

### 3. Install & Setup

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed with sample data
php artisan db:seed

# Create storage link for file uploads
php artisan storage:link

# Build frontend assets
npm run build
```

### 4. Start the Application

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 🔑 Login Credentials

-   **Email:** `test@example.com`
-   **Password:** `password`

## 📱 What You'll See

-   **Dashboard** with CRM statistics
-   **3 sample companies** with contacts
-   **4 sample contacts** linked to companies
-   Full CRUD functionality for both companies and contacts
-   File upload capabilities for logos, headshots, and documents

## 🎯 Next Steps

1. Explore the dashboard
2. Create your first company
3. Add contacts to companies
4. Upload company logos and files
5. Customize the application as needed

## 🆘 Need Help?

-   Check the main README.md for detailed documentation
-   Ensure MAMP Pro MySQL service is running
-   Verify database credentials in .env file
-   Check that all migrations ran successfully
