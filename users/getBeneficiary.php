<?php
include 'dbconnect.php';
session_start();

$name = "%".strtolower(trim($_GET['fullName']?? ''))."%";
$dob = date('Y-m-d',strtotime($_GET['dob']?? ''));

if(empty($name)|| empty($dob)){
    echo json_encode(['success'=>false,'message'=>'Missing fields']);
    exit;
}

$sql = "SELECT account_number,mobile,email FROM account WHERE lower(replace(full_name,'','')) LIKE '$name' AND dob = '$dob'";
$result = mysqli_query($conn,$sql);
$accounts = [];
$phones = [];
$emails = [];
while($row = mysqli_fetch_assoc($result)){
    $accounts[] = $row['account_number'];
    $phones[] = $row['mobile'];
    $emails[] = $row['email'];
}
$phone = $phones[0]??'';
$email = $emails[0]??'';
if (count($accounts)>0){
    echo json_encode([
'success'=>true,'accounts'=>$accounts,'phone'=>$phone,'email'=>$email
    ]);
}else{
    echo json_encode(["success" => false, "message" => "Beneficiary not found"]);
}
?>