<?php
// $servername = 'localhost';
// $username = 'root';
// $password = '';

// $conn = mysqli_connect($servername,$username,$password);
// if(!$conn){
//     die(mysqli_connect_error());

// }
// else{
//     echo("Server Connected Successfully");
// }

// $sql = 'CREATE DATABASE banking';
// if (mysqli_query($conn,$sql)){
//     echo "Database created successfully";
// }
// else{
//     echo "There is an error ".mysqli_error($conn);
// }

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'banking';

$conn = mysqli_connect($servername,$username,$password,$dbname);
if (!$conn){
    die(mysqli_connect_error());
}
// else{
//     echo "Database connected successfully.";
// }

// used for signup page.
// $sql = '
// CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) UNIQUE NOT NULL,
//     phone VARCHAR(20) NOT NULL,
//     password VARCHAR(255) NOT NULL,
//     confirm     VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )';
// if(mysqli_query($conn,$sql)){
//     echo 'table created successfully';
// }
// else{
//     echo 'There is an error'.mysqli_error($conn);
// }

// used in customer account opening.
// $sql = '
// CREATE TABLE account(
//     account_number VARCHAR(20) primary key,
//     full_name VARCHAR(100),
//     dob DATE,
//     gender VARCHAR(10),
//     adhar VARCHAR(20),
//     email VARCHAR(100),
//     mobile VARCHAR(15),
//     address TEXT,
//     account_type VARCHAR(50),
//     deposit DECIMAL(10,2),
//     id_proof VARCHAR(255),
//     address_proof VARCHAR(255),
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )';

// $sql = "ALTER TABLE account
// ADD COLUMN status ENUM('Pending','Verified','Approved','Rejected') DEFAULT 'Pending',
// ADD COLUMN reviewed_by VARCHAR(100) NULL,
// ADD COLUMN reviewed_at DATETIME NULL;
// ";
// $sql ="ALTER TABLE account ADD COLUMN kyc_status VARCHAR(50) DEFAULT 'Not Started'";
// $sql = "ALTER TABLE account ADD COLUMN show_kyc_button BOOLEAN DEFAULT FALSE";
// $sql ="ALTER TABLE account ADD COLUMN photo_path VARCHAR(255) NULL,
// ADD COLUMN sign_path VARCHAR(255) NULL";
// if (mysqli_query($conn,$sql)){
//     echo ('table created successfully.');
// }
// else{
//     echo 'There is an error'.mysqli_error($conn);
// }

#create the otp teble.
// $sql = "CREATE TABLE otp (
//   email VARCHAR(255) primary key,
//   is_verified TINYINT(1) DEFAULT 0,
//   otp VARCHAR(255) DEFAULT NULL,
//   otp_expires DATETIME DEFAULT NULL,
//   otp_attempts INT DEFAULT 0,
//   created_at DATETIME DEFAULT CURRENT_TIMESTAMP
// )";
// $sql = "ALTER TABLE users
// ADD otp_hash VARCHAR(255) DEFAULT NULL,
// ADD otp_expires DATETIME DEFAULT NULL,
// ADD is_verified TINYINT(1) DEFAULT 0;
// ";

//opening a new fd/rd account.
// $sql = "CREATE TABLE fd_rd_accounts (
//     account_number VARCHAR(20) PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     dob DATE NOT NULL,
//     email VARCHAR(255) NOT NULL,
//     phone VARCHAR(15) NOT NULL,
//     account_type ENUM('FD', 'RD') NOT NULL,
//     amount DECIMAL(10,2) NOT NULL,
//     tenure_months INT NOT NULL,
//     start_date DATE NOT NULL DEFAULT CURRENT_DATE,
//     maturity_date DATE GENERATED ALWAYS AS (DATE_ADD(start_date, INTERVAL tenure_months MONTH)) STORED,
//     interest_payout ENUM('monthly', 'quarterly', 'maturity') NOT NULL,
//     auto_renewal BOOLEAN DEFAULT FALSE,
//     nominee VARCHAR(50),
//     payment_mode ENUM('UPI', 'NEFT', 'Cheque','Cash') NOT NULL
// )";

# for freezing the accounts.
// $sql = "CREATE TABLE freeze_accounts (
//     email VARCHAR(255) NOT NULL PRIMARY KEY,
//     account_number VARCHAR(20) NOT NULL,
//     reason VARCHAR(100) NOT NULL,
//     comments TEXT,
//     requested_at DATETIME DEFAULT CURRENT_TIMESTAMP
// )";
// if (mysqli_query($conn,$sql)){
//     echo ('table created successfully.');
// }
// else{
//     echo 'There is an error'.mysqli_error($conn);
// }

// $sql = "CREATE TABLE beneficiaries (
//   beneficiary_id VARCHAR(50) PRIMARY KEY,
//   full_name VARCHAR(100) NOT NULL,
//   dob DATE NOT NULL,
//   account_number VARCHAR(20) NOT NULL,
//   relationship VARCHAR(50),
//   phone VARCHAR(20),
//   email VARCHAR(100)
// )";

// $sql = "CREATE TABLE transfers (
// `from` varchar(20) NOT NULL,
// `type` varchar(20) NOT NULL,
// `to` varchar(20) NOT NULL,
// `amount` decimal(10,2) NOT NULL,
// `description` TEXT)";


// $sql = "CREATE TABLE checkbook (
//     request_id VARCHAR(20) PRIMARY KEY,
//     account_number VARCHAR(20) NOT NULL,
//     pages INT NOT NULL,
//     notes TEXT,
//     status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
//     request_time DATETIME DEFAULT CURRENT_TIMESTAMP
// )";

// $sql = "
// CREATE TABLE `cards` (
//     `request_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
//     `user_id` Varchar(20),
//     `account_number` VARCHAR(20) NOT NULL,
//     `card_type` ENUM('Virtual Debit Card','Physical Debit Card','Credit Card') NOT NULL,
//     `status` ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
//     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     PRIMARY KEY (`request_id`),
//     FOREIGN KEY (`account_number`) REFERENCES account(`account_number`)
// )
// ";
// $sql = "
// ALTER TABLE cards
// ADD COLUMN card_number VARCHAR(16) NULL,
// ADD COLUMN cvv VARCHAR(3) NULL,
// ADD COLUMN expiry_date DATE NULL;
// ";
// if (mysqli_query($conn,$sql)){
//     echo ('table created successfully.');
// }
// else{
//     echo 'There is an error'.mysqli_error($conn);
// }
// mysqli_close($conn);
?>