
# Installation
```bash
git clone git@github.com:aymanalhattami/filament-context-menu-project.git

or 

git clone https://github.com/aymanalhattami/filament-context-menu-project.git
```

```bash
cd filament-context-menu-project
```

```bash
composer install
```

```bash
copy .env.example .env
```

Create database and prepare database connection

```bash
php artisan key:generate
```

```bash
php artisan migrate --seed
```

```bash
php artisan serve
```

```bash
email: admin@admin.com
password: password
```

Then, go to /admin/login
