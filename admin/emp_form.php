<?php
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Credential Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f5f7fb;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .form-wrapper {
            margin: 40px 16px;
            max-width: 600px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            padding: 24px 20px;
        }

        .form-header {
            margin-bottom: 16px;
            text-align: center;
        }

        .form-header h2 {
            margin: 0 0 8px;
            font-size: 24px;
            color: #111827;
        }

        .form-header p {
            margin: 0;
            font-size: 13px;
            color: #6b7280;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 12px;
        }

        .form-group.full {
            grid-column: 1 / 3;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
            background: #f9fafb;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15);
            background: #ffffff;
        }

        textarea {
            resize: vertical;
            min-height: 70px;
        }

        .helper {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            margin: 8px 0 16px;
        }

        .checkbox-row input {
            width: 16px;
            height: 16px;
        }

        .btn-row {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 8px;
        }

        .btn {
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #4f46e5;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .error-msg {
            font-size: 12px;
            color: #b91c1c;
            margin-top: -2px;
            margin-bottom: 6px;
            display: none;
        }

        .success-banner,
        .error-banner {
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 12px;
            display: none;
        }

        .success-banner {
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .error-banner {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

    <div class="form-wrapper">
        <div class="form-header">
            <h2>Employee Credential Request</h2>
            <p>New employee requesting Employee ID & access from the Manager.</p>
        </div>

        <!-- banners -->
        <div id="successBanner" class="success-banner">
            ✅ Request submitted successfully. Your manager will review and share your credentials.
        </div>
        <div id="errorBanner" class="error-banner">
            ⚠️ Please fix the highlighted fields and try again.
        </div>

        <form id="credentialRequestForm" method="POST" novalidate>
            <div class="form-grid">
                <!-- Employee details -->
                <div class="form-group">
                    <label for="employee_name">Employee Full Name *</label>
                    <input type="text" id="employee_name" name="name" required>
                    <div class="error-msg" id="error_employee_name">Employee name is required.</div>
                </div>

                <div class="form-group">
                    <label for="employee_email">Official Email *</label>
                    <input type="email" id="employee_email" name="email" required>
                    <div class="error-msg" id="error_employee_email">Valid email is required.</div>
                </div>

                <div class="form-group">
                    <label for="phone">Mobile Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Optional">
                </div>

                <div class="form-group">
                    <label for="branch">Branch *</label>
                    <input type="text" id="branch" name="branch" placeholder="e.g., Delhi - CP Branch" required>
                    <div class="error-msg" id="error_branch">Branch is required.</div>
                </div>

                <div class="form-group">
                    <label for="department">Department *</label>
                    <select id="department" name="department" required>
                        <option value="">Select</option>
                        <option value="Operations">Operations</option>
                        <option value="Customer Service">Customer Service</option>
                        <option value="Loans">Loans</option>
                        <option value="Accounts">Accounts</option>
                        <option value="IT Support">IT Support</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="error-msg" id="error_department">Department is required.</div>
                </div>

                <div class="form-group">
                    <label for="role">Designation / Role *</label>
                    <input type="text" id="role" name="role" placeholder="e.g., Teller, Relationship Officer" required>
                    <div class="error-msg" id="error_role">Role is required.</div>
                </div>

                <div class="form-group">
                    <label for="joining_date">Joining Date *</label>
                    <input type="date" id="joining_date" name="date" required>
                    <div class="error-msg" id="error_joining_date">Joining date is required.</div>
                </div>

                <!-- Manager details -->
                <div class="form-group">
                    <label for="manager_id">Manager ID / Code *</label>
                    <input type="text" id="manager_id" name="manager_id" placeholder="Manager's employee code" required>
                    <div class="error-msg" id="error_manager_id">Manager ID is required.</div>
                </div>

                <div class="form-group">
                    <label for="manager">Manager Name</label>
                    <input type="text" id="manager_name" name="manager_name" placeholder="Optional">
                </div>

                <!-- Username preference -->
                <div class="form-group full">
                    <label for="preferred_username">Preferred Employee Username (optional)</label>
                    <input type="text" id="preferred_username" name="username"
                        placeholder="e.g., ram.yadav, ryadav01">
                    <div class="helper">Final ID will be confirmed by the manager / system.</div>
                </div>

                <!-- Reason / notes -->
                <div class="form-group full">
                    <label for="reason">Reason / Additional Details *</label>
                    <textarea id="reason" name="reason" required
                        placeholder="Example: New joiner in Branch Operations, needs access to employee portal & internal systems."></textarea>
                    <div class="error-msg" id="error_reason">Reason is required.</div>
                </div>
            </div>

            <!-- confirmation -->
            <div class="checkbox-row">
                <input type="checkbox" id="confirm" name="confirm">
                <label for="confirm">I confirm that the information provided above is correct.</label>
            </div>
            <div class="error-msg" id="error_confirm">You must confirm the information.</div>

            <div class="btn-row">
                <button type="reset" class="btn btn-secondary">Clear</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById("credentialRequestForm");
        const successBanner = document.getElementById("successBanner");
        const errorBanner = document.getElementById("errorBanner");

        form.addEventListener("submit", function(e) {
            // front-end validation
            let hasError = false;
            errorBanner.style.display = "none";
            successBanner.style.display = "none";

            function requireField(id) {
                const input = document.getElementById(id);
                const errorEl = document.getElementById("error_" + id);
                if (!input.value.trim()) {
                    hasError = true;
                    errorEl.style.display = "block";
                } else {
                    errorEl.style.display = "none";
                }
            }

            requireField("employee_name");
            requireField("employee_email");
            requireField("branch");
            requireField("department");
            requireField("role");
            requireField("joining_date");
            requireField("manager_id");
            requireField("reason");

            // email format basic check
            const email = document.getElementById("employee_email");
            const emailError = document.getElementById("error_employee_email");
            if (email.value && !/^\S+@\S+\.\S+$/.test(email.value)) {
                hasError = true;
                emailError.textContent = "Please enter a valid email address.";
                emailError.style.display = "block";
            }

            // confirm checkbox
            const confirmCheck = document.getElementById("confirm");
            const confirmError = document.getElementById("error_confirm");
            if (!confirmCheck.checked) {
                hasError = true;
                confirmError.style.display = "block";
            } else {
                confirmError.style.display = "none";
            }

            if (hasError) {
                e.preventDefault();
                errorBanner.style.display = "block";
            } else {
                // allow normal form submit to PHP
                // you can also show success after PHP response
            }
        });
    </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $role = $_POST['role'];
    $date = $_POST['date'];
    $manager_id = $_POST['manager_id'];
    $manager_name = $_POST['manager_name'];
    $username = $_POST['username'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO employee(employee_name,employee_email, phone,branch,department,role,joining_date,manager_id,manager_name,preferred_username,reason)
     VALUES('$name','$email','$phone','$branch','$department','$role','$date','$manager_id','$manager_name','$username','$reason')";
    if (mysqli_query($conn, $sql)) {

        echo "<script>
            alert('✅ Request Submitted Successfully.Status: Pending',
            );
          </script>";
    } else {

        $error = mysqli_error($conn);

        echo "<script>
            alert(
                '❌ Failed to submit your request.'
                
            );
          </script>";
    }
}
?>