# Student Registration System

A Laravel 11 application with a beautiful student registration form using MySQL database, Vite for frontend asset management, and external CSS/JS files.

## 🚀 Features

- **Modern Laravel 11** application
- **MySQL Database** with students table
- **Responsive Design** with gradient background
- **Real-time Form Validation** (both client-side and server-side)
- **Unique Phone Number** constraint
- **External CSS & JS** files compiled with Vite
- **Clean Code Architecture** following Laravel best practices
- **CSRF Protection** and security measures

## 📋 Requirements

- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Node.js & NPM
- XAMPP (or any web server with PHP and MySQL)

## 🛠️ Installation

### Step 1: Database Setup

The database has already been created. If you need to recreate it, run:

```bash
php setup_database.php
```

### Step 2: Run Migrations

```bash
php artisan migrate
```

This creates the `students` table with the following fields:
- `id` - Primary key
- `name` - Student's full name
- `email` - Student's email address
- `phone` - Student's phone number (unique)
- `id_card` - Student's ID card number
- `created_at` & `updated_at` - Timestamps

### Step 3: Build Assets (Already Done)

The frontend assets are already compiled. If you make changes, rebuild with:

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

## 🎯 Usage

### Start the Application

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

### Access the Registration Form

Visit: **http://localhost:8000/register**

## 📁 Project Structure

### Backend Files

```
app/
├── Models/
│   └── Student.php                    # Student model with fillable fields
├── Http/
│   └── Controllers/
│       └── StudentController.php      # Handles form display and submission
database/
└── migrations/
    └── 2025_10_07_115354_create_students_table.php
routes/
└── web.php                            # Application routes
```

### Frontend Files

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php             # Main layout with Vite assets
│   └── students/
│       └── register.blade.php        # Registration form view
├── css/
│   └── app.css                       # External CSS with modern styling
└── js/
    └── app.js                        # External JavaScript with validation

public/build/                          # Compiled assets (auto-generated)
```

### Configuration Files

```
.env                                   # Environment configuration
vite.config.js                        # Vite configuration for asset bundling
config/database.php                   # Database configuration
```

## 🎨 Design Features

### CSS Features
- **CSS Variables** for consistent theming
- **Gradient Background** (purple gradient)
- **Card-based Form** with shadow and border radius
- **Responsive Design** for all devices
- **Smooth Transitions** and hover effects
- **Modern Color Palette** with professional styling

### JavaScript Features
- **Real-time Validation** on input and blur events
- **Email Format Validation**
- **Phone Number Validation**
- **Error Message Display** with smooth animations
- **Auto-hide Success Messages** after 5 seconds
- **Form Submission Prevention** on validation errors

## 🔒 Security Features

- **CSRF Token Protection** on all forms
- **Input Validation** (server-side with Laravel)
- **SQL Injection Prevention** via Eloquent ORM
- **XSS Protection** via Blade templating engine
- **Unique Constraints** on phone numbers

## 📊 Database Schema

### Students Table

| Column      | Type         | Constraints           |
|-------------|--------------|----------------------|
| id          | BIGINT       | PRIMARY KEY, AUTO_INCREMENT |
| name        | VARCHAR(255) | NOT NULL            |
| email       | VARCHAR(255) | NOT NULL            |
| phone       | VARCHAR(20)  | NOT NULL, UNIQUE    |
| id_card     | VARCHAR(50)  | NOT NULL            |
| created_at  | TIMESTAMP    | NULL                |
| updated_at  | TIMESTAMP    | NULL                |

## 🧪 Testing the Application

1. **Open the registration form**: http://localhost:8000/register
2. **Fill in the form fields**:
   - Name: John Doe
   - Email: john@example.com
   - Phone: 1234567890
   - ID Card: ABC123456

3. **Submit the form**
4. **Success message appears** confirming registration
5. **Try submitting with the same phone number** - validation error appears

## ⚙️ Configuration

### Database Configuration (.env)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=students
DB_USERNAME=root
DB_PASSWORD=
DB_COLLATION=utf8mb4_unicode_ci
```

### Vite Configuration (vite.config.js)

```javascript
input: ['resources/css/app.css', 'resources/js/app.js']
```

## 🐛 Troubleshooting

### Database Connection Error
1. Ensure XAMPP MySQL is running
2. Verify credentials in `.env` file
3. Run `php setup_database.php` to recreate database

### Assets Not Loading
```bash
npm run build
```

### Migration Errors
```bash
php artisan migrate:fresh
```

### Port Already in Use
```bash
php artisan serve --port=8001
```

## 🚀 Development

### Running in Development Mode

Terminal 1 - Laravel Server:
```bash
php artisan serve
```

Terminal 2 - Vite Dev Server:
```bash
npm run dev
```

### Making Changes

**CSS Changes**: Edit `resources/css/app.css` and run `npm run build`

**JS Changes**: Edit `resources/js/app.js` and run `npm run build`

**View Changes**: Edit files in `resources/views/` (no rebuild needed)

**Backend Changes**: Edit controllers/models/routes (no rebuild needed)

## 📝 Routes

| Method | URI        | Action                          | Name             |
|--------|------------|---------------------------------|------------------|
| GET    | /          | Show welcome page               | -                |
| GET    | /register  | Show registration form          | students.register|
| POST   | /register  | Store student data              | students.store   |

## 🎓 Learning Resources

This project demonstrates:
- Laravel 11 MVC architecture
- Eloquent ORM usage
- Form validation (client & server)
- Vite asset bundling
- Blade templating
- Route management
- Database migrations
- External CSS/JS integration

## 📄 License

This project is open-source and available for educational purposes.

## 👨‍💻 Support

For issues or questions:
1. Check `SETUP_INSTRUCTIONS.md` for detailed setup
2. Review the troubleshooting section above
3. Ensure all prerequisites are installed and running

---

**Built with Laravel 11, Vite, and ❤️**
