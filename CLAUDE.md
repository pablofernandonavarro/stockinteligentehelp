# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 11 application for "Stock Inteligente" help desk/support system. It uses:
- **Laravel Jetstream** for authentication and user management
- **Laravel AdminLTE** for the admin panel UI
- **Livewire 3** for reactive components
- **Spatie Laravel Permission** for role-based access control
- **Tailwind CSS** for styling

The application manages FAQs, customers, branches, news articles, and blog posts with a public-facing website and administrative backend.

## Development Environment

This project runs on **XAMPP** (Windows environment) with:
- PHP 8.2+
- MySQL database
- Timezone: America/Argentina/Buenos_Aires

## Common Commands

### Development
```bash
# Start development server
php artisan serve

# Watch and compile assets
npm run dev

# Build assets for production
npm run build
```

### Database
```bash
# Run migrations
php artisan migrate

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Rollback last migration
php artisan migrate:rollback
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Run tests
php artisan test
```

### Permissions & Cache
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Regenerate autoload files (run after structural changes)
composer dump-autoload

# Sync permissions (after adding new roles/permissions)
php artisan permission:cache-reset
```

## Code Architecture

### Dual Controller Pattern
The application has a dual-layer controller architecture:

1. **Public Controllers** (`app/Http/Controllers/`): Handle public-facing pages
   - `PostController` - Blog posts for public
   - `NewsController` - News articles for public
   - `FaqController` - FAQ submission and viewing

2. **Admin Controllers** (`app/Http/Controllers/Admin/`): Handle admin panel CRUD operations
   - `PostController` - Manage blog posts
   - `NewsController` - Manage news articles
   - `FaqController` - Manage FAQs
   - `CategoryController` - Manage categories
   - `EtiquetaController` - Manage tags (etiquetas)
   - `CustomerController` - Manage customers
   - `UserController` - Manage users
   - `RoleController` - Manage roles & permissions
   - `HomeController` - Admin dashboard

### Livewire Components
Livewire components are used for interactive admin interfaces:
- `Admin\Faqindex` - FAQ listing with search/filter
- `Admin\Customers` - Customer management
- `Admin\Customershow` - Customer details
- `Admin\UsersIndex` - User management
- `Admin\PostsIndex` - Post management
- `Navigation` - Public navigation
- `Branchshow` - Branch details display

### Routing Structure
- `routes/web.php` - Public-facing routes (news, posts, FAQs, contact)
- `routes/admin.php` - Admin panel routes (prefixed with admin middleware)
- `routes/api.php` - API routes
- `routes/console.php` - Artisan commands

Admin routes are grouped separately and use Laravel resource controllers for standard CRUD operations.

### Key Models & Relationships
- **Post** - belongs to Category, has many Etiquetas (tags), has many Images
- **News** - News articles
- **Faq** - FAQ entries with `created_by` user tracking and `company` field
- **Customer** - has many Branches
- **Branch** - belongs to Customer, stores AnyDesk password
- **Category** - has many Posts
- **Etiqueta** - many-to-many with Posts (tags)
- **Image** - polymorphic relation (can belong to Posts or other models)
- **User** - uses Spatie permissions for role-based access

### Important Notes

#### PSR-4 Autoloading
The `app/Http/Controllers/Admin` directory MUST have capital "A" in "Admin" to comply with PSR-4 autoloading standards. This is critical for deployment on Linux servers where filesystem is case-sensitive. Always ensure:
- Directory name: `app/Http/Controllers/Admin/`
- Namespace: `App\Http\Controllers\Admin`

After renaming directories or making structural changes, always run:
```bash
composer dump-autoload
```

#### Case Sensitivity
Some route files still have lowercase imports (`use App\Http\Controllers\admin\...`) which should be updated to use capital `Admin`. When working with admin controllers, always use the correct case.

#### Database Sessions
The application uses database driver for sessions. The `sessions` table migration was added to fix error 500 issues.

## Testing

Run the full test suite:
```bash
php artisan test
```

Run specific test:
```bash
php artisan test --filter TestName
```

## Git Workflow

- **main** - Rama principal de desarrollo
- **produccion** - Rama utilizada para deployment en el servidor

Al hacer deployment, mergear los cambios de `main` a `produccion` y hacer push de `produccion`.

## Deployment Notes

When deploying to production (Linux server):
1. Ensure all namespace capitalizations match directory names (PSR-4 compliance)
2. Run `composer dump-autoload --optimize`
3. Run migrations: `php artisan migrate --force`
4. Clear and cache config: `php artisan config:cache`
5. Build assets: `npm run build`
6. Set proper permissions on `storage/` and `bootstrap/cache/`
