<?php
include 'dbconnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['user_email']; 

    $photoPath = '';
    $signPath = '';
    $uploadDir = 'files/';

    function saveImage($file, $prefix, $uploadDir) {
        $fileName = time() . "_" . $prefix . "_" . basename($file["name"]);
        $targetPath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($file["tmp_name"], $targetPath)) {
                return $targetPath;
            }
        }
        return false;
    }

    $photoPath = saveImage($_FILES['photo'], 'photo', $uploadDir);
    $signPath = saveImage($_FILES['signature'], 'sign', $uploadDir);

    if ($photoPath && $signPath) {
        // Use procedural mysqli
        $query = "UPDATE account SET photo_path = ?, sign_path = ?, kyc_status = 'Submitted' WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $photoPath, $signPath, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script>alert('✅ KYC submitted successfully.'); window.location='customer_dash.php';</script>";
        } else {
            echo "<script>alert('❌ Database error. Please try again later.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ Upload failed. Please use JPG, JPEG, or PNG.'); window.history.back();</script>";
    }
}
?>
