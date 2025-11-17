<?php
include('dbconnect.php');

$query = "SELECT * FROM account WHERE status='Pending'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pending Applications</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Inter] p-8">
  <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6">Pending Account Applications</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-200 divide-y divide-gray-300">
        <thead class="bg-gray-100 text-left text-gray-700 uppercase text-sm">
          <tr>
            <th class="px-4 py-3">Account No</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Mobile</th>
            <th class="px-4 py-3 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-800">
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr class="hover:bg-gray-50 border-t">
            <td class="px-4 py-3"><?= htmlspecialchars($row['account_number']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['full_name']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['email']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['mobile']) ?></td>
            <td class="px-4 py-3 text-center">
              <a href="review.php?mobile=<?= urlencode($row['mobile']) ?>" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded transition">
                Review
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
