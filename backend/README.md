# Backend bootstrap (Laravel 12)

This backend folder will contain the Laravel 12 application.

Bootstrap steps (local/dev):

1. Install dependencies (run from repository root):

   composer create-project laravel/laravel backend "12.*"

2. Copy env example and update:

   cp backend/.env.example backend/.env
   # edit DB_HOST=host.docker.internal or db, DB_DATABASE=gmbp, DB_USERNAME=gmbp, DB_PASSWORD=secret

3. Start services:

   docker-compose up -d

4. Enter workspace:

   docker-compose exec workspace bash
   cd /var/www

5. Install composer dependencies (inside container if needed):

   composer require laravel/sanctum
   composer require spatie/laravel-permission
   composer require barryvdh/laravel-dompdf
   composer require simplesoftwareio/simple-qrcode
   composer require maatwebsite/excel

6. Generate app key & migrate:

   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=InitialSeeder

7. Run queue and scheduler (in production use Supervisor):

   php artisan queue:work
   php artisan schedule:work

Notes
- This repo will include migrations, seeders, models, controllers and API routes for Users, Businesses, Permits, Payments, Documents, AuditLogs, and more.
