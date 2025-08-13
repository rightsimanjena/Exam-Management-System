📚 Exam Management System
A web-based platform designed to streamline exam administration, student management, and result processing.
Built with PHP, MySQL, HTML, CSS, and JavaScript, this system is ideal for academic institutions to digitize their examination workflows.

🚀 Features
For Admin
🧑‍🎓 Student Management – Add, update, and delete student records.

📄 Exam Creation – Define courses, subjects, and exam schedules.

📊 Result Management – Upload and manage student scores.

📷 Profile Image Upload – Support for student profile images.

🔐 Secure Authentication – Session-based admin login/logout.

For Students
📅 Exam Timetable – View upcoming exams and schedules.

📜 Exam Instructions – Access exam guidelines before appearing.

📝 Result Access – View and download results securely.

🛠️ Tech Stack
Component	Technology
Frontend	HTML5, CSS3, JavaScript, Bootstrap
Backend	PHP (Procedural)
Database	MySQL
Server	Apache (XAMPP)

📂 Project Structure
Exam-Management-System/
│
├── admin/                # Admin panel files
├── student/              # Student panel files
├── assets/               # CSS, JS, and images
├── uploads/              # Uploaded profile images
├── database/             # SQL dump files
├── login.php             # Login page
├── logout.php            # Logout handler
└── README.md             # Project documentation
⚙️ Installation Guide
Clone the Repository

bash
Copy
Edit
git clone https://github.com/rightsimanjena/Exam-Management-System.git
cd Exam-Management-System
Setup Database

Open phpMyAdmin.

Create a new database (e.g., exam_management).

Import the .sql file from the database/ folder.

Configure Database Connection

Open the config.php file.

Update database credentials:

php
Copy
Edit
$db = mysqli_connect('localhost', 'root', '', 'exam_management');
Run the Project

Start XAMPP (Apache & MySQL).

Open browser → http://localhost/Exam-Management-System.

🔐 Default Admin Login
makefile
Copy
Edit
Email: admin@email.com
Password: admin
(You can change these in the database after login.)


📜 License
This project is licensed under the MIT License – you are free to use and modify it.
