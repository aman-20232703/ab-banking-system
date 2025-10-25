<?php
include 'dbconnect.php';
session_start();
$email = $_SESSION['user_email']??'';
if(!$email){
    echo "You are not a registered user";
}
$sql = "SELECT * FROM account WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Inter] p-8">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-indigo-600">Your Profile</h2>

        <div class="flex justify-center mb-6">
            <div class="w-24 h-24 rounded-full border-4 border-indigo-500 shadow-lg overflow-hidden">
                <img
                    src="../users/<?php echo htmlspecialchars($data['photo_path']) ?>"
                    alt="User Photo"
                    class="w-full h-full object-cover"
                >
           
            </div>
        </div>

        <table class="w-full text-left text-gray-700 border-collapse">
            <tbody>
                <tr class="border-b">
                    <td class="py-2 font-semibold w-1/3">Name:</td>
                    <td class="py-2"><?= htmlspecialchars($data['full_name']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Gender:</td>
                    <td class="py-2"><?= htmlspecialchars($data['gender']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Date of Birth:</td>
                    <td class="py-2"><?= htmlspecialchars($data['dob']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Account Number:</td>
                    <td class="py-2"><?= htmlspecialchars($data['account_number']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Email:</td>
                    <td class="py-2"><?= htmlspecialchars($data['email']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Mobile Number:</td>
                    <td class="py-2"><?= htmlspecialchars($data['mobile']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Address:</td>
                    <td class="py-2"><?= htmlspecialchars($data['address']) ?></td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 font-semibold">Balance:</td>
                    <td class="py-2">₹<?= htmlspecialchars($data['deposit']) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 text-center">
            <a href="customer_dash.php" class="inline-block px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                Go Back
            </a>
        </div>
    </div>
</body>
</html>

<?php } ?>
