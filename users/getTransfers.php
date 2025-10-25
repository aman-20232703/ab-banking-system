<?php
include 'dbconnect.php';
session_start();

$email = $_SESSION['user_email'];
$type = $_GET['type'] ?? '';

if ($type === 'own') {
    $query = "SELECT account_number,amount FROM fd_rd_accounts WHERE email = '$email' AND account_number LIKE 'RD%'";
    $result = mysqli_query($conn, $query);
    $pairs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pairs[] =[
        'account_number' => $row['account_number'],
        'amount' => $row['amount']
    ];
    
    }
    if (count($pairs) > 0) {
        echo json_encode([
            'success' => true,
            'data' => $pairs,
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Accounts not found"]);
    }
} else if ($type === 'beneficiary') {
    $query = "SELECT account_number,full_name FROM beneficiaries";
    $result = mysqli_query($conn, $query);
    $pairs = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $accounts = $row['account_number'];
        $name = $row['full_name'];
        $pairs[$name] = $accounts;

    }
    if (count($pairs) > 0) {
        echo json_encode([
            'success' => true,
            'data' => $pairs,
            
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Beneficiary not found"]);
    }
}else{
    die ("There is an error.");
}
