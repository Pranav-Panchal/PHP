# Laravel Inventory Management System

This is an Inventory Management System built with the Laravel PHP framework. It provides CRUD (Create, Read, Update, Delete) operations for managing products, categories, and inventory levels.

## Features

- Add, edit, delete, and view inventory items.
- Manage categories for items.
- Track quantity, price, and other relevant details for inventory items.

## Prerequisites

- PHP >= 8.0
- Composer
- MySQL (or another compatible database)
- Node.js and npm (for frontend assets and dependencies)


### Step 1: Clone the Repository

Clone this repository to your local machine

### Step 2: Install Dependencies

composer install
npm install

### Step 3: Configure Environment Variables

cp .env.example .env
Open .env and configure the database connection:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=

### Step 4: Generate Application Key

php artisan key:generate

### Step 5: Run Database Migrations

php artisan migrate

### Step 7: Compile Assets

npm run dev

npm run build

### Step 8: Start the Application

php artisan serve



