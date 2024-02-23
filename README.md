# Student Management System (Laravel Inertia React Combination)

This repository contains a Student Management System built with Laravel, Inertia.js, and React, utilizing the power of server-side rendering and client-side interactivity for seamless user experience.

## Features

- Add basic student information with validations to ensure data integrity.
- List students class-wise and enable searching by student name.
- Add teacher information with required fields and image upload functionality.
- Add subject information, allowing for multiple languages per subject.
- List all subjects taught by teachers, with the capability for one teacher to teach multiple subjects across different classes.

## Requirements

- PHP 7.3 or higher
- Composer
- Node.js
- MySQL database
- Web server (e.g., Apache, Nginx)

## Installation

1. Clone the repository to your local machine:

```
git clone https://github.com/vikaskumar-e1256/student-management-system.git
```

2. Install PHP dependencies using Composer:

```
composer install
```

3. Install JavaScript dependencies using npm:

```
npm install
```

4. Copy the `.env.example` file to `.env` and configure the database connection:

```
cp .env.example .env
```

5. Generate application key:

```
php artisan key:generate
```

6. Run database migrations and seeders:

```
php artisan migrate --seed
```

7. Ensure proper file permissions for image uploads if you're using them.

8. Run the development server:

```
php artisan serve
```

9. Navigate to the project directory on your web server and start using the Student Management System.

## Usage

### Adding Student Information

- Access the page for adding student information.
- Fill in the required fields such as name, age, and roll number.
- Upload an optional image for the student.
- Click the submit button to add the student to the database.

### Listing Students

- Visit the page to list all students class-wise.
- Utilize the search functionality to find students by name.

### Adding Teacher Information

- Access the page for adding teacher information.
- Enter the required fields including name, age, and sex.
- Upload an optional image for the teacher.
- Click the submit button to save the teacher details.

### Adding Subject Information

- Navigate to the page for adding subject information.
- Provide the required fields such as subject name and class.
- Specify multiple languages for the subject if necessary.
- Submit the form to add the subject to the database.

### Listing Subjects and Teachers

- Visit the page to list all subjects taught by teachers.
- Each subject is associated with the respective teacher(s) who teach it.

## Contributors

- [Vikas Kumar](https://github.com/vikaskumar-e1256)

## License

This project is licensed under the [MIT License](LICENSE).
