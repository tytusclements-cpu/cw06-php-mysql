# cw06-php-mysql
Author

## Overview
This project demonstrates a complete PHP + MySQL CRUD (Create, Read, Update, Delete) application built on the CODD server. It includes a professional HTML form, secure database interaction using prepared statements, and a styled user interface with external CSS.

## Features
- Create new employee records using a form
- Read/display all employees in a table
- Update employee job title and salary
- Delete employee records safely
- Secure database queries with prepared statements
- Output sanitization using `htmlspecialchars()`
- Responsive and clean UI using external CSS

## Technologies Used
- PHP (MySQLi)
- MySQL
- HTML5
- CSS3
- CODD Server (codd.cs.gsu.edu)

## Project Structure
cw06_Clements/
  index.php
  employee_demo.php
  db.php
  create_employee.php
  read_employees.php
  update_employee.php
  delete_employee.php
  css/
    style.css
  sql-notes.txt

  ## Setup Instructions
1. Upload files to your CODD directory:

~/public_html/cw06_Clements/

2. Update database credentials in `db.php`:

$user = "your_username";
$pass = "your_password";
Run SQL script from sql-notes.txt to create and populate the database.

Open in browser:

https://codd.cs.gsu.edu/~tclements5/Web/CW/cw06_Clements/index.php
Usage
Use the form on employee_demo.php to add new employees
Click "View employee records" to see all entries
Use Edit/Delete links to modify or remove records
Security Practices
Prepared statements used for all database operations
htmlspecialchars() used to prevent XSS attacks
WHERE clauses used in UPDATE and DELETE to prevent mass changes

Author:
Tytus Clements
