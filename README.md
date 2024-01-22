<p align="center">

  [![Contributors][contributors-shield]][contributors-url]
  [![Forks][forks-shield]][forks-url]
  [![Stargazers][stars-shield]][stars-url]
  [![Issues][issues-shield]][issues-url]
  [![MIT License][license-shield]][license-url]
  [![LinkedIn][linkedin-shield]][linkedin-url]
  
  <a href="https://github.com/amralsaleeh/HRMS">
    <img src="public/assets/img/logo/logo_128.png" alt="Logo" width="80" height="80">
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
* [Laravel](https://laravel.com)
* [Livewire](https://livewire.laravel.com)

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

    
### Usage
8. Login:
    
    ```bash
    email: test@namaa.sy
    password: 12345678

## Contribution
We welcome contributions from developers and users. If you have ideas for improving the system or discover issues, feel free to create an Issue or submit a Pull Request.

## Contact

Amr Alsaleh - [@amralsaleeh](https://linkedin.com/in/amralsaleeh) - amralsaleeh@outlook.com

Project Link: [https://github.com/amralsaleeh/HRMS](https://github.com/amralsaleeh/HRMS)

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
[license-url]: https://github.com/amralsaleeh/HRMS/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/amralsaleeh
