# Agent Guidelines for Laravel Blog

## Project Overview
This is a Laravel 10 PHP application with Vite frontend tooling. Standard Laravel directory structure with Models, Controllers, Middleware, and Tests.

## Build/Lint/Test Commands

### PHP (Laravel)
```bash
# Run all tests
./vendor/bin/phpunit

# Run a single test file
./vendor/bin/phpunit tests/Unit/ExampleTest.php

# Run tests matching a filter (method name or class)
./vendor/bin/phpunit --filter test_the_application_returns_a_successful_response
./vendor/bin/phpunit --filter ExampleTest

# Run only Unit tests
./vendor/bin/phpunit --testsuite Unit

# Run only Feature tests
./vendor/bin/phpunit --testsuite Feature

# Lint/PHP code style (Laravel Pint)
./vendor/bin/pint

# Lint with verbose output
./vendor/bin/pint -v

# Lint specific file
./vendor/bin/pint app/Models/User.php
```

### Frontend (Vite)
```bash
# Install dependencies
npm install

# Development server
npm run dev

# Production build
npm run build
```

## Code Style Guidelines

### PHP Conventions
- **Indentation**: 4 spaces (per `.editorconfig`)
- **Line endings**: LF
- **Charset**: UTF-8
- **Opening PHP tag**: `<?php` (not short tags)
- **Always add newline at end of file**

### Naming Conventions
| Element | Convention | Example |
|---------|------------|---------|
| Classes | PascalCase | `UserController`, `BlogService` |
| Methods | camelCase | `getUser()`, `storePost()` |
| Variables | camelCase | `$userData`, `$blogPost` |
| Database tables | snake_case (plural) | `blog_posts`, `user_profiles` |
| Database columns | snake_case | `created_at`, `user_id` |
| Controllers | Singular + "Controller" | `PostController`, not `PostsController` |
| Models | PascalCase (singular) | `User`, `BlogPost` |
| Traits | PascalCase (adjective/noun) | `HasFactory`, `Notifiable` |
| Test classes | PascalCase + "Test" suffix | `UserControllerTest` |
| Test methods | snake_case with "test_" prefix | `test_user_can_login()` |

### File Organization
```
app/
├── Console/Kernel.php
├── Exceptions/Handler.php
├── Http/
│   ├── Controllers/
│   │   └── [Feature]Controller.php
│   ├── Kernel.php
│   └── Middleware/
├── Models/
│   └── [Model].php
└── Providers/
```

### Imports
- Use fully qualified class names in `use` statements
- Group imports: Laravel framework imports first, then third-party, then local
- Sort alphabetically within groups

### Types & Annotations
- Use PHP 8.1+ native return types when possible
- Add docblocks for complex methods with `@param` and `@return`
- Use `@var` for property type hints in docblocks
- Use Laravel's `array<int, string>` syntax for typed arrays

### Error Handling
- Let Laravel exceptions bubble to `Handler.php`
- Use `try/catch` only when necessary with specific exceptions
- Use `abort()` or `throw new \Exception()` for expected error cases
- Return appropriate HTTP status codes (404, 403, 422, 500)

### Eloquent Models
```php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [];
    protected $hidden = [];
    protected $casts = [];
}
```

### Controllers
- Use dependency injection via constructor or method parameters
- Single responsibility: one action per method
- Use Form Request classes for validation
- Return appropriate response types (view, json, redirect)

### Testing Patterns
```php
// Feature tests - extend Tests\TestCase
class UserControllerTest extends TestCase
{
    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(201);
    }
}

// Unit tests - extend PHPUnit\Framework\TestCase
class CalculatorTest extends TestCase
{
    public function test_addition(): void
    {
        $this->assertEquals(4, 2 + 2);
    }
}
```

### Routes
- Use RESTful resource routes when appropriate
- Group routes by feature with `Route::prefix()`
- Use named routes for easier testing

### Security
- Never expose secrets in code; use `.env` and `config()`
- Always use CSRF protection for web forms
- Validate and sanitize all user input
- Use prepared statements (Eloquent handles this)

## Git Workflow
- Create feature branches from `main`
- Commit often with clear messages
- Run tests before pushing: `./vendor/bin/phpunit`
- Run lint before committing: `./vendor/bin/pint`

## Common Patterns

### Dependency Injection
```php
class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {}

    public function store(StorePostRequest $request): RedirectResponse
    {
        $this->postService->create($request->validated());
        return redirect()->route('posts.index');
    }
}
```

### Form Requests for Validation
```php
class StorePostRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];
    }
}
```
