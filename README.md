# EduPulse - School ERP System

**EduPulse** is a comprehensive School ERP (Enterprise Resource Planning) system built with Laravel. It streamlines school management with modules for student records, attendance, fees, exams, staff management, and more.

<img width="1891" height="985" alt="Screenshot 2025-08-21 082804" src="https://github.com/user-attachments/assets/419091a9-5c11-4cf0-b8f0-a3d424feed57" />


## 🚀 Quick Start

1. **Clone the repository**
```bash
git clone https://github.com/dhirajs16/EduPulse.git
cd EduPulse
```

2. **Install dependencies**
```bash
composer install
```

3. **Copy environment file**
```bash
cp .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Configure database** (edit `.env`)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edupulse
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations & seed**
```bash
php artisan migrate --seed
```

7. **Start development server**
```bash
php artisan serve
```
Visit `http://localhost:8000`

## ✨ Features

- **Student Management**: Admissions, profiles, grades
- **Attendance Tracking**: Daily/periodic attendance
- **Fee Management**: Invoices, payments, receipts
- **Examination Module**: Results, report cards
- **Staff Management**: Teachers, admin staff
- **Timetable Scheduler**
- **Email Notifications**
- **Role-based Dashboard** (Admin, Teacher, Student, Parent)

## 📋 Requirements

- PHP 8.2+
- Laravel 10.x
- MySQL 8.0+ or MariaDB 10.6+
- Composer
- Node.js + NPM (for assets)
- Minimum 2GB RAM for development

## 🛠️ Development

```bash
# Install frontend dependencies
npm install

# Compile assets
npm run dev

# Run tests
php artisan test

# Clear cache
php artisan optimize:clear
```

## 📚 Tech Stack

```
Backend: Laravel 11.x, MySQL, 
Frontend: Tailwind CSS, Blade Template
Auth: Laravel Breeze (2 Custom Guards)
Mail: SMTP, Gmail App Service
Version Control: Git & GitHub
```

## 🔐 Default Login

After seeding:
```
Admin: admin@gmail.com / pw: 12345678
Teacher: teacher1@example.com / pw: 12345678  
Student: student1@example.com / pw: 12345678
```

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📄 License

MIT License - see [LICENSE](LICENSE) file.

## 👨‍💻 Author

**Dhiraj Sarraf**  
[LinkedIn](https://linkedin.com/in/dhirajs16) | [GitHub](https://github.com/dhirajs16)

***

<div align="center">
Simplifying school administration 🏫📚, empowering education ✨
</div>
