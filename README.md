# Student Management System

A simple CRUD (Create, Read, Update, Delete) web application for managing student information, built using PHP and Bootstrap 5.

## Features

- Add new students
- View student details
- Update student information
- Delete students
- Responsive design using Bootstrap 5

## Prerequisites

- PHP >= 7.4
- MySQL or MariaDB
- Web server (e.g., Apache, Nginx)

## Installation

link to repo: https://github.com/wisdomdzontoh/student-management-system

1. **Clone the repository:**

   ```sh
   git clone https://github.com/wisdomdzontoh/student-management-system.git
   cd student-management-system
   ```

2. **Set up the database:**

   - Create a database named `student_management` in your MySQL or MariaDB server.
   - Import the provided SQL script to create the `students` table.

   ```sql
   CREATE DATABASE student_management;
   USE student_management;

   CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       age INT NOT NULL,
       gender ENUM('Male', 'Female', 'Other') NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       program VARCHAR(100) NOT NULL,
       level VARCHAR(50) NOT NULL,
       session ENUM('Morning', 'Evening', 'Weekend') NOT NULL,
       cgpa DECIMAL(3, 2) NOT NULL,
       certificate_awarded ENUM('Bachelor\'s Degree', 'Master\'s Degree', 'PhD') NOT NULL
   );
   ```

3. **Configure the application:**

   - Rename `config/database.example.php` to `config/database.php`.
   - Update the database connection details in `config/database.php`.

   ```php
   <?php
   $host = 'localhost';
   $db   = 'student_management';
   $user = 'yourusername';
   $pass = 'yourpassword';
   $charset = 'utf8mb4';

   $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
   $options = [
       PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       PDO::ATTR_EMULATE_PREPARES   => false,
   ];

   try {
       $pdo = new PDO($dsn, $user, $pass, $options);
   } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }
   ```

4. **Start the web server:**

   If you're using a built-in PHP server, navigate to the project directory and run:

   ```sh
   php -S localhost:8000
   ```

5. **Access the application:**

   Open your web browser and go to [http://localhost:8000](http://localhost:8000).

## Usage

### Adding a Student

1. Click on the "Add Student" button on the index page.
2. Fill in the student details in the popup form.
3. Click "Submit" to add the student.

### Viewing a Student

1. Click the "View" button next to a student in the list.
2. The student's details will be displayed in a popup modal.

### Updating a Student

1. Click the "Edit" button next to a student in the list.
2. Modify the student details in the popup form.
3. Click "Submit" to update the student.

### Deleting a Student

1. Click the "Delete" button next to a student in the list.
2. Confirm the deletion in the prompt.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a Pull Request.

## Acknowledgements

- [Bootstrap 5](https://getbootstrap.com/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
