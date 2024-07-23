<h1 align="center"><strong>PetCare - BackEnd - API</strong></h1>

<p align="center">
  <img src="https://github.com/JhoanGZ/PetCare_FrontEnd/blob/main/assets/images/logo_petcare.png?raw=true" alt="PetCare Logo" />
</p>

Developed with Laravel, designed to help pet foundations to manage their pets' profiles and give a donors and new adopting owners the opportunity to help a pet needed for home.
This application offers a robust and secure interface for handling data related to all transactions related to the app.

## Features

-   **User Management**: Authentication and authorization using Laravel Sanctum.
-   **Pet Management**: Complete CRUD operations for managing pet information.
-   **Appointment Management**: Handling appointments for veterinary services.
-   **RESTful Interface**: RESTful API for all major operations.
-   **Notifications**: Notification system to alert users about important events.

## Technologies Used

-   **Backend**: Laravel 10.x, PHP 8.1
-   **Frontend**: JavaScript, Vite, Axios

## Prerequisites

-   PHP >= 8.1
-   Composer
-   Node.js
-   MySQL

## Installation

1. Clone the repository
    ```sh
    git clone https://github.com/JhoanGZ/PetCare_BackEnd.git
    ```

# PetCare BackEnd

## Description

PetCare BackEnd is a backend application developed with Laravel, designed to provide services for managing pets. This application offers a robust and secure interface for handling data related to pets, owners, appointments, and more.

## Features

-   **User Management**: Authentication and authorization using Laravel Sanctum.
-   **Pet Management**: Complete CRUD operations for managing pet information.
-   **Appointment Management**: Handling appointments for veterinary services.
-   **RESTful Interface**: RESTful API for all major operations.
-   **Notifications**: Notification system to alert users about important events.

## Technologies Used

-   **Backend**: Laravel 10.x, PHP 8.1
-   **Frontend**: JavaScript, Vite, Axios

## Prerequisites

-   PHP >= 8.1
-   Composer
-   Node.js
-   MySQL

## Installation

1. Clone the repository

    ````sh
    git clone https://github.com/JhoanGZ/PetCare_BackEnd.git
    ```

2. Install PHP dependencies

    ```sh
    composer install
    ```

3. Install Node.js dependencies

    ```sh
    npm install
    ```

4. Configure the .env file

    ```sh
    cp .env.example .env
    ```

5. Generate the application key
    ```sh
    php artisan key:generate
    ```
6. Run the migrations and seeders
    ```sh
    php artisan migrate --seed
    ```

## Usage

1. Start the development server
    ```sh
    php artisan serve
    ```
2. Access the application in your browser or virtual device enviroment
    ```sh
    http://localhost:8000
    ```

## License

This project is licensed under the Apache License, Version 2.0. See the LICENSE file for more details.

## Acknowledgements

Special thanks to my partners and friend from my university and professors for their support and guidance for this midterm studies project.
Thanks to the Flutter communities for their excellent resources and support.

Project Link: https://github.com/JhoanGZ/PetCare_BackEnd
