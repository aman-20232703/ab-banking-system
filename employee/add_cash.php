<?php
//include 'dbconnect.php';

if (isset($_POST['submit'])){
    $account=$_POST['account_number'];
    $amount=$_POST['amount'];


    $sql="UPDATE account
    SET deposit=deposit+$amount
    WHERE account_number='$account_number' ";

    mysqli_query($conn,$sql);
            echo "<script>
            alert('✅ Amount deposited.');
            window.location='sidebar.php';
        </script>";
}else{
    echo $account;
        //     echo "<script>
        //     alert('Amount not deposited: ');
        //     window.location='sidebar.php';
        // </script>";
}
?>