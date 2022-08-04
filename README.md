# Test task for a candidate for a vacancy PHP Developer

### Installation:
Clone the repository to the folder where your PHP projects are running from and start the server.  
The SQL dump of the MySQL database is located in the `db` folder. It needs to be imported into your database.  
The database server connection settings are specified in the `vendor/connect.php` file.

Web interface for administering entries in the database of registered users.
To test the functionality, you can use the following data:
* Login – `admin`
* Password - `password`

#### Implemented functionality:
* viewing the list of registered users;
* viewing information on the selected user;
* adding a new user record;
* editing a user record;
* deleting a user record.

The interface is available only to a user with administrator rights after passing authentication.

#### To solve the problem, I used:
* MySQL 5.7;
* Nginx 1.21;
* PHP 7.4.
