# FitHub
FitHub is an innovative online platform dedicated to fostering holistic fitness journeys.

## Fitness Management System

This Exercise Management System is a simple web application built with PHP and MySQL. It allows users to manage exercises by adding, editing, viewing, and deleting them.

## Features

- Add new exercises with name, description, and difficulty level.
- Edit existing exercises.
- View details of exercises.
- Delete exercises.

## Prerequisites

Before running the system with XAMPP, ensure you have the following installed:

- XAMPP: You can download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).

## Installation

1. Clone this repository to your local machine or download and extract the ZIP file.

2. Open the XAMPP Control Panel and start the Apache and MySQL services.

3. Place the project folder inside the `htdocs` directory of your XAMPP installation. By default, this directory is located at `C:\xampp\htdocs` on Windows or `/opt/lampp/htdocs` on Linux.

4. Create the database and tables:
    - Open phpMyAdmin by visiting `http://localhost/phpmyadmin` in your web browser.
    - Click on the "SQL" tab in phpMyAdmin.
    - Copy and paste the following SQL queries to create the database and tables:

    ```sql
    CREATE DATABASE fitness;

    USE fitness;

    CREATE TABLE exercises (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        difficulty ENUM('Easy', 'Medium', 'Hard') NOT NULL
    );
    ```

5. Update the database connection details in `config.php` with your MySQL database credentials.


## Usage

1. Open your web browser and navigate to `http://localhost/your-folder-name` where `your-folder-name` is the name of the folder containing the project inside the `htdocs` directory.

2. From the home page, you can:
    - Add a new exercise by clicking on "Add Exercise".
    - Edit an existing exercise by clicking on the "Edit" button next to it.
    - View details of an exercise by clicking on the "View" button.
    - Delete an exercise by clicking on the "Delete" button.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please feel free to open an issue or create a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

