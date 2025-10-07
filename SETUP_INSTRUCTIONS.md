# Student Registration System - Setup Instructions

## Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Composer
- Node.js & NPM
- XAMPP (or any web server with PHP and MySQL)

## Installation Steps

### 1. Database Setup
Create a MySQL database named `students`:

```sql
CREATE DATABASE students;
```

Or use phpMyAdmin at `http://localhost/phpmyadmin` to create the database.

### 2. Environment Configuration
The `.env` file is already configured with:
- **Database Name**: students
- **Database Host**: 127.0.0.1
- **Database User**: root
- **Database Password**: (empty by default for XAMPP)

If your MySQL credentials are different, update the following in `.env`:
```
DB_DATABASE=students
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Run Migrations
Create the students table by running:

```bash
php artisan migrate
```

### 4. Build Frontend Assets
The assets are already built, but if you make changes, rebuild with:

```bash
npm run build
```

For development with hot reload:
```bash
npm run dev
```

### 5. Start the Application
Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

### 6. Access the Registration Form
Visit the student registration form at:

```
http://localhost:8000/register
```

## Project Structure

### Backend Files
- **Model**: `app/Models/Student.php`
- **Controller**: `app/Http/Controllers/StudentController.php`
- **Migration**: `database/migrations/2025_10_07_115354_create_students_table.php`
- **Routes**: `routes/web.php`

### Frontend Files
- **View Layout**: `resources/views/layouts/app.blade.php`
- **Registration Form**: `resources/views/students/register.blade.php`
- **CSS**: `resources/css/app.css` (compiled to `public/build/assets/`)
- **JavaScript**: `resources/js/app.js` (compiled to `public/build/assets/`)

### Database Schema
The `students` table includes:
- `id` - Auto-increment primary key
- `name` - Student's full name
- `email` - Student's email address
- `phone` - Student's phone number (unique)
- `id_card` - Student's ID card number
- `created_at` - Timestamp when record was created
- `updated_at` - Timestamp when record was last updated

## Features

### Form Validation
- **Server-side validation**: Laravel validation rules in the controller
- **Client-side validation**: Real-time JavaScript validation
- **Unique phone number**: Database ensures phone numbers are unique

### User Experience
- Responsive design that works on all devices
- Real-time error messages
- Success message auto-hides after 5 seconds
- Form field validation on blur
- Modern gradient background with clean white form
- Smooth transitions and hover effects

### Security
- CSRF protection enabled
- Input sanitization
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade templating

## Usage

1. Fill in the student registration form with:
   - Full Name (required)
   - Email Address (required, valid email format)
   - Phone Number (required, unique, numeric)
   - ID Card Number (required)

2. Click "Register Student" button

3. The form will validate in real-time and show errors if any

4. Upon successful registration, a success message will appear

## Troubleshooting

### Database Connection Error
- Make sure XAMPP MySQL is running
- Verify database credentials in `.env` file
- Ensure the `students` database exists

### Assets Not Loading
Run the build command:
```bash
npm run build
```

### Migration Errors
Reset the database:
```bash
php artisan migrate:fresh
```

### Port Already in Use
Use a different port:
```bash
php artisan serve --port=8001
```

## Development

To run in development mode with hot reload:

```bash
# Terminal 1 - Start Laravel server
php artisan serve

# Terminal 2 - Start Vite dev server
npm run dev
```

Then update the view to use Vite dev server (automatically handled by `@vite` directive).

