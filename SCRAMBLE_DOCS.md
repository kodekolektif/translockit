# Scramble API Documentation Setup

## Overview
Scramble has been successfully installed and configured for Translockit API documentation.

## Access Documentation

### Interactive API Documentation
Visit: **http://localhost:8000/docs/api**

This provides:
- Interactive API explorer with Stoplight Elements UI
- Full schema documentation
- All 65 API endpoints documented
- Bearer token authentication support

### OpenAPI JSON Specification
The OpenAPI spec is embedded in the UI. To export:
1. Visit http://localhost:8000/docs/api
2. Right-click and "Save As" or use browser dev tools
3. Or use: `curl http://localhost:8000/docs/api.json -o openapi.json`

## Features

### 1. Automatic Documentation
Scramble automatically generates documentation from:
- Route definitions
- Form Request validation rules
- Controller method signatures
- PHPDoc annotations

### 2. Security
- Bearer token authentication (Sanctum)
- Protected documentation access via middleware

### 3. UI Features
- **Layout**: Responsive (collapses on mobile)
- **Theme**: Light mode
- **Try It**: Enabled for testing endpoints
- **Search**: Full-text search across endpoints

## Configuration

### Config File
`config/scramble.php`

Key settings:
```php
'info' => [
    'version' => '1.0.0',
    'description' => 'Translockit REST API Documentation',
],

'ui' => [
    'title' => 'Translockit API',
    'theme' => 'light',
    'hide_try_it' => false,
    'layout' => 'responsive',
],
```

### Service Provider
`app/Providers/ScrambleServiceProvider.php`

Customizes:
- API info and version
- Server URLs
- Security schemes (Bearer token)
- Route filtering

## Documented Endpoints (65 total)

### Authentication (3)
- POST /api/login
- POST /api/logout
- GET /api/user

### Dashboard (1)
- GET /api/dashboard

### Content Management (50)
- Abouts (5 routes)
- Articles (5 routes)
- Authors (5 routes)
- Categories (5 routes)
- Brands (5 routes)
- Testimonials (5 routes)
- Software (5 routes)
- Projects (5 routes)
- Mobile Apps (5 routes)
- Mobile Lists (5 routes)
- FAQs (5 routes)

### Settings (4)
- GET /api/settings/app
- PUT /api/settings/app
- GET /api/settings/company
- PUT /api/settings/company

### Translation (2)
- POST /api/translate
- POST /api/translate/batch

## Usage Examples

### With Bearer Token
```bash
curl http://localhost:8000/docs/api.json \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Export OpenAPI Spec
```bash
curl http://localhost:8000/docs/api.json -o openapi.json
```

## Import to Tools

### Postman
1. Open Postman
2. Click Import
3. Select `openapi.json` or paste URL `http://localhost:8000/docs/api.json`

### Insomnia
1. Open Insomnia
2. Click Import
3. Select "From URL" and enter `http://localhost:8000/docs/api.json`

### Stoplight Studio
1. Open Stoplight Studio
2. Create new project
3. Import OpenAPI from URL

## Troubleshooting

### Documentation not loading
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### Missing endpoints
Ensure routes are defined in `routes/api.php` and use proper HTTP verbs.

### Authentication issues
Check `config/scramble.php` middleware settings:
```php
'middleware' => [
    'web',
    RestrictedDocsAccess::class,
],
```

## Customization

### Add Operation Extensions
Create custom extensions in `app/Extensions/Scramble/`:
```php
namespace App\Extensions\Scramble;

use Dedoc\Scramble\Extensions\OperationExtension;

class CustomExtension extends OperationExtension
{
    public function handle($operation, $routeInfo): void
    {
        // Customize operation
    }
}
```

### Add Custom Schemas
Define custom type schemas in service provider:
```php
Scramble::registerType(MyCustomType::class);
```

## Security Note

By default, Scramble uses `RestrictedDocsAccess` middleware. For production:
1. Implement proper authorization
2. Consider rate limiting
3. Use environment-based access control

Example middleware:
```php
class ApiDocsAuth
{
    public function handle($request, $next)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }
        return $next($request);
    }
}
```

## Resources

- [Scramble Documentation](https://scramble.dedoc.co/)
- [OpenAPI Specification](https://swagger.io/specification/)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
