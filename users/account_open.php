<?php
include 'dbconnect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Account Opening Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Bank Account Opening Form</h2>

            <form method="POST" enctype="multipart/form-data" novalidate>
                <!-- ================= PERSONAL INFO ================= -->
                <h5 class="mb-3 text-primary">Personal Information</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" value="<?php echo $_SESSION['user_name'] ?>" name="full_name"
                            class="form-control" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Aadhaar Number</label>
                        <input type="text" id="aadhaar" name="aadhaar"
                            class="form-control" placeholder="Enter 12-digit Aadhaar number" maxlength="12" required>
                        <div id="aadhaarError" class="text-danger small mt-1 d-none">Invalid Aadhaar number (must be 12 digits).</div>
                    </div>
                </div>

                <!-- ================= CONTACT INFO ================= -->
                <h5 class="mb-3 text-primary">Contact Information</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" value="<?php echo $_SESSION['user_email'] ?>" name="email"
                            class="form-control" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="tel" id="mobile" name="mobile" class="form-control"
                            placeholder="Enter 10-digit mobile number" maxlength="10" required>
                        <div id="mobileError" class="text-danger small mt-1 d-none">Invalid mobile number (must start with 6–9 and have 10 digits).</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Residential Address</label>
                    <textarea name="address" rows="2" class="form-control" placeholder="Enter your full address" required></textarea>
                </div>

                <!-- ================= ACCOUNT INFO ================= -->
                <h5 class="mb-3 text-primary">Account Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Account Type</label>
                        <select name="account_type" class="form-select" required>
                            <option value="savings">Savings Account</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Initial Deposit Amount (₹)</label>
                        <input type="number" value="2000" name="deposit" class="form-control" readonly required>
                    </div>
                </div>

                <!-- ================= UPLOAD ================= -->
                <h5 class="mb-3 text-primary">Upload Documents</h5>
                <div class="mb-3">
                    <label class="form-label">Upload ID Proof</label>
                    <input type="file" name="id_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Address Proof</label>
                    <input type="file" name="address_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>

                <!-- ================= DECLARATION ================= -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="agree" id="declaration" required>
                    <label class="form-check-label" for="declaration">
                        I hereby declare that the above information is true and correct to the best of my knowledge.
                    </label>
                </div>

                <!-- ================= BUTTONS ================= -->
                <div class="text-center">
                    <button type="reset"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">
                        <a href="customer_dash.php">Cancel</a>
                    </button>
                    <button type="submit" class="btn btn-primary px-4">Submit Application</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== JS: Frontend Validation ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const aadhaar = document.getElementById('aadhaar');
            const aadhaarError = document.getElementById('aadhaarError');
            const mobile = document.getElementById('mobile');
            const mobileError = document.getElementById('mobileError');

            // Aadhaar validation
            aadhaar.addEventListener('input', () => {
                aadhaar.value = aadhaar.value.replace(/\D/g, '');
            });
            aadhaar.addEventListener('blur', () => {
                const pattern = /^\d{12}$/;
                if (!pattern.test(aadhaar.value.trim())) {
                    aadhaarError.classList.remove('d-none');
                    aadhaar.classList.add('border-danger');
                } else {
                    aadhaarError.classList.add('d-none');
                    aadhaar.classList.remove('border-danger');
                }
            });

            // Mobile validation
            mobile.addEventListener('input', () => {
                mobile.value = mobile.value.replace(/\D/g, '');
            });
            mobile.addEventListener('blur', () => {
                const pattern = /^[6-9]\d{9}$/;
                if (!pattern.test(mobile.value.trim())) {
                    mobileError.classList.remove('d-none');
                    mobile.classList.add('border-danger');
                } else {
                    mobileError.classList.add('d-none');
                    mobile.classList.remove('border-danger');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// =================== PHP (Backend Validation + Insert) ===================

function generateAcNumber($conn)
{
    do {
        $account_number = 'AB' . rand(1000000000, 9999999999);
        $check = "SELECT account_number FROM account WHERE account_number = '$account_number'";
        $result = mysqli_query($conn, $check);
    } while (mysqli_num_rows($result) > 0);
    return $account_number;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'] ;
    $name = trim($_POST['full_name']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $aadhaar = trim($_POST['aadhaar']);
    $email = $_SESSION['user_email'];
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $account = $_POST['account_type'];
    $deposit = $_POST['deposit'];

    // 🔒 Backend validation
    if (!preg_match('/^\d{12}$/', $aadhaar)) {
        die("<div class='alert alert-danger text-center m-5'>Invalid Aadhaar number. Must be 12 digits.</div>");
    }

    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        die("<div class='alert alert-danger text-center m-5'>Invalid mobile number. Must be 10 digits starting with 6–9.</div>");
    }

    $id_proof = $_FILES['id_proof']['name'];
    $address_proof = $_FILES['address_proof']['name'];
    $target = "files";
    if (!is_dir($target)) mkdir($target, 0777, true);
    move_uploaded_file($_FILES['id_proof']['tmp_name'], "$target/" . basename($id_proof));
    move_uploaded_file($_FILES['address_proof']['tmp_name'], "$target/" . basename($address_proof));

    $check = "SELECT account_number FROM account WHERE email = '$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "
        <div class='modal fade show' style='display:block; background:rgba(0,0,0,0.5);'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header bg-danger text-white'>
                        <h5 class='modal-title'>Email Already Exists</h5>
                    </div>
                    <div class='modal-body text-center'>
                        <p>The email <strong>$email</strong> is already registered with an existing account.</p>
                        <p>Please use a different email or log in instead.</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='customer_dash.php' class='btn btn-danger'>Go Back</a>
                    </div>
                </div>
            </div>
        </div>";
    } else {
        $account_number = generateAcNumber($conn);
        $sql = "INSERT INTO account(users_id,account_number, full_name, dob, gender, adhar, email, mobile, address, account_type, deposit, id_proof, address_proof)
                VALUES ('$id','$account_number', '$name', '$dob', '$gender', '$aadhaar', '$email', '$mobile', '$address', '$account', '$deposit', '$id_proof', '$address_proof')";

        if (mysqli_query($conn, $sql)) {
            echo "
            <div class='modal fade show' style='display:block; background:rgba(0,0,0,0.5);'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header bg-success text-white'>
                            <h5 class='modal-title'>Account Created Successfully!</h5>
                        </div>
                        <div class='modal-body text-center'>
                            <p>Thank you, <strong>$name</strong>.</p>
                            <p>Your New Account Number:</p>
                            <h4 class='text-success'>$account_number</h4>
                        </div>
                        <div class='modal-footer'>
                            <a href='send_mail.php' class='btn btn-success'>Go to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>";
        } else {
            echo "<div class='alert alert-danger text-center m-5'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>
