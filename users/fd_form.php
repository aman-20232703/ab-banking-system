<?php
include 'dbconnect.php';
session_start();
$email = $_SESSION['user_email'] ?? '';
$sql = "SELECT * FROM account WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amarjesh Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md border mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Instructions for Opening an FD/RD Account</h2>

        <ol class="list-decimal list-inside text-gray-700 space-y-2 mb-6">
            <li>Ensure you have an active savings account with us.</li>
            <li>Decide whether you want to open an FD (Fixed Deposit) or RD (Recurring Deposit) account.</li>
            <li>Have your KYC (Know Your Customer) documents ready (Aadhaar, PAN, etc.).</li>
            <li>Choose your deposit amount and tenure (duration).</li>
            <li>Understand the interest rate applicable to your chosen tenure.</li>
            <li>Click on the "Open Account" button to proceed with the application form.</li>
        </ol>

        <button
            onclick="document.getElementById('fdRdForm').classList.remove('hidden');"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
            Open FD/RD Account
        </button>
    </div>

    <div id="fdRdForm" class="max-w-2xl mx-auto bg-gray-50 p-6 rounded-lg shadow-md border mt-6 hidden">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">FD/RD Account Opening Form</h3>


        <form id="fdForm" action="#" method="POST" class="space-y-6" onsubmit="return validateForm()">
            
            <div>
                <label class="block font-medium mb-1">Full Name</label>
                <input type="text" value="<?= $data['full_name'] ?? '' ?>" name="fullName" readonly
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Date of Birth</label>
                <input type="date" value="<?= $data['dob'] ?? '' ?>" name="dob" readonly
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" value="<?= $_SESSION['user_email'] ?? '' ?>" name="email" readonly
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Phone Number</label>
                <input type="tel" value="<?= $data['mobile'] ?? '' ?>" name="phone" readonly
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Deposit Type <span class="text-red-500">*</span></label>
                <select id="depositType" name="depositType" required onchange="toggleDepositType()"
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    <option value="">Select</option>
                    <option value="fd">Fixed Deposit (FD)</option>
                    <option value="rd">Recurring Deposit (RD)</option>
                </select>
            </div>

            
            <div id="fdSection" class="hidden">
                <div>
                    <label class="block font-medium mb-1">Deposit Amount <span class="text-red-500">*</span></label>
                    <input type="number" id="fdAmount" name="fd_amount" min="1000"
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500" oninput="calculateFdMaturity()">
                </div>

                <div>
                    <label class="block font-medium mb-1">Tenure (months) <span class="text-red-500">*</span></label>
                    <input type="number" id="fdTenure" name="fd_tenure" min="6"
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500" oninput="calculateFdMaturity()">
                </div>

                <div>
                    <label class="block font-medium mb-1">Interest Rate (% p.a.)</label>
                    <select id="fdInterest" name="fd_interestRate" class="w-full border px-3 py-2 rounded" onchange="calculateFdMaturity()">
                        <option value="6.5">6.5% (Regular)</option>
                        <option value="7.2">7.2% (Senior Citizen)</option>
                        <option value="7.5">7.5% (Long Term > 2 Years)</option>
                    </select>
                </div>

                <p id="fdMaturity" class="text-green-600 font-semibold"></p>
                <input type="hidden" id="fdmaturityValue" name="fd_maturity">

            </div>

            <div id="rdSection" class="hidden">
                <div>
                    <label class="block font-medium mb-1">Monthly Deposit <span class="text-red-500">*</span></label>
                    <input type="number" id="rdAmount" name="rd_amount" min="500"
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500" oninput="calculateRdMaturity()">
                </div>

                <div>
                    <label class="block font-medium mb-1">Tenure (months) <span class="text-red-500">*</span></label>
                    <input type="number" id="rdTenure" name="rd_tenure" min="6"
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500" oninput="calculateRdMaturity()">
                </div>

                <div>
                    <label class="block font-medium mb-1">Interest Rate (% p.a.)</label>
                    <input type="number" id="rdInterest" value="6.8" step="0.1" name="rd_interestRate"
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500" oninput="calculateRdMaturity()">
                </div>

                <p id="rdMaturity" class="text-green-600 font-semibold"></p>
                <input type="hidden" id="rdmaturityValue" name="rd_maturity">

            </div>

            <div>
                <label class="block font-medium mb-1">Nominee Name<span class="text-red-500">*</span></label>
                <input type="text" id="nominee" name="nominee" required
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                    Submit Application
                </button>
            </div>
        </form>

    </div>

    <script>
        function validateForm() {
            const type = document.getElementById('depositType').value;
            const amount = document.querySelector(`[name="amount"]`).value;
            const tenure = document.querySelector(`[name="tenure"]`).value;
            if (!type || amount <= 0 || tenure <= 0) {
                alert('Please fill all required fields correctly.');
                return false;
            }
            return true;
        }

        function toggleDepositType() {
            const type = document.getElementById('depositType').value;
            document.getElementById('fdSection').classList.add('hidden');
            document.getElementById('rdSection').classList.add('hidden');
            if (type === 'fd') document.getElementById('fdSection').classList.remove('hidden');
            if (type === 'rd') document.getElementById('rdSection').classList.remove('hidden');
        }

        // FD maturity = P + (P * R * T / 1200)
        function calculateFdMaturity() {
            const P = parseFloat(document.getElementById('fdAmount').value) || 0;
            const R = parseFloat(document.getElementById('fdInterest').value) || 0;
            const T = parseFloat(document.getElementById('fdTenure').value) || 0;
            if (P && R && T) {
                const maturity = P + (P * R * T) / 1200;
                document.getElementById('fdMaturity').textContent =
                    `Estimated Maturity Amount: ₹${maturity.toFixed(2)}`;
                document.getElementById('fdmaturityValue').value = maturity.toFixed(2);

            } else {
                document.getElementById('fdMaturity').textContent = '';
            }
        }

        // RD maturity = P * n(n+1)/2 * (R / (12*100))
        function calculateRdMaturity() {
            const P = parseFloat(document.getElementById('rdAmount').value) || 0;
            const n = parseFloat(document.getElementById('rdTenure').value) || 0;
            const R = parseFloat(document.getElementById('rdInterest').value) || 0;
            if (P && n && R) {
                const maturity = P * n + (P * n * (n + 1) / 2) * (R / (12 * 100));
                document.getElementById('rdMaturity').textContent =
                    `Total Deposit: ₹${(P * n).toFixed(2)}, Estimated Maturity Amount: ₹${maturity.toFixed(2)}`;
                document.getElementById('rdmaturityValue').value = maturity.toFixed(2);

            } else {
                document.getElementById('rdMaturity').textContent = '';
            }
        }
    </script>

</body>

</html>
<?php
function generateAcNumber($conn, $type)
{
    $prefix = strtoupper($type);
    do {
        $account_number = $prefix . rand(10000000, 99999999);
        $check = "SELECT account_number FROM fd_rd_accounts WHERE account_number = '$account_number'";
        $result = mysqli_query($conn, $check);
    } while (mysqli_num_rows($result) > 0);
    return $account_number;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullName'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $mobile = $_POST['phone'];
    $deposit_type = $_POST['depositType'];
    $nominee = $_POST['nominee'];
    if ($deposit_type === 'fd') {
        $amount = $_POST['fd_amount'];
        $tenure = $_POST['fd_tenure'];
        $interest = $_POST['fd_interestRate'];
        $maturity = $_POST['fd_maturity'];
    } else if ($deposit_type === 'rd') {
        $amount = $_POST['rd_amount'];
        $tenure = $_POST['rd_tenure'];
        $interest = $_POST['rd_interestRate'];
        $maturity = $_POST['rd_maturity'];
    } else {
        die("Invalid deposit type.");
    }

    $account_number = generateAcNumber($conn, $deposit_type);
    $sql = "INSERT INTO fd_rd_accounts(account_number, name, dob, email, phone, account_type, amount, tenure_months, interest, maturity_amount, nominee)
    VALUES ('$account_number', '$name', '$dob', '$email', '$mobile', '$deposit_type', '$amount', '$tenure', '$interest', '$maturity','$nominee');
    UPDATE account SET deposit = deposit-$amount WHERE email = '$email';";
    if ($conn->multi_query($sql)) {
        echo "
    <div class='modal fade show' style='display:block; background:rgba(0,0,0,0.5);' id='successModal'>
      <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
          <div class='modal-header bg-success text-white'>
            <h5 class='modal-title'>Account Created Successfully!</h5>
          </div>
          <div class='modal-body text-center'>
            <p>Thank you, <strong>$name</strong>.</p>
            <p>For creating a new <h4 class='text-success'>" . strtoupper($deposit_type) . " account</h4></p>
            <p>Your New Account Number:</p>
            <h4 class='text-success'>$account_number</h4>
          </div>
          <div class='modal-footer'>
            <a href='send_mail.php?type=" . urlencode($deposit_type) . "' class='btn btn-success'>Go to Dashboard</a>
          </div>
        </div>
      </div>
    </div>
    ";
    } else {
        echo "
    <div class='alert alert-danger text-center m-5'>
      Error: " . mysqli_error($conn) . "
    </div>";
    }
}



?>