# Eventurs API

## Description

This is the API for Eventurs. It is a RESTful API that is used to create, read, update, and delete events and users. It is build using Laravel and MySQL.

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `cp .env.example .env`
4. Run `php artisan key:generate`
5. Create a MySQL database `eventursdb` and add the credentials to the `.env` file
6. Run `php artisan migrate`

## Usage

### API Endpoints

#### Authentication

**Logging an account**
**POST** - localhost:8000/api/login
Request:

```json
{
    "email": [your email],
    "password": [your password]
}
```

Response:

```json
{
    "message": "Login successful",
    "access_token": [token]
}
```

**Registering an account**
**POST** - localhost:8000/api/register
Request:

```json
{
    "name": [your name],
    "email": [your email],
    "password": [your password],
    "password_confirmation": [your password]
}
```

Response

```json
{
    "message": "User successfully created",
    "access_token": [token]
}
```
