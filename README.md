# Master Data Management (MDM) System

## Project Overview
The **Master Data Management (MDM) System** is a web-based PHP application built using **PHP, MySQL**, and optionally a PHP framework. It allows authenticated users to manage Brands, Categories, and Items with full CRUD operations. The system also implements role-based access control for admins and standard users.

---

## Features

### User Authentication
- User Registration, Login, and Logout
- Access control: Only authenticated users can access the application
- Role-based access (Admin / Regular User)

### Master Data Management
**Brands**
- Create, Read, Update, Delete (CRUD) brands
- View list of brands with pagination (5 per page)
- Confirmation alerts before deletion

**Categories**
- CRUD operations for categories
- Paginated list (5 per page)
- Confirmation alerts before deletion

**Items**
- CRUD operations for items
- Associate items with brands and categories
- File attachment support
- Paginated list (5 per page)
- Confirmation alerts before deletion

### Advanced Features (Optional)
- Search items by code, name, or status
- Export items to CSV, Excel, or PDF

---
