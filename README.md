# Human Resource Management System (HRMS)

**HRMS** is an open-source web application tailored to streamline employee management and HR processes within organizations.

It optimizes organizational efficiency through clear hierarchy establishment, centralized employee records, streamlined attendance and leave management, precise salary processing, timely alerts, comprehensive HR reports, and efficient asset/device tracking.

This concise solution promotes effective workforce management and informed decision-making.

## Features

- **Organizational Structure:** Establish a clear hierarchy with centers, departments, and positions.

- **Employee Information Management:** Maintain centralized and detailed records of employee information.

- **Process Automation:** Reduces administrative burdens on the department by handling routine tasks.

- **Attendance and Leave Tracking:** Track attendance, manage leave requests, and monitor employee availability.

- **Salary and Deduction Management:** Streamline salary and deduction processes, ensuring accuracy and compliance.

- **Alerts and Messaging System:** Implement notifications for important dates and announcements.

- **Comprehensive HR Reports:** Generate detailed reports for insights into employee performance and attendance.

- **Asset and Device Management:** Efficiently manage and track organizational assets and assigned devices for each employee.

## Getting Started

### Requirements
- PHP 8.1 or later.
- Composer.
- MySQL.

### Installation

1. Download the source code using the following command:

   ```bash
   git clone https://github.com/amralsaleeh/HRMS.git

2. Navigate to the project folder:
    ```bash
    cd HRMS

3. Install dependencies using Composer:
    ```bash
    composer install
4. Set up the database and necessary configurations:
- Open the `.env` file in the root of your project.

- Set the database connection details, including `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

5. Run the migration command with the seed flag to add some fake data:
    ```bash
    php artisan migrate --seed

6. Run the development server:
    ```bash
    php artisan serve

7. Open your browser and go to http://localhost:8000 to see the application.

8. login:
    ```bash
    email: test@namaa.sy
    password: 12345678

## Contribution
We welcome contributions from developers and users. If you have ideas for improving the system or discover issues, feel free to create an Issue or submit a Pull Request.

## License
This project uses the MIT License. Please see [LICENSE](LICENSE.md) File for more information.

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
