# Laravel CRM Application

A slim, modern CRM application built with Laravel and Tailwind CSS, designed for managing companies and contacts with file upload capabilities.

## 🚀 Features

### Authentication & Access Control

-   **Laravel Jetstream** with Livewire stack
-   User authentication and profile management
-   Email verification
-   Two-factor authentication (2FA)
-   Session management
-   Team support
-   API tokens via Laravel Sanctum

### Company Management

-   Full CRUD operations for companies
-   Company logo uploads
-   Multiple file uploads (PDF, DOC, XLS, images)
-   Comprehensive company information:
    -   Basic details (name, email, phone, website)
    -   Full address (street, city, state, zip, country)
    -   Notes and descriptions

### Contact Management

-   Full CRUD operations for contacts
-   Contact headshot uploads
-   Contact information (name, email, phone, job title, notes)
-   **Linked to companies** - every contact belongs to a company
-   Company-specific contact views

### User Interface

-   **Tailwind CSS** for modern, responsive design
-   Custom styling inspired by "Less Annoying CRM"
-   Mobile-friendly responsive design
-   Clean, intuitive navigation

## 🛠️ Installation & Setup

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   MySQL/MariaDB (via MAMP Pro)
-   MAMP Pro for local development

### 1. Clone and Install Dependencies

```bash
git clone <repository-url>
cd laravel-crm
composer install
npm install
```

### 2. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crm
DB_USERNAME=root
DB_PASSWORD=root
```

### 3. Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### 4. Storage Setup

```bash
php artisan storage:link
```

### 5. Build Frontend Assets

```bash
npm run build
```

### 6. Start Development Server

```bash
php artisan serve
```

## 🔑 Default Login Credentials

After running the seeder, you can log in with:

-   **Email:** `test@example.com`
-   **Password:** `password`

## 📁 File Storage

The application supports file uploads for:

-   **Company logos:** Stored in `storage/app/public/company-logos/`
-   **Company files:** Stored in `storage/app/public/company-files/`
-   **Contact headshots:** Stored in `storage/app/public/contact-headshots/`

## 🗄️ Database Structure

### Companies Table

-   `id`, `name`, `email`, `phone`
-   `street`, `city`, `state`, `zip`, `country`
-   `website`, `notes`, `logo_path`
-   `created_at`, `updated_at`

### Contacts Table

-   `id`, `first_name`, `last_name`, `email`, `phone`
-   `job_title`, `user_general_note`, `headshot_path`
-   `company_id` (foreign key)
-   `created_at`, `updated_at`

### Company Files Table

-   `id`, `company_id` (foreign key)
-   `file_name`, `file_path`, `file_type`
-   `original_name`, `file_size`, `description`
-   `created_at`, `updated_at`

## 🎯 Usage

### Dashboard

-   View quick statistics (total companies, contacts, files)
-   Quick action buttons for common tasks
-   Recent companies and contacts overview

### Companies

-   **Index:** View all companies with contact counts
-   **Create:** Add new companies with logo and file uploads
-   **Show:** View company details, contacts, and files
-   **Edit:** Update company information
-   **Delete:** Remove companies (cascades to contacts and files)

### Contacts

-   **Index:** View all contacts with company information
-   **Create:** Add new contacts linked to companies
-   **Show:** View contact details and company information
-   **Edit:** Update contact information
-   **Delete:** Remove contacts

## 🔧 Customization

### Adding New Fields

To add new fields to companies or contacts:

1. Create a new migration: `php artisan make:migration add_field_to_table`
2. Update the model's `$fillable` array
3. Update the views and controllers as needed

### Styling

The application uses Tailwind CSS. Custom styles can be added to:

-   `resources/css/app.css`
-   Component-specific classes in Blade templates

## 🚀 Deployment

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Configure your production database
3. Set up proper file storage (consider using S3 or similar)
4. Configure email settings for verification
5. Set up proper SSL certificates

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and questions, please open an issue in the repository.
