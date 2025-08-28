# Laravel CRM App Plan

I want to create a **slim CRM application** using **Laravel** that will run locally on my Mac with **MAMP Pro** and **MYSQL**. Please follow **Laravel best practices** (from the official docs and community conventions). Keep the initial build structured for growth.

-   Always look for existing code to iterate on before creating new code.

---

## 🔑 Core Requirements (MVP)

### 1. Authentication & Access Control

Setup Laravel Jetstream sample data and pages/code etc. with:

-   Authentication
-   Profile Management
-   File upload for **headshot**
-   Email Verification
-   Two-Factor Authentication (2FA)
-   Session Management
-   Teams (optional)
-   API Tokens (via Sanctum)
-   Provide login credentials

### 2. Companies

-   CRUD functionality for companies.
-   Standard fields: `name`, `email`, `phone`, `street`, `city`,`state`,`zip`,`country`,`website`, `notes`.
-   File upload for **company logo**
-   file upload for multiple files as PDF, DOC, EXCEL DOCX, JPEG, JPG, PNG etc.
-   Validation and error handling.

### 3. Contacts

-   CRUD functionality for contacts.
-   Standard fields: `first_name`, `last_name`, `email`, `phone`, `job_title`. `user_general_note`.
-   Upload field for **headshot**
-   Contacts are **linked to companies**

### 4. UI / Styling

-   Tailwind
-   Custom CSS
-   Design Inspiration from "Less Annoying CRM"
