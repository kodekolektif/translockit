# Translockit API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
All protected endpoints require Bearer token authentication. Include the token in the Authorization header:
```
Authorization: Bearer {your-access-token}
```

---

## Table of Contents
1. [Authentication](#authentication-endpoints)
2. [Dashboard](#dashboard)
3. [About](#about)
4. [Articles](#articles)
5. [Authors](#authors)
6. [Categories](#categories)
7. [Brands](#brands)
8. [Testimonials](#testimonials)
9. [Software](#software)
10. [Projects](#projects)
11. [Mobile Apps](#mobile-apps)
12. [Mobile Lists](#mobile-lists)
13. [FAQs](#faqs)
14. [Settings](#settings)
15. [Translation](#translation)

---

## Authentication Endpoints

### Login
**POST** `/api/login`

Get access token for authentication.

**Request Body:**
```json
{
  "email": "user@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "user@example.com"
    },
    "access_token": "1|abc123...",
    "token_type": "Bearer"
  }
}
```

---

### Logout
**POST** `/api/logout`

Revoke current access token.

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "message": "Successfully logged out"
}
```

---

### Get Current User
**GET** `/api/user`

Get authenticated user details.

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "user@example.com"
    }
  }
}
```

---

## Dashboard

### Get Dashboard Stats
**GET** `/api/dashboard`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "data": {
    "total_users": 5,
    "total_articles": 23,
    "total_categories": 8,
    "active_sessions": 3
  }
}
```

---

## About

### List All Abouts
**GET** `/api/abouts`

**Headers:** `Authorization: Bearer {token}`

### Create About
**POST** `/api/abouts`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "image": "file (optional)",
  "title": {
    "en": "About Title",
    "es": "Título Acerca de"
  },
  "description": {
    "en": "Description text",
    "es": "Texto de descripción"
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single About
**GET** `/api/abouts/{uniqueId}`

### Update About
**PUT/PATCH** `/api/abouts/{uniqueId}`

### Delete About
**DELETE** `/api/abouts/{uniqueId}`

---

## Articles

### List All Articles
**GET** `/api/articles`

**Headers:** `Authorization: Bearer {token}`

### Create Article
**POST** `/api/articles`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "thumbnail": "file (optional)",
  "title": {
    "en": "Article Title",
    "es": "Título del Artículo"
  },
  "content": {
    "en": "Article content here...",
    "es": "Contenido del artículo aquí..."
  },
  "tags": ["tag1", "tag2"],
  "category_id": "uuid-of-category",
  "author_id": "uuid-of-author",
  "is_published": true,
  "published_at": "2026-02-22",
  "lang": "en"
}
```

### Get Single Article
**GET** `/api/articles/{uniqueId}`

### Update Article
**PUT/PATCH** `/api/articles/{uniqueId}`

### Delete Article
**DELETE** `/api/articles/{uniqueId}`

---

## Authors

### List All Authors
**GET** `/api/authors`

**Headers:** `Authorization: Bearer {token}`

### Create Author
**POST** `/api/authors`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "profile": "file (optional)",
  "name": "John Doe",
  "title": {
    "en": "Senior Writer",
    "es": "Escritor Senior"
  },
  "description": {
    "en": "Bio text",
    "es": "Texto de biografía"
  },
  "social_links": {
    "facebook": "https://facebook.com/...",
    "twitter": "https://twitter.com/...",
    "linkedin": "https://linkedin.com/..."
  },
  "lang": "en"
}
```

### Get Single Author
**GET** `/api/authors/{uniqueId}`

### Update Author
**PUT/PATCH** `/api/authors/{uniqueId}`

### Delete Author
**DELETE** `/api/authors/{uniqueId}`

---

## Categories

### List All Categories
**GET** `/api/categories`

**Headers:** `Authorization: Bearer {token}`

### Create Category
**POST** `/api/categories`

**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
  "name": {
    "en": "Technology",
    "es": "Tecnología"
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single Category
**GET** `/api/categories/{uniqueId}`

### Update Category
**PUT/PATCH** `/api/categories/{uniqueId}`

### Delete Category
**DELETE** `/api/categories/{uniqueId}`

---

## Brands

### List All Brands
**GET** `/api/brands`

**Headers:** `Authorization: Bearer {token}`

### Create Brand
**POST** `/api/brands`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "logo": "file (required)",
  "brand_name": "Company Name",
  "is_active": true
}
```

### Get Single Brand
**GET** `/api/brands/{id}`

### Update Brand
**PUT/PATCH** `/api/brands/{id}`

### Delete Brand
**DELETE** `/api/brands/{id}`

---

## Testimonials

### List All Testimonials
**GET** `/api/testimonials`

**Headers:** `Authorization: Bearer {token}`

### Create Testimonial
**POST** `/api/testimonials`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "image": "file (optional)",
  "name": {
    "en": "John Doe",
    "es": "John Doe"
  },
  "title": {
    "en": "CEO",
    "es": "Director Ejecutivo"
  },
  "content": {
    "en": "Great service!",
    "es": "¡Gran servicio!"
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single Testimonial
**GET** `/api/testimonials/{uniqueId}`

### Update Testimonial
**PUT/PATCH** `/api/testimonials/{uniqueId}`

### Delete Testimonial
**DELETE** `/api/testimonials/{uniqueId}`

---

## Software

### List All Software
**GET** `/api/software`

**Headers:** `Authorization: Bearer {token}`

### Create Software
**POST** `/api/software`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "logo": "file (required)",
  "name": "Software Name",
  "description": {
    "en": "Description",
    "es": "Descripción"
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single Software
**GET** `/api/software/{uniqueId}`

### Update Software
**PUT/PATCH** `/api/software/{uniqueId}`

### Delete Software
**DELETE** `/api/software/{uniqueId}`

---

## Projects

### List All Projects
**GET** `/api/projects`

**Headers:** `Authorization: Bearer {token}`

### Create Project
**POST** `/api/projects`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "image": "file (required)",
  "name": {
    "en": "Project Name",
    "es": "Nombre del Proyecto"
  },
  "description": {
    "en": "Description",
    "es": "Descripción"
  },
  "service_id": "uuid (optional)",
  "is_active": true,
  "lang": "en"
}
```

### Get Single Project
**GET** `/api/projects/{uniqueId}`

### Update Project
**PUT/PATCH** `/api/projects/{uniqueId}`

### Delete Project
**DELETE** `/api/projects/{uniqueId}`

---

## Mobile Apps

### List All Mobile Apps
**GET** `/api/mobile-apps`

**Headers:** `Authorization: Bearer {token}`

### Create Mobile App
**POST** `/api/mobile-apps`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "image": "file (required)",
  "title": {
    "en": "App Name",
    "es": "Nombre de App"
  },
  "description": {
    "en": "Description",
    "es": "Descripción"
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single Mobile App
**GET** `/api/mobile-apps/{uniqueId}`

### Update Mobile App
**PUT/PATCH** `/api/mobile-apps/{uniqueId}`

### Delete Mobile App
**DELETE** `/api/mobile-apps/{uniqueId}`

---

## Mobile Lists

### List All Mobile Lists
**GET** `/api/mobile-lists`

**Headers:** `Authorization: Bearer {token}`

### Create Mobile List
**POST** `/api/mobile-lists`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "logo": "file (required)",
  "title": {
    "en": "List Title",
    "es": "Título de Lista"
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single Mobile List
**GET** `/api/mobile-lists/{uniqueId}`

### Update Mobile List
**PUT/PATCH** `/api/mobile-lists/{uniqueId}`

### Delete Mobile List
**DELETE** `/api/mobile-lists/{uniqueId}`

---

## FAQs

### List All FAQs
**GET** `/api/faqs`

**Headers:** `Authorization: Bearer {token}`

### Create FAQ
**POST** `/api/faqs`

**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
  "question": {
    "en": "What is your service?",
    "es": "¿Cuál es su servicio?"
  },
  "answer": {
    "en": "We provide...",
    "es": "Proporcionamos..."
  },
  "is_active": true,
  "lang": "en"
}
```

### Get Single FAQ
**GET** `/api/faqs/{uniqueId}`

### Update FAQ
**PUT/PATCH** `/api/faqs/{uniqueId}`

### Delete FAQ
**DELETE** `/api/faqs/{uniqueId}`

---

## Settings

### Get App Settings
**GET** `/api/settings/app`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "data": {
    "title": "My App",
    "description": "App description",
    "keywords": "keyword1, keyword2",
    "favicon": "/storage/settings/favicon.ico",
    "logo": "/storage/settings/logo.png",
    "logo_dark": "/storage/settings/logo_dark.png",
    "default_language": "en",
    "default_target_language": "es",
    "translation_ai_service": "gemini",
    "gemini_api_key": "***",
    "gemini_api_url": "https://...",
    "openai_api_key": "***",
    "openai_api_url": "https://..."
  }
}
```

### Update App Settings
**PUT** `/api/settings/app`

**Headers:** `Authorization: Bearer {token}`  
**Content-Type:** `multipart/form-data`

**Request Body:**
```json
{
  "title": "My App",
  "description": "App description",
  "favicon": "file (optional)",
  "logo": "file (optional)",
  "logo_dark": "file (optional)",
  "default_language": "en",
  "default_target_language": "es",
  "translation_ai_service": "gemini"
}
```

---

### Get Company Settings
**GET** `/api/settings/company`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "data": {
    "phone": "+1234567890",
    "email": "info@company.com",
    "address": "123 Street, City",
    "google_map_url": "https://maps.google.com/...",
    "embed_google_url": "https://www.google.com/maps/embed?..."
  }
}
```

### Update Company Settings
**PUT** `/api/settings/company`

**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
  "phone": "+1234567890",
  "email": "info@company.com",
  "address": "123 Street, City",
  "google_map_url": "https://...",
  "embed_google_url": "https://..."
}
```

---

## Translation

### Translate Text
**POST** `/api/translate`

**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
  "text": "Hello World",
  "target_language": "es"
}
```

**Supported Languages:** `en`, `es`, `fr`, `de`, `it`, `pt`, `zh`, `ja`, `ko`, `ru`, `ar`

**Response:**
```json
{
  "success": true,
  "data": {
    "original_text": "Hello World",
    "translated_text": "Hola Mundo",
    "target_language": "es"
  }
}
```

---

### Batch Translate
**POST** `/api/translate/batch`

**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
  "texts": ["Hello", "Welcome", "Goodbye"],
  "target_language": "es"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "translations": [
      {"original_text": "Hello", "translated_text": "Hola"},
      {"original_text": "Welcome", "translated_text": "Bienvenido"},
      {"original_text": "Goodbye", "translated_text": "Adiós"}
    ],
    "target_language": "es"
  }
}
```

---

## Error Responses

### 401 Unauthorized
```json
{
  "success": false,
  "message": "Unauthenticated."
}
```

### 404 Not Found
```json
{
  "success": false,
  "message": "Resource not found"
}
```

### 422 Validation Error
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

### 500 Server Error
```json
{
  "success": false,
  "message": "Server error message"
}
```

---

## Complete Route List

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/login` | Login |
| POST | `/api/logout` | Logout |
| GET | `/api/user` | Get current user |
| GET | `/api/dashboard` | Dashboard stats |
| GET/POST | `/api/abouts` | List/Create About |
| GET/PUT/DELETE | `/api/abouts/{id}` | About CRUD |
| GET/POST | `/api/articles` | List/Create Articles |
| GET/PUT/DELETE | `/api/articles/{id}` | Article CRUD |
| GET/POST | `/api/authors` | List/Create Authors |
| GET/PUT/DELETE | `/api/authors/{id}` | Author CRUD |
| GET/POST | `/api/categories` | List/Create Categories |
| GET/PUT/DELETE | `/api/categories/{id}` | Category CRUD |
| GET/POST | `/api/brands` | List/Create Brands |
| GET/PUT/DELETE | `/api/brands/{id}` | Brand CRUD |
| GET/POST | `/api/testimonials` | List/Create Testimonials |
| GET/PUT/DELETE | `/api/testimonials/{id}` | Testimonial CRUD |
| GET/POST | `/api/software` | List/Create Software |
| GET/PUT/DELETE | `/api/software/{id}` | Software CRUD |
| GET/POST | `/api/projects` | List/Create Projects |
| GET/PUT/DELETE | `/api/projects/{id}` | Project CRUD |
| GET/POST | `/api/mobile-apps` | List/Create Mobile Apps |
| GET/PUT/DELETE | `/api/mobile-apps/{id}` | Mobile App CRUD |
| GET/POST | `/api/mobile-lists` | List/Create Mobile Lists |
| GET/PUT/DELETE | `/api/mobile-lists/{id}` | Mobile List CRUD |
| GET/POST | `/api/faqs` | List/Create FAQs |
| GET/PUT/DELETE | `/api/faqs/{id}` | FAQ CRUD |
| GET/PUT | `/api/settings/app` | App Settings |
| GET/PUT | `/api/settings/company` | Company Settings |
| POST | `/api/translate` | Translate text |
| POST | `/api/translate/batch` | Batch translate |

**Total: 65 API Routes**
