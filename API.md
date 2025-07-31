# API Documentation

This document provides detailed information about the API endpoints for user authentication, service management, and booking operations. All endpoints return JSON responses and use JWT authentication where applicable.

## Base URL
```
http://api.example.com
```

## Authentication Header
For endpoints requiring authentication, include the JWT token in the `Authorization` header:
```
Authorization: Bearer {your_token}
```

---

## Authentication Endpoints

### 1. Register
Register a new user with the role of 'customer'.

- **URL**: `/api/register`
- **Method**: `POST`
- **Content-Type**: `application/json`
- **Parameters**:
  - `name` (string, required, max:255): User's full name
  - `email` (string, required, email, max:255, unique): User's email address
  - `password` (string, required, min:8): User's password
  - `password_confirmation` (string, required): Confirmation of the password
- **Response**:
  - **201 Created**:
    ```json
    {
        "success": true,
        "message": "User registered successfully",
        "data": {
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "role": "customer"
            },
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
            "token_type": "bearer"
        }
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Registration failed"
    }
    ```

### 2. Login
Authenticate a user and return a JWT token.

- **URL**: `/api/login`
- **Method**: `POST`
- **Content-Type**: `application/json`
- **Parameters**:
  - `email` (string, required, email): User's email address
  - `password` (string, required): User's password
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "Login successful",
        "data": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
            "token_type": "bearer",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "role": "customer"
            }
        }
    }
    ```
  - **401 Unauthorized**:
    ```json
    {
        "success": false,
        "message": "Invalid credentials",
        "errors": {
            "email": ["These credentials do not match our records."]
        }
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Login failed",
        "error": "Internal server error"
    }
    ```

### 3. Logout
Invalidate the current JWT token.

- **URL**: `/api/logout`
- **Method**: `POST`
- **Authentication**: Required
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "Successfully logged out"
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Logout failed"
    }
    ```

### 4. Get User Profile
Retrieve the authenticated user's profile information.

- **URL**: `/api/me`
- **Method**: `GET`
- **Authentication**: Required
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "User profile retrieved",
        "data": {
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "role": "customer"
            },
            "meta": {
                "created_at": "2025-07-31 10:42:00",
                "updated_at": "2025-07-31 10:42:00"
            }
        }
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to retrieve user profile",
        "error": "Internal server error"
    }
    ```

---

## Service Endpoints

### 5. List Services
Retrieve a list of active services.

- **URL**: `/api/services`
- **Method**: `GET`
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "Services retrieved successfully",
        "data": [
            {
                "id": 1,
                "name": "Service Name",
                "description": "Service description",
                "price": 99.99,
                "status": true,
                "created_at": "2025-07-31 10:42:00",
                "updated_at": "2025-07-31 10:42:00"
            }
        ],
        "meta": {
            "count": 1
        }
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to retrieve services",
        "error": "Internal server error"
    }
    ```

### 6. Create Service
Create a new service (admin only).

- **URL**: `/api/services`
- **Method**: `POST`
- **Authentication**: Required (admin role)
- **Content-Type**: `application/json`
- **Parameters**:
  - `name` (string, required, max:255): Service name
  - `description` (string, nullable): Service description
  - `price` (numeric, required, min:0): Service price
  - `status` (boolean, optional): Service status (true/false)
- **Response**:
  - **201 Created**:
    ```json
    {
        "success": true,
        "message": "Service created successfully",
        "data": {
            "id": 1,
            "name": "Service Name",
            "description": "Service description",
            "price": 99.99,
            "status": true,
            "created_at": "2025-07-31 10:42:00",
            "updated_at": "2025-07-31 10:42:00"
        }
    }
    ```
  - **403 Forbidden**:
    ```json
    {
        "success": false,
        "message": "Unauthorized"
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to create service",
        "error": "Internal server error"
    }
    ```

### 7. Update Service
Update an existing service (admin only).

- **URL**: `/api/services/{id}`
- **Method**: `PUT`
- **Authentication**: Required (admin role)
- **Content-Type**: `application/json`
- **Parameters**:
  - `name` (string, required, max:255): Service name
  - `description` (string, nullable): Service description
  - `price` (numeric, required, min:0): Service price
  - `status` (boolean, required): Service status (true/false)
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "Service updated successfully",
        "data": {
            "id": 1,
            "name": "Updated Service Name",
            "description": "Updated description",
            "price": 149.99,
            "status": true,
            "created_at": "2025-07-31 10:42:00",
            "updated_at": "2025-07-31 10:43:00"
        }
    }
    ```
  - **403 Forbidden**:
    ```json
    {
        "success": false,
        "message": "Unauthorized"
    }
    ```
  - **404 Not Found**:
    ```json
    {
        "success": false,
        "message": "Service not found"
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to update service",
        "error": "Internal server error"
    }
    ```

### 8. Delete Service
Delete a service (admin only).

- **URL**: `/api/services/{id}`
- **Method**: `DELETE`
- **Authentication**: Required (admin role)
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "Service deleted successfully"
    }
    ```
  - **403 Forbidden**:
    ```json
    {
        "success": false,
        "message": "Unauthorized"
    }
    ```
  - **404 Not Found**:
    ```json
    {
        "success": false,
        "message": "Service not found"
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to delete service",
        "error": "Internal server error"
    }
    ```

---

## Booking Endpoints

### 9. List Bookings
Retrieve all bookings for the authenticated user.

- **URL**: `/api/bookings`
- **Method**: `GET`
- **Authentication**: Required
- **Response**:
  - **200 OK**:
    ```json
    {
        "success": true,
        "message": "Bookings retrieved successfully",
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "service_id": 1,
                "booking_date": "2025-08-01",
                "status": "pending",
                "created_at": "2025-07-31 10:42:00",
                "updated_at": "2025-07-31 10:42:00",
                "service": {
                    "id": 1,
                    "name": "Service Name",
                    "description": "Service description",
                    "price": 99.99,
                    "status": true
                }
            }
        ],
        "meta": {
            "count": 1
        }
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to retrieve bookings"
    }
    ```

### 10. Create Booking
Create a new booking for the authenticated user.

- **URL**: `/api/bookings`
- **Method**: `POST`
- **Authentication**: Required
- **Content-Type**: `application/json`
- **Parameters**:
  - `service_id` (integer, required, exists): ID of the service to book
  - `booking_date` (date, required, after_or_equal:today): Date of the booking
- **Response**:
  - **201 Created**:
    ```json
    {
        "success": true,
        "message": "Booking created successfully",
        "data": {
            "id": 1,
            "user_id": 1,
            "service_id": 1,
            "booking_date": "2025-08-01",
            "status": "pending",
            "created_at": "2025-07-31 10:42:00",
            "updated_at": "2025-07-31 10:42:00"
        }
    }
    ```
  - **500 Internal Server Error**:
    ```json
    {
        "success": false,
        "message": "Failed to create booking",
        "error": "Internal server error"
    }
    ```

---

## Error Handling
- All endpoints return a `success` boolean to indicate the outcome.
- Error responses include a `message` and, in some cases, an `error` field with details (visible when `APP_DEBUG` is true).
- Common HTTP status codes:
  - `200`: OK
  - `201`: Created
  - `401`: Unauthorized (invalid credentials)
  - `403`: Forbidden (e.g., non-admin accessing admin routes)
  - `404`: Not Found
  - `500`: Internal Server Error
