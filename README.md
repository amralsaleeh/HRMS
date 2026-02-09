[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<p align="center">
  <a href="https://github.com/amralsaleeh/HRMS">
    <img src="public/assets/img/logo/logo_128.png" alt="Logo">
  </a>

  <h2 align="center">HRMS</h2>

  <p align="center">
    Human Resource Management System
    <br />
    <br />
    <a href="https://github.com/amralsaleeh/HRMS/issues">Report Bug</a>
    ·
    <a href="https://github.com/amralsaleeh/HRMS/issues">Request Feature</a>
  </p>
</p>
<br />

**HRMS** is an open-source web application tailored to streamline employee management and HR processes within organizations.

It optimizes organizational efficiency through clear hierarchy establishment, centralized employee records, streamlined attendance and leave management, precise salary processing, timely alerts, comprehensive HR reports, and efficient asset/device tracking.

This concise solution promotes effective workforce management and informed decision-making.

### Built With

- [Laravel](https://laravel.com)
- [Livewire](https://livewire.laravel.com)

## Features

- **Organizational Structure:** Establish a clear hierarchy with centers, departments, and positions.

- **Employee Information Management:** Maintain centralized and detailed records of employee information.

- **Process Automation:** Reduces administrative burdens on the department by handling routine tasks.

- **Attendance and Leave Tracking:** Track attendance, manage leave requests, and monitor employee availability.

- **Salary and Deduction Management:** Streamline salary and deduction processes, ensuring accuracy and compliance.

- **Alerts and Messaging System:** Send notifications for important dates and announcements, with integrated SMS and WhatsApp API support to deliver messages directly to employees.

- **Comprehensive HR Reports:** Generate detailed reports for insights into employee performance and attendance.

- **Asset and Device Management:** Includes an assets management module that is currently under development and will enable efficient tracking of organizational assets and devices assigned to employees.

- **Support localization:** Supports both English and Arabic languages, with full localization capabilities, including left-to-right (LTR) and right-to-left (RTL) text directions, to ensure usability and compliance with regional and cultural requirements.

![Login](https://github.com/user-attachments/assets/063d57fc-3f79-4e15-8b20-7663b1ef896e)

<h3 align="center">Login</h3>
<br/>

![Dashboard](https://github.com/user-attachments/assets/8b8a7132-05a3-4fb3-aa6e-4407ca1cc73d)

<h3 align="center">Dashboard</h3>
<br/>

![Employee Info](https://github.com/user-attachments/assets/0cb0ea64-90a6-4934-9a4e-7c9dce694d5f)

<h3 align="center">Employee Info</h3>
<br/>

![SMS](https://github.com/user-attachments/assets/7b565ef4-4318-459d-8ec8-145a252d27d7)

<h3 align="center">SMS</h3>
<br/>

![Fingerprints](https://github.com/user-attachments/assets/63e08408-28cd-4d9a-a1f2-6b2cb74cda9a)

<h3 align="center">Fingerprints</h3>
<br/>

![Discounts](https://github.com/user-attachments/assets/0c5678ad-b78c-45b4-8794-221e29c1aefc)

<h3 align="center">Discounts</h3>
<br/>

![User](https://github.com/user-attachments/assets/95e2d08e-1da3-48dc-b606-963185c9db30)

<h3 align="center">User</h3>
<br/>

![Under Development](https://github.com/user-attachments/assets/b1e95d5f-60db-4392-a4c2-d22102698494)

<h3 align="center">Under Development</h3>
<br/>

![Log Viewer](https://github.com/user-attachments/assets/4afae1e1-f808-4fb9-af78-8709bff3e218)

<h3 align="center">Log Viewer</h3>
<br/>

## Getting Started

### Requirements

- PHP 8.1 or later
- Composer
- MySQL
- Node.js and npm (for frontend assets - optional if assets are already compiled)

### Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/amralsaleeh/HRMS.git
   cd HRMS
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Create the database:**

   Create a MySQL database for the application. For example:

   ```sql
   CREATE DATABASE hrms_database;
   ```

4. **Configure environment variables:**

   Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

   Open the `.env` file and configure the following:

   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=hrms_database` (or your database name)
   - `DB_USERNAME=your_database_username`
   - `DB_PASSWORD=your_database_password`
   - `APP_TIMEZONE=Asia/Istanbul` (or your preferred timezone)

5. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

6. **Create storage link:**

   ```bash
   php artisan storage:link
   ```

7. **Run database migrations and seeders:**

   This will create all necessary tables and populate them with initial data including a default admin user:

   ```bash
   php artisan migrate --seed
   ```

8. **Install frontend dependencies (optional):**

   If you need to compile or modify frontend assets:

   ```bash
   npm install
   npm run dev
   ```

   Note: If the assets are already compiled in `public/assets/`, you can skip this step.

9. **Start the development server:**

   ```bash
   php artisan serve
   ```

10. **Access the application:**

    Open your browser and navigate to `http://localhost:8000`

### Default Login Credentials

After running the migrations with seeders, you can log in using the following default admin credentials:

- **Email:** `admin@demo.com`
- **Password:** `admin`

**Important:** Change the default password after your first login for security purposes.

### Messaging (SMS and WhatsApp)

The app can send SMS and WhatsApp messages to employees (e.g. from **Messages > Bulk** and **Messages > Personal**). To use these features, configure the following.

#### SMS

SMS sending uses the **Syriatel BMS** API. Credentials are stored in the database, not in `.env`.

- The application reads the first row of the `settings` table. Ensure that row has:
  - `sms_api_sender` – Sender ID / shortcode
  - `sms_api_username` – Syriatel API username
  - `sms_api_password` – Syriatel API password
- There is no admin UI for these values. After running migrations, insert or update the row (e.g. via `php artisan tinker` or SQL). The `settings` table also has `created_by` and `updated_by` columns; set them as required by your schema.

#### WhatsApp

WhatsApp sending uses a **WAHA-compatible** HTTP API (e.g. [WAHA](https://waha.devlike.pro/)).

- The app sends requests to a local API at `http://localhost:3000` with session name `default`. You must run a WAHA (or compatible) server—for example on port 3000—and link a WhatsApp account to the `default` session.
- Recipient numbers are currently formatted with country code `963` in the API call. For other regions, the code would need to be updated.

## Contribution

We welcome contributions from developers and users. If you have ideas for improving the system or discover issues, feel free to create an Issue or submit a Pull Request.

![GitHub contributors](https://img.shields.io/github/contributors/amralsaleeh/HRMS)

## Contact

- **LinkedIn:** [Amr Alsaleh](https://linkedin.com/in/amralsaleeh)
- **Email:** [amralsaleeh@outlook.com](mailto:amralsaleeh@outlook.com)
- **Project Repository:** [HRMS on GitHub](https://github.com/amralsaleeh/HRMS)

[![LinkedIn][linkedin-shield]][linkedin-url]

## License

This project uses the MIT License. Please see [LICENSE](LICENSE.md) File for more information.

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/amralsaleeh/HRMS.svg?style=flat-square
[contributors-url]: https://github.com/amralsaleeh/HRMS/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/amralsaleeh/HRMS.svg?style=flat-square
[forks-url]: https://github.com/amralsaleeh/HRMS/network/members
[stars-shield]: https://img.shields.io/github/stars/amralsaleeh/HRMS.svg?style=flat-square
[stars-url]: https://github.com/amralsaleeh/HRMS/stargazers
[issues-shield]: https://img.shields.io/github/issues/amralsaleeh/HRMS.svg?style=flat-square
[issues-url]: https://github.com/amralsaleeh/HRMS/issues
[license-shield]: https://img.shields.io/github/license/amralsaleeh/HRMS.svg?style=flat-square
[license-url]: https://github.com/amralsaleeh/HRMS/blob/master/LICENSE.md
[linkedin-shield]: https://img.shields.io/badge/Linked-In-white?logo=linkedin&logoColor=blue&labelColor=white&color=blue
[linkedin-url]: https://linkedin.com/in/amralsaleeh
