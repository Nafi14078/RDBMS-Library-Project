#  Online Library Management System
This is a simple **Online Library Management System** built using **PHP**, **MySQL**, and **XAMPP**. Users can browse, view, and download books without logging in, while the admin can manage the library through a secure login system.

##  Features
- Search books by title
- View book details, category, and author
- Download or read books online
- Admin can add, edit, and delete books
- Manage book categories and authors
- Admin login system 

##  Technologies Used
- PHP
- MySQL (phpMyAdmin)
- HTML, CSS
- XAMPP (Apache & MySQL)

##  How to Run the Project
1. Clone the repository:
   ```
   https://github.com/Nafi14078/RDBMS-Library-Project.git
   ```
2. Move the project folder into `htdocs` (inside XAMPP directory).
3. Open **phpMyAdmin**, create a new database.
4. Import the provided `.sql` file into the database.
5. Update `db_conn.php` with:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "your_password";
   $dbname = "your_db_name";
   ```
6. Start Apache and MySQL from XAMPP Control Panel.
7. Open your browser and go to:
   ```
   http://localhost/your-project-folder/
   ```

##  License
This project is open-source and available under the [MIT License](LICENSE).
