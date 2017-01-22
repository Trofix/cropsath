# cropsath
Cropsath is the perfect social page for creators, who want to get responses from their fans.

# Setting up
## Manual setting up
 1. **Install Apache.**
 2. Clone this repository into /var/www/html or one of it's subfolder. *NOTE: Someone please extent this to other OSs*
 3. **Install MYSQL.**
 4. Type "mysql -u root -p", and enter your password to get into the MySQL prompt. (Ubuntu) *NOTE: Someone please extend this to other OSs*
 5. Execute SQL setup code (lower) with replacing "userName", "webServerIP", "userPass" and "dbName". *NOTE: If MYSQL is running on your webserver, use localhost as webServerIP.*
 6. Exit from MySQL prompt with "exit".
 7. Configure config.json: "pageName" should be your page's name, "sqlServ" should be your MYSQL server's address, "sqlUser" should be what your entered as userName, "sqlPass" should be what you entered as userPass and "dbName" should be what you entered as dbName.
 8. Replace logo.png with your logo.
 9. Enjoy!
 
### SQL setup code
```sql
CREATE USER 'userName'@'webServerIP' IDENTIFIED BY 'userPass';
CREATE DATABASE dbName;
USE dbName;
CREATE TABLE users ( id int AUTO_INCREMENT PRIMARY KEY, username VARCHAR(64), password VARCHAR(255), email VARCHAR(254), banned TINYINT(1), admin TINYINT(1) );
CREATE TABLE questions ( id int AUTO_INCREMENT PRIMARY KEY, questionName VARCHAR(255) NOT NULL, questionText TEXT(65535), comments TEXT(65535) );
GRANT SELECT, INSERT, UPDATE ON dbName.* TO 'userName'@'webServerIP';
``` 
## Automatic setting up (BETA) (DANGER)
 1. Use the [easyCropsath](https://github.com/Trofix/easy-cropsath) made for your webserver's OS.
 2. Continue manual setting up from step 4.
