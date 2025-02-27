# Employee Task Reporting System

## Overview
The **Employee Task Reporting System** is a web application for employees to submit and manage their daily task reports securely. It includes role-based authentication, task approvals, and reporting features such as filtering, exporting, and scheduled reports.

---

## Features

### 📝 Task Submission
- Employees can submit daily task reports with **Date, Employee Name, Department, Task Details, and Hours Worked**.
- **Server-side validation** ensures all fields are correctly filled.
- Employees can **edit** their reports within **24 hours** after submission. After that, the report is **locked**.

### 📊 Dashboard & Filtering
- Displays a **summary of all submitted tasks** for the day, including Employee Name, Department, and Hours Worked.
- Users can **filter tasks** by **Department, Employee Name, or Date Range**.

### 📂 Data Export
- **Export reports** to **PDF and Excel** formats.
- **Automated daily reports** are generated and emailed to department heads.

### 🔒 Authentication & Role Management
- **User authentication** is implemented using Laravel's built-in authentication system.
- Users are assigned roles:  
  - **Employee** – Can submit and edit their own reports.  
  - **Manager** – Can review and approve/reject task reports.  
  - **Admin** – Can manage users, view all reports, and access all system features.  
- **Role-based access control** (RBAC) ensures users only access authorized features.

### ✅ Task Approval Workflow
- **Managers must approve** submitted tasks before finalization.
- Managers can **approve or reject** tasks with comments.

---

## 🔧 Installation

### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/tripletens/capplc-test.git
```

cd capplc-test
# Employee Task Reporting System - Installation Guide

### **2️⃣ Install Dependencies**
Run the following commands to install project dependencies:

```sh
composer install
npm install && npm run dev
```

###  **3️⃣ Set Up Environment Variables**
Copy the .env.example file and rename it to .env, then generate the application key:

```sh
cp .env.example .env
php artisan key:generate
```
###  4️⃣ Configure Database
Update the .env file with your database credentials, then run migrations and seed the database:

```sh
php artisan migrate --seed
```
###  5️⃣ Start the Application
Run the following command to start the Laravel development server:

```sh
php artisan serve
Access the app at http://localhost:8000.
```