<?php
include 'dbconnect.php';
session_start();
$uid = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Beneficiary Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-md rounded-lg w-full max-w-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Add Beneficiary</h2>

        <form id="beneficiaryForm" class="space-y-5" method="post">
            <!-- Full Name -->
            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input
                    type="text"
                    id="fullName"
                    name="fullName"
                    placeholder="Enter full name use spaces "
                    required
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- DOB -->
            <div>
                <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input
                    type="date"
                    id="dob"
                    name="dob"
                    required
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Account Number -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Account Number</label>
                <select
                    id="accountNumber"
                    name="accountNumber"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                    <option value="">--Select An Account Number--</option>
                </select>
            </div>

            <!-- Relationship -->
            <div>
                <label for="relationship" class="block text-sm font-medium text-gray-700 mb-1">Relationship</label>
                <input
                    type="text"
                    id="relationship"
                    name="relation"
                    placeholder="e.g. Spouse, Child, Parent"
                    required
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="+1 (555) 000-0000"
                    readonly
                    class="w-full border border-gray-300 rounded-md p-2.5 bg-gray-100 focus:outline-none" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="example@email.com"
                    readonly
                    class="w-full border border-gray-300 rounded-md p-2.5 bg-gray-100 focus:outline-none" />
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <button type="reset"
                    class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">
                    <a href="beneficiary.php"> Cancel</a>
                </button>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Add Beneficiary
                </button>
            </div>
        </form>
    </div>

    <script>
        const fullNameInput = document.getElementById('fullName');
        const dobInput = document.getElementById('dob');
        const phoneInput = document.getElementById('phone');
        const emailInput = document.getElementById('email');
        const accountSelect = document.getElementById('accountNumber');
        const form = document.getElementById('beneficiaryForm');

        // Fetch details automatically
        async function fetchBeneficiaryDetails() {
            const fullName = fullNameInput.value.trim();
            const dob = dobInput.value;
            if (!fullName || !dob) return;

            try {
                const response = await fetch(`getBeneficiary.php?fullName=${encodeURIComponent(fullName)}&dob=${encodeURIComponent(dob)}`);
                const data = await response.json();

                if (response.ok && data.success) {
                    phoneInput.value = data.phone || '';
                    emailInput.value = data.email || '';
                    accountSelect.innerHTML = '<option value="">--Select An Account Number--</option>';
                    data.accounts.forEach(acc => {
                        const option = document.createElement('option');
                        option.value = acc;
                        option.textContent = acc;
                        accountSelect.appendChild(option);
                    });
                } else {
                    phoneInput.value = '';
                    emailInput.value = '';
                    accountSelect.innerHTML = '<option value="">--Select An Account Number--</option>';
                }
            } catch (err) {
                console.error(err);
                alert('Error fetching beneficiary details.');
            }
        }

        fullNameInput.addEventListener('blur', fetchBeneficiaryDetails);
        dobInput.addEventListener('change', fetchBeneficiaryDetails);

    </script>

</body>

</html>

<?php

function beneficiary()
{
    $prefix = "BEN";
    $date = date('Ymd');
    $digit = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    return $prefix . $date . $digit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullName'];
    $dob = $_POST['dob'];
    $account = $_POST['accountNumber'];
    $relation = $_POST['relation'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $id = beneficiary();

    $check = "SELECT * FROM beneficiaries WHERE full_name = '$name'AND dob = '$dob' ";
    $result = mysqli_query($conn, $check);
        $sql = "INSERT INTO beneficiaries(users_id,beneficiary_id,full_name,dob,account_number,relationship,phone,email)
        VALUES('$uid','$id','$name','$dob','$account','$relation','$phone','$email')";
        mysqli_query($conn, $sql);
        echo "<script>
            alert('✅ Beneficiary added successfully.');
            window.location = ('beneficiary.php');
        </script>";
    
}
// else{
//      echo "<script>alert('❌ This customer is already added in beneficiary.');
//         window.location = ('beneficiary.php');</script>";
// }
?>