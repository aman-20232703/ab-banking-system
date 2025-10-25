<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <title>Online KYC Upload</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Keep your preview box styles but translate to Tailwind utility classes */
  </style>
</head>
<body class="bg-gray-100 font-sans p-8">

  <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">📋 Online KYC Upload</h2>

    <form action="kyc_submit.php" method="POST" enctype="multipart/form-data" class="space-y-6">

      <!-- Photo Upload -->
      <div>
        <label for="photo" class="block font-semibold mb-2">Upload Photo:</label>
        <input
          type="file"
          name="photo"
          id="photo"
          accept="image/*"
          capture="user"
          onchange="previewImage(this, 'photoPreview')"
          required
          class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer
                 file:mr-4 file:py-2 file:px-4
                 file:rounded file:border-0
                 file:text-sm file:font-semibold
                 file:bg-indigo-600 file:text-white
                 hover:file:bg-indigo-700
        "
        />
        <div class="flex gap-4 mt-4">
          <img
            id="photoPreview"
            src="#"
            alt="Photo Preview"
            class="w-36 h-36 object-cover rounded border border-gray-300 hidden"
          />
        </div>
      </div>

      <!-- Signature Upload -->
      <div>
        <label for="signature" class="block font-semibold mb-2">Upload Signature:</label>
        <input
          type="file"
          name="signature"
          id="signature"
          accept="image/*"
          onchange="previewImage(this, 'signPreview')"
          required
          class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer
                 file:mr-4 file:py-2 file:px-4
                 file:rounded file:border-0
                 file:text-sm file:font-semibold
                 file:bg-indigo-600 file:text-white
                 hover:file:bg-indigo-700
        "
        />
        <div class="flex gap-4 mt-4">
          <img
            id="signPreview"
            src="#"
            alt="Signature Preview"
            class="w-36 h-36 object-cover rounded border border-gray-300 hidden"
          />
        </div>
      </div>

      <button
        type="submit"
        class="w-full bg-indigo-600 text-white py-2 rounded-md font-semibold hover:bg-indigo-700 transition"
      >
        Submit KYC
      </button>

    </form>
  </div>

  <script>
    function previewImage(input, previewId) {
      const preview = document.getElementById(previewId);
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
      } else {
        preview.src = '#';
        preview.classList.add('hidden');
      }
    }
  </script>

</body>
</html>
