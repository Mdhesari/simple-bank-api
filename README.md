# Simple Bank API

This Laravel-based API provides basic functionality for a simple bank system, allowing users to deposit money, transfer funds, and receive notifications. It follows best practices and aims to be modular and extensible.

## Features

- Deposit money into user accounts.
- Notifications for deposit and transfer transactions.
- Modular and extensible architecture.
- Follows Laravel best practices.

## Getting Started

### Notes

- The Default currency is assumed to be Toman
- We don't consider any authorization policy in this project (as mentioned in document).
- Most components are tested with unit test.

### Prerequisites

Make sure you have the following installed on your system:

- [PHP](https://www.php.net/) (>= 7.4)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/) (>= 8)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com:Mdhesari/simple-bank-api.git
   ```
   
2. Install PHP dependencies:

   ```bash
   composer install
   ```
    
3. Configure your environment variables:

    ```bash
    cp .env.example .env
    ```
    
    Please register an account in https://kavenegar.com/ and fill KAVENEGAR_API_KEY otherwise you can setup your own driver.
    
5. Application Key:

    ```bash
    php artisan key:generate
    ```

5. Run Docker Compose:

    ```bash
    docker compose up -d
    ```
    
6. Run migrations:

    ```
    sail artisan migrate --seed
    ```

8. Run Queue:

    ```
    sail artisan queue:work
    ```
    
    OR you can config your own queue driver.
