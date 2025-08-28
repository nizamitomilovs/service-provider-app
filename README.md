# Service Provider Directory

## 🚀 Quick Start

### Prerequisites

- **Docker & Docker Compose** (latest version)
- **Make** (for using the provided Makefile commands)
- **Git**

### Docker Setup

The fastest way to get started using Docker:

# Start the development environment
make dev
```

This single command will:
- Start all required services (Laravel, MySQL, Redis, Nginx)
- Install PHP and Node dependencies
- Set up the Laravel application
- Run database migrations and seeders
- Build frontend assets

Your application will be available at: **http://localhost:8002**

```

# Performance Focused Review

## 🏗️ Architecture & Design Decisions
### MVC Pattern Implementation
- **Controllers**: Lightweight controllers focused on HTTP request handling and response formatting
- **Models**: Rich Eloquent models with proper relationships and accessors
- **Views**: Blade templates with component-based architecture for reusability

### Database Design Philosophy
- **Normalized Structure**: Proper foreign key relationships between categories and providers
- **UUID Primary Keys**: Using UUID7 for better distribution, security, and scalability
- **Indexing**: Indexes on frequently queried columns for optimal performance

### Repository Pattern
- **Interface-based Design**: Abstracted data access through `ProviderRepositoryInterface`

## ⚡ Performance Optimizations

### Database Performance
- **Eager Loading**: All relationships loaded in single queries to prevent N+1 problems
  ```php
  Provider::with('category')->paginate(12);
  ```
- **Selective Field Loading**: Only necessary fields selected from related models
  ```php
    $query->select('id', 'name', 'slug')->get();
  ```
- **Query Result Caching**: Frequently accessed data cached to reduce database load
  ```php
  $categories = Cache::remember('categories', 3600, function () {
      ...
  });
  ```
**Lazy Loading**: Images loaded only when needed
  ```html
  <img src="placeholder.jpg" data-src="actual-image.jpg" loading="lazy">
  ```

**Minimal Critical CSS**: Only essential styles inlined to reduce initial payload

## 🚀 Areas for Future Enhancement
- **Caching**: Add tag invalidation, cache products
- **Caching Implementation**: The current implementation has some basic caching in the CategoryService, but a more comprehensive and unified approach would be more beneficial in the future 
- **RESTful API**: Moving to vue and API structure
- **Image loading**: Optimize image loading
