1. Introduction
  Purpose of the Document: This document provides detailed instructions for 
  setting up the project environment and installing all necessary software.
  Overview of the Project: 
  The Student Records Management System (SRMS) is a comprehensive solution 
  designed to streamline and enhance the management of student records by 
  teachers. This project aims to provide an efficient and user-friendly platform for 
  teachers to manage student information, track academic progress, and communicate 
  with students and parents.
  Key Features

1. Student Information Management
   Store and update personal information, such as name, email.
   Maintain academic records, including grades, attendance, and 
  extracurricular activities.
   Upload and manage student documents, such as report cards and 
  certificates.

3. Attendance Tracking
   Record daily attendance with ease.
   Generate attendance reports and identify patterns of absenteeism.
   Notify parents of student absences via automated emails or 
  messages.

4. Grade Management
   Input and update grades for assignments, tests, and exams.
   Calculate overall grades and generate report cards.
   Provide students and parents with access to current grades and 
  academic progress.

5. Reporting and Analytics
   Generate various reports, such as student performance, attendance 
  statistics, and class averages.
   Use analytics to identify students who may need additional support.

  Objectives
   Efficiency: Streamline the process of managing student records, reducing 
  administrative burden on teachers.
   Accuracy: Ensure accurate and up-to-date records of student information and 
  academic performance.
   Accessibility: Provide easy access to student records for teachers, students, 
  and parents.
   Communication: Enhance communication between teachers, students, and 
  parents to support student success.

Technologies Used
   Backend: Core PHP 7.4
   Frontend: HTML, CSS, Bootstrap, JavaScript, and jQuery
   Database: MySQL
   Hosting: localhost

User Roles: There are four types of user exits, Admin, Teacher, Student and Parent.
   Admin (All Rights): Manage admin/teacher/student/parent records, input 
  grades, track attendance, and communicate with parents.
   Teacher (Updater): Manage teacher/student records, input grades, track 
  attendance, and communicate with parents.
   Students (Viewer): View their grades, and attendance records, and receive 
  announcements.
   Parents (Viewer): Access their child's academic records, communicate with 
  teachers, and receive notifications.

The SRMS is designed to be scalable and customizable, allowing schools to tailor the 
system to their specific needs. By leveraging modern technologies and best practices 
in software development, the SRMS aims to provide a reliable and secure platform 
for managing student records.

2. Prerequisites
System Requirements
   Operating System: Windows 10/macOS 10.15/Ubuntu 20.04
   RAM: Minimum 4 GB
   Disk Space: Minimum 20 GB
Required Software and Versions
   PHP 7.4
   MySQL 5.4
   Apache 4.0
   Or LAMP/WAMP
   phpmyadmin
3. Project Setup
Cloning the Repository
  1. Open your terminal. and Run the following command:
    git clone [repository URL]
  2. Navigate to the project directory:
  cd [project directory]
Starting the Development Server
  1. Run the following command to start the development server:
    If you are using, WAMP you can start by clicking on the installed WAMP 
    Application after that all three services will get started in this order (red, 
    orange, green). Green indicates that your server is ready to listen to your 
    request.

  Import Database
  1. Check the database file at below:
    [project directory]/database/teacher_management.zip
  2. Open the below URL in your browser:
    http://localhost/phpmyadmin/index
  3. Login to the database by using the below credentials:
    Username: root
    Password: <LEAVE_IT_BLANK>
  4. Create a new database with the below name:
    Database Name: teacher_management
  5. Go to the Import tab in the same U of the phpmyadmin interface:
    Choose the database file that can find the cloned repository 
    teacher_managament/database/teacher_management.zip
6. In case, your database has different credentials then do configure the database for the same 
  project:
   Go to the file http://localhost/teacher_management/db_connection.php
  1. Host: “<HOSTNAME>”;
  2. Username: “<USERNAME>”;
  3. Password: “<PASSWORD>”;
  4. Database = “<DATABASENAME>”
   Make the above changes and make a connection with a database.

4. Running the Project
  Accessing the Application
  1. Open your web browser.
  2. Navigate to http://localhost/teacher_management/login.php.
  3. Login Pages http://localhost/teacher_management/login.php
  4. Home Page http://localhost/teacher_management/home.php
  5. Teacher List http://localhost/teacher_management/userList.php
  6. Student List http://localhost/teacher_management/studentList.php
