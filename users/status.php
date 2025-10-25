<?php
include('dbconnect.php');
session_start();


  // if (isset($_POST['check_status'])) {
      // $email = $_POST['email'];
      $email = $_SESSION['user_email']??'';
      $query = "SELECT * FROM account WHERE email='$email'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

        //   echo "<div class='mt-4'>";
        //   echo "<h4>Application Details</h4>";
        //   echo "<p><strong>Name:</strong> {$row['full_name']}</p>";
        //   echo "<p><strong>Account Type:</strong> {$row['account_type']}</p>";
          echo "<p class='status-text'><strong>Application Status:</strong> ";

          if ($row['status'] == 'Pending') {
              echo "<span class='text-warning'>Pending (Under Review)</span>";
          } elseif ($row['status'] == 'Verified') {
              echo "<span class='text-info'>Verified by Employee (Awaiting Manager Approval)</span>";
          } elseif ($row['status'] == 'Approved') {
              echo "<span class='text-success'>Approved ✅</span>";
          }elseif($row['status']=='Freeze'){
            echo "<span class='text-danger'>You Freezed your account ❌</span>";
          }elseif($row['status']=='UN_freeze'){
            echo "<span class='text-danger'>You request UN_Freez your account ❌</span>";
          } else {
              echo "<span class='text-danger'>Rejected ❌</span>";
          }

          echo "</p>";

          if ($row['reviewed_by']) {
              echo "<p><strong>Reviewed By:</strong> {$row['reviewed_by']}</p>";
              echo "<p><strong>Reviewed On:</strong> {$row['reviewed_at']}</p>";
          }
          echo "</div>";
      } else {
          echo "<div class='alert alert-danger mt-4'>No application found for this email.</div>";
      }
  //}
  ?>

