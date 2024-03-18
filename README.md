
## Tech / Framework used

### Frontend - Vue 3 and Vite

- Vue.js 3
- Vuex for state management
- Vue Router for routing
- Axios for HTTP requests
- Vue Tags Input for managing interests
- Vue Sweetalert2 for displaying alerts

### Backend - Laravel 9 with Sanctum

- Laravel Sanctum for API authentication
- Laravel Eloquent for database interaction
- Laravel Validation for form validation
- Laravel Mail for sending email notifications

## Getting Started

### Backend Setup - Laravel

```bash
# Clone this repository
git clone https://github.com/your/repository.git

# Navigate to the backend directory
cd backend

# Install Composer dependencies
composer install

# Copy the .env.example file and rename it to .env
cp .env.example .env

# Generate application key
php artisan key:generate

# Migrate the database
php artisan migrate

# Serve the Laravel application
php artisan serve
```

### Backend Setup - Laravel

```bash
Before using the app, setup email using your SMTP details.
I used mailtrap.io
```

### Backend File Structure

```bash

backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PersonController.php
├── database/
│   ├── migrations/
│   │   ├── xxxx_xx_xx_xxxxxx_create_persons_table.php
├── routes/
│   ├── api.php

```

### Frontend Setup - Vue 3

```bash

# Install NPM dependencies
npm install

# Run the Vue 3 application
npm run dev
```

### Frontend File Structure - Vue 3

```bash
frontend/
├── src/
│   ├── components/
│   │   ├── errors/
│   │   │   ├── NotFound.vue
│   ├── layouts/
│   │   ├── Default.vue
│   ├── persons/
│   │   ├── AddPerson.vue
│   │   ├── EditPerson.vue
│   ├── Dashboard.vue
│   ├── Login.vue
│   ├── Register.vue
├── router/
│   ├── index.js
├── store/
│   ├── index.js
├── App.vue

```
