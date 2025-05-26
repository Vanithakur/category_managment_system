# Mini Blog Post & Category Management System

This is a mini Laravel project built as an interview task for managing blog posts and categories with both web and API access.

## Installation & Setup

### 1. Clone the Repository

git clone https://github.com/Vanithakur/category_managment_system.git
cd category_managment_system

### 2. Install Dependencies

composer install

### 3. Configure Environment
cp .env.example .env
php artisan key:generate

If you're using XAMPP and running the project locally, update the .env file with the following database settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=category_management_system
DB_USERNAME=root
DB_PASSWORD=

### 4. Run Migrations & Seeders
php artisan migrate --seed

### 5. Link Storage
php artisan storage:link

### 6. Serve the Application
php artisan serve

## API Endpoint
Base URL: http://127.0.0.1:8000
GET /api/posts

I have added the Postman collection in the root directory of this project.

