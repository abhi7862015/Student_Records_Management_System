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
  7. 

1.	Signup Process for Admin/Teacher/Student/Parent
When signing up for an Admin/Teacher/Student/Parent role, the following fields are required:
1.	First Name: The first name of the user.
2.	Middle Name: The middle name of the user.
3.	Last Name: The last name of the user.
4.	Email ID: The email address of the user. This will be used for communication and account recovery.
5.	Username: A unique identifier for the user to log in.
6.	Password: A secure password for the user's account.
7.	Confirm Password: Re-enter the password to ensure it matches the initial password.
8.	User Type: The role of the user, which can be either:
	Admin
	Teacher
	Student
	Parent

9.	Signup Button: Submit the signup form to create the new account.
10.	Cancel Button: Cancels the signup process and clears the form.
11.	Already Registered? Login: A prompt for users who have already registered to log in.

2.	Login Process for Admin/Teacher/Student/Parent
When logging in as a Teacher or Admin, the following options and fields are available:
1.	Username: The unique identifier used by the user to log in.
2.	Password: The password associated with the username.
3.	Captcha: A verification challenge to ensure the user is not a bot.
4.	Sign in with Google+: An option to log in using Google+ credentials.
5.	Login with OTP: An option to log in using a one-time password sent to the registered mobile number or email.
6.	Forgot Your Password: A link to reset the password if the user has forgotten it.
7.	Don’t you have an account? Signup Now: A prompt for users who have already registered to log in.


3.	Signup and Login Flow
Signup Flow:
1.	The user navigates to the signup page. (http://localhost/teacher_management/signup.php )
2.	The user fills in all the required fields and selects the appropriate user type.
3.	The user clicks the "Signup" button.
4.	The system validates the information.
•	If validation passes, the account is created, and the user is notified of the successful registration.
•	If validation fails, the user is prompted to correct the errors.
Login Flow:
1.	The user navigates to the login page. (http://localhost/teacher_management/login.php )
2.	The user enters the username and password.
3.	The user completes the Captcha challenge.
4.	The user can optionally choose to sign in with Google+ or log in with OTP.
5.	If the user forgets the password, they can click "Forgot Your Password" to reset it.
6.	User clicks the "Login" button.
7.	The system validates the credentials.
•	If the credentials are correct, the user is logged in and redirected to the appropriate dashboard based on their user type.
•	If the credentials are incorrect, the user is prompted to try again.


4.	Forgot Your Password Process
When a user has forgotten their password, they can follow these steps to reset it:
Step 1: Enter Email
1.	Email: The user enters their registered email address to initiate the password reset process.
Step 2: OTP Verification
1.	OTP: The user receives a one-time password (OTP) via email.
2.	Enter OTP: The user enters the received OTP to verify their identity.
Step 3: Reset Password
1.	New Password: The user creates a new password.
2.	Confirm New Password: The user re-enters the new password to confirm it.
5.	Student Records Management System Dashboard

The dashboard of the Student Records Management System provides an overview of the system's users, including admins, viewers, updaters, teachers, and students. It includes various metrics and allows navigation to different sections through a menu list. Here's a detailed explanation:		

A. Dashboard Overview
The dashboard presents a summarized view of the following information:
	Total Users: Displays the total number of users, including admins, teachers, students and parents.
	Total Admins: Shows the number of admin users.
	Total Teachers: Shows the number of Teacher users.
	Total Students: Shows the number of Student users.
	Total Parents: Displays the number of Parent users. 

B. Navigation Menu
The navigation menu allows users to access different sections of the system. The menu includes:
	Dashboard: This takes the user to the main dashboard page.
	Users Account List: Displays a list of all types of user accounts in the system.
	Student List: Displays a list of all students in the system.
	Teacher List: Displays a list of all teachers in the system.

C. Detailed View Sections
1.	Dashboard Section: The main page shows the overall statistics and metrics for the system's users and students.








D. Student List Section
A detailed list of all students in the system, including their personal and academic information. Features include:
1.	Search and Filter: 
	Allows searching and filtering students by various criteria.
By Student Name, Email ID, and By Status
	The searched keyword will persist.
	The filter can be reset by the button “Reset” on the same module.

2.	Add New Student: 
	Button to add a new student (Popup will be open if the student already exists it will update the data otherwise it will create a new record of the student).
	Student existence is checked by emails only.
	Only the teacher and admin can create a new teacher from this module.
	Student and Parent type users can see all the information of the teachers and also export their details in CSV format file but do not perform any other action like creation, modification, deletion, or disabling the teacher’s records.
	Also, Student and Parent type users can also filter the teacher’s details on this module.

3.	Edit and Delete: 
	Options to edit or delete teacher records.
	Only the admin and teacher can edit/delete the teacher’s record from this module.
	While editing records a new page will open to update records of the teachers.

4.	Disabling Student:
	Admin and teacher can be disable any student’s records for any further process.

5.	Student Listing:
	All records of the student can be seen in the format of the table in this module.
	We have the column in this list.
Student ID, Full Name, Email, Gender, Class, Subject, Marks, User Account Exits, Status, Last Updated Date, Created Date, Actions.
	In Student List, we can order by any column, also with any keyword in the whole table.

E. Teacher List Section
A detailed list of all teachers in the system, including their personal and professional information. Features include:
6.	Search and Filter: Allows searching and filtering teachers by various criteria.
	Allows searching and filtering students by various criteria.
By Student Name, Email ID, and By Status
	The searched keyword will persist.
	The filter can be reset by the button “Reset” on the same module.

7.	Add New Teacher: 
	Button to add a new teacher. (A new page will be open to create a new record of the type of user (teacher). 
	Only the teacher and admin can create a new teacher from this module.
	Student and Parent type users can see all the information of the teachers and also export their details in CSV format file but do not perform any other action like creation, modification, deletion, or disabling the teacher’s records.
	Also, Student and Parent type users can also filter the teacher’s details on this module.

8.	Edit and Delete: 
	Options to edit or delete teacher records.
	Only the admin and teacher can edit/delete the teacher’s record from this module.
	While editing records a new page will open to update records of the teachers.

9.	Disabling Teacher:
	Admin and teacher can be disable any teacher’s records for any further process.

10.	Teacher Listing:
	All records of the teacher can be seen in the format of the table in this module.
	We have the column in this list.
Teacher ID, Full Name, Email, Gender, Attended Class, Subject Expertise, Experience, User Account Exits, Status, Last Updated Date, Created Date, and Actions.
	In Teacher List, we can order by any column, also with any keyword in the whole table.

6.	User Account List:
1.	Adding New Users: Admins can add new users (teachers, students, parents, and other admins) via dedicated forms accessible from the dashboard or the respective lists.

2.	Editing User Information: Admins can update user information by selecting the "Edit" action next to each user or user's record.

3.	Deleting Users: Admins can remove users from the system by selecting the "Delete" action next to each user or User’s record.


7.	Actions and Functionality
There is a bit of difference between the User Account and Teacher/Student/Parent Records:
1.	User Account is used for the signing the account with this application only.
2.	User Accounts can be of four types as below:
o	Admin
o	Teacher
o	Student
o	Parent
3.	That’s means, these types of user can access this application by using their credentials. 
4.	But any records, created under the section of the following module can not be used as a User Account (means not applicable to sign in to this portal) because these do not exist in the User Account List section.
5.	Users can be able for sign in only when they link their account under the User Account List Module.
6.	Admin can add/create any User Account from the existing users like the teacher, student, or parent from the other modules (Student List/Teacher List).
7.	No user can be added User Account, update, edit status, or delete Admin’s records other than admin only.
8.	The Admin can perform all the actions that exist in this application, but some users like Students and Parents can not perform any action except download CSV files and filter.
9.	The user like the Teacher can perform some actions that some privileges like adding new student, editing student’s record, and deleting students.


8.	Export and Import Functionality for Admin/Teachers/Students/Parents
The export and import functionality in the Student Records Management System allows administrators to efficiently manage teacher and student data by exporting it to external files or importing it from external sources. This can facilitate data backup, bulk updates, and data migration.

A.	Export Function
Purpose: The export function allows administrators to download the data of teachers or students into a file format, such as CSV or Excel, for external use, reporting, or backup purposes.
Steps to Export Data:
	Navigate to the List Section:
	Go to the “User Account List”/"Teacher List"/"Student List" section from the navigation menu.
	Select Export:
	Click on the "Export" button typically found at the top of the list section.
	CSV File Format will appear.
	Download the File:
	The system generates the file and prompts the user to download it.
	Save the file to your local system.

Benefits:
1.	Facilitates data backup and storage.
2.	Allows for data analysis and reporting in external tools.
3.	Provides a way to share data with other stakeholders.

B.	Import Function
Purpose: The import function allows administrators to upload data of teachers or students from an external file, enabling bulk data entry or updating existing records.

Steps to Import Data:
	Navigate to the List Section:
	Go to the “User Account List”/"Teacher List"/"Student List" section from the navigation menu.
	Select Import:
	Click on the "Import" button typically found at the top of the list section.
	Upload File:
	A dialog box will appear asking you to upload a file.
	Click on "Choose File" and select the file from your local system (the file should be in the required format, such as CSV or Excel).
	Map Fields:
	The system might prompt you to map the fields from the file to the system fields to ensure data is correctly imported.
	Map the fields accordingly and confirm.
	Import Data:
	Click on the "Import" button to start the import process.
	The system will process the file and update the records accordingly.
	A confirmation message will be displayed once the import is successful.

Benefits:
1.	Enables bulk data entry, saving time and effort.
2.	Simplifies updating existing records with new information.
3.	Facilitates data migration from other systems or sources.
4.	Best Practices for Export and Import

C.	Data Validation:
1.	Ensure that the data in the imported file is clean and follows the system's validation rules to prevent errors during the import process.
2.	Backup Before Import:
	Always back up existing data before performing an import to avoid accidental data loss.
3.	Field Mapping:
	Carefully map the fields during import to ensure data is correctly placed in the appropriate fields.
4.	Review and Test:
	After importing data, review and test to ensure the data has been correctly imported and functioning as expected within the system.
By utilizing the export and import functionalities, administrators can streamline data management processes, enhance data accuracy, and improve overall efficiency in managing teacher and student records.


