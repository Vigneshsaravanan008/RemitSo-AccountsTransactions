# **RemitSo Accounts Transactions - Laravel Project**

This project is a Laravel-based application designed for managing **Accounts Transactions**. It uses **Laravel Passport** for API authentication and includes the necessary migrations, seeders, and configuration for setting up the default user and database.

## **Requirements**

- PHP >= 8.2
- Composer
- MySQL (or any compatible database)
---

## **Installation**

### 1. **Clone the Repository**

Clone the project repository to your local machine:
and I mentioned the **.env** file in **.env.example** you can refer

```bash
git clone https://github.com/Vigneshsaravanan008/RemitSo-AccountsTransactions.git
```
Go to the particular path
```bash
cd RemitSo-AccountsTransactions
```
## 2. **Install Dependencies**

Install all the required Composer dependencies for the project:

```bash
composer install
php artisan migrate --seed
php artisan passport:keys
```
Once Migrate,I added database seeder, Below I mentioned the credentials

```php
$credentials = [
    "email" => "remitso@gmail.com",
    "password" => "12345678"
]
```
I Added the Postman Collections Links also
``` javascript
const URL = 'https://api.postman.com/collections/12923541-9f9c2602-2e77-480e-8e41-2d966b47902f?access_key=PMAT-01JQC3S7ZPFSYP8H09NT48NV9H'
```