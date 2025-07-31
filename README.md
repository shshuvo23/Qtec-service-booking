# Laravel Booking System with Admin Panel

A complete booking system with user authentication and admin management features.

## Features

- User registration and login
- Service booking functionality
- Admin panel for managing:
  - Services
  - Bookings
  - Users
- Role-based access control
- RESTful API endpoints

## Installation

1. Clone the repository:
```bash
git clone [https://github.com/yourusername/booking-system.git](https://github.com/shshuvo23/Qtec-task.git)
cd Qtec-task
```

2. Install dependencies:
```bash
composer install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking_system
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations and seeders:
```bash
php artisan migrate --seed
```

## Running the Application

Start the development server:
```bash
php artisan serve
```

Access the application at:
- Admin panel: http://localhost:8000/login
- API documentation: http://localhost:8000/api/

## Default Credentials

**Admin User:**
- Email: admin@example.com
- Password: password


## API Documentation

The system provides RESTful API endpoints for:
- User authentication
- Service management
- Booking operations

See [API Documentation](API.md) for details.

## Commit History Strategy

We've maintained a clean commit history showing our development process:
1. Initial Laravel setup
2. Authentication scaffolding
3. Admin middleware implementation
4. Service management features
5. Booking functionality
6. Testing implementation

