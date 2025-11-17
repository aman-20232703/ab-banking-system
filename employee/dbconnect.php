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
// if (mysqli_query($conn,$sql)){
//     echo ('table created successfully.');
// }
// else{
//     echo 'There is an error'.mysqli_error($conn);
// }

// mysqli_close($conn);
?>