<!DOCTYPE html>

<?php
session_start();
    $_SESSION['authType'] = 'register';
    $_SESSION['role'] = 'admin';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTask Hub Registration</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
            color: #212529;
        }

        .container {
            background-color: #ffffff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .title {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 16px;
            color: #212529;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 24px;
        }

        .divider {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #e0e0e0;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-field,
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background-color: #0E9344;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #106834;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="page1" class="form-card">
            <h1 class="title">DevTask Hub</h1>
            <p class="subtitle">Task Management System <b>(Admin Access)</b></p>
            <hr class="divider" />
            <h2 class="form-title">Account Registration</h2>
            <form id="form1">
                <input type="text" placeholder="First Name" class="input-field" />
                <input type="text" placeholder="Last Name" class="input-field" />
                <input type="email" placeholder="Email" class="input-field" />
                <input type="password" placeholder="Password" class="input-field" />
                <button type="button" class="submit-button" onclick="nextPage()">Next</button>
            </form>
        </div>
        <div id="page2" class="form-card hidden">
            <h1 class="title">DevTask Hub</h1>
            <p class="subtitle">Task Management System <b>(Admin Access)</b></p>
            <hr class="divider" />
            <h2 class="form-title">Account Registration</h2>
            <form id="form2">
                <label for="department">Choose a department:</label>
                <select name="department" id="department" class="input-field" onchange="updateRoleOptions()">
                    <option value="plchdr">   Department   </option>
                    <option value="it">IT Program and Governance</option>
                    <option value="transport">Transport Network Facilities Management</option>
                    <option value="cybersecurity">Cybersecurity</option>
                </select>
                <label for="role">Position:</label>
                <select name="role" id="role" class="input-field">
                    <!-- Options will be dynamically populated based on the department selection -->
                </select>
                <button type="button" class="submit-button" onclick="submitForm()">Submit</button>
            </form>
        </div>
    </div>
    <script>
        function nextPage() {
            document.getElementById('page1').classList.add('hidden');
            document.getElementById('page2').classList.remove('hidden');
        }

        function submitForm() {
            alert('Form submitted!');
            window.location.href = 'loginAdmin.php';
        }

        function updateRoleOptions() {
            const department = document.getElementById('department').value;
            const role = document.getElementById('role');
            
            // Clear existing options
            role.innerHTML = '';

            // Define the role options for each department
            const roles = {
                it: ['IT Project Manager', 'IT Data Analyst', 'Project Coordinator'],
                transport: ['Network Engineer', 'Infrastructure Manager', 'Operations Analyst'],
                cybersecurity: ['Information Security Consulting', 'Compliance Officer', 'Incident Responder']
            };

            // Populate the role dropdown based on the selected department
            if (department in roles) {
                roles[department].forEach(roleName => {
                    const option = document.createElement('option');
                    option.value = roleName.toLowerCase().replace(/\s+/g, '');
                    option.textContent = roleName;
                    role.appendChild(option);
                });
            }
        }
    </script>    
</body>
</html>
