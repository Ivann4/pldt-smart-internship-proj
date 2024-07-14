
<?php
    session_start();
    if (!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        header('Location: /auth/login.php');
        exit;
    }
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /auth/login.php');
        exit;
    }
?>
<main class="main">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section h2 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-group label {
            flex: 0 0 150px;
            margin-right: 10px;
            text-align: right;
            min-width: 150px;
        }

        .form-group input, .form-group select {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            min-width: 0;
        }

        .form-group.full-width {
            flex-wrap: nowrap;
        }

        .form-group.full-width label {
            flex: 0 0 150px;
        }

        .form-group.full-width input, .form-group.full-width select {
            flex: 1;
        }

        .form-group button {
            margin-left: 160px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3; /* Darker shade of #007bff */
        }
    </style>
    <script>
        function updateRoleOptions() {
            const department = document.getElementById('department').value;
            const role = document.getElementById('position');
            
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

        function updateEmployee() {
            const confirmUpdate = confirm("Are you sure you want to update this employee's information?");
            if (confirmUpdate) {
                alert("Employee information updated!");
                // Here you can add code to actually update the employee's information in the system, e.g., send the data to the server
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Update Employee</h2>
        <div class="form-group">
            <label for="employee-id">Employee ID</label>
            <input type="text" id="employee-id" name="employee_id" placeholder="Employee ID">
        </div>
        <div class="form-section">
            <h2>Full Name</h2>
        </div>
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first_name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-section">
            <h2>Contact Information</h2>
        </div>
        <div class="form-group full-width">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email Address">
        </div>
        <div class="form-section">
            <h2>Position and Department Information</h2>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <select id="department" name="department" onchange="updateRoleOptions()">
                <option value="">Select Department</option>
                <option value="it">IT Program and Governance</option>
                <option value="transport">Transport Network Facilities Management</option>
                <option value="cybersecurity">Cybersecurity</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <select id="position" name="position">
                <option value="">Select Position</option>
                <!-- Options will be populated based on department selection -->
            </select>
        </div>
        <div class="form-group">
            <button type="button" onclick="updateEmployee()">Update Employee</button>
            <a href="#" class="menu-item" id="empPool" onclick="loadContent('empPool'); return false;">
                    Back
            </a>
        </div>
    </div>
</main>
