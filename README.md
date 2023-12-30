# Simple Bank API

This Laravel-based API provides basic functionality for a simple bank system, allowing users to deposit money, transfer funds, and receive notifications. It follows best practices and aims to be modular and extensible.

## Features

- Deposit money into user accounts.
- Notifications for deposit and transfer transactions.
- Modular and extensible architecture.
- Follows Laravel best practices.

## Getting Started

### Prerequisites

Make sure you have the following installed on your system:

- [PHP](https://www.php.net/) (>= 7.4)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/) (>= 8)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/mdhesari/image-search-processor-laravel-vuejs.git
   ```
   
2. Install PHP dependencies:

   ```bash
   composer install
   ```
3. Install Javascript & Vuejs dependencies:

    ```bash
    npm install
    ```
    
4. Configure your environment variables:

    ```bash
    cp .env.example .env
    ```
    
    Please register an account in https://serpapi.com/ and set SERAPI_API_KEY in .env
    
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
    sail artisan migrate
    ```

7. Build the Vue.js frontend:

    ```
    npm run dev
    ```

8. Run Horizon:

    ```
    sail artisan horizon
    ```
