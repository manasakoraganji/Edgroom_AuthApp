# Auth using reactJS and PHP and MySQL {CRUD}



This is a fully functional authentication application using reactJs with bootstrap in frontend and PHP in backend and MySQL as Database

Initially, the page renders three ways to move further for the user and admin

Created a login form and registration form in PHP using Bootstrap styles

Registration form with inputs first name, last name, email, phone number, profile pic, and password with full validations

If any validation fails, then it will show the respective error message

If the user registered successfully then the user details are stored in MySQL and show to the user registration is successful and navigate to the login page

If the user login successfully then user details are fetch and stored in localStorage and rendered on the home page and whenever the logout button hits then data should be deleted from localStorage as well

If the user login cred is wrong then, it will show the respective error 

Admin can log in based on credentials "admin" and "admin" as username and password respectively otherwise it will show the error as wrong credentials

Admin can search and delete and update the userDetails
