<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
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
            background-color: #0069d9;
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

        function addEmployee() {
            const confirmAdd = confirm("Are you sure you want to add this employee to the system?");
            if (confirmAdd) {
                alert("Employee added to the system!");
                // Here you can add code to actually add the employee to the system, e.g., send the data to the server
            }
        }
    </script>
</head>
<body>
    <main class="main">
        <div class="form-container">
            <div class="form-section">
                <h2>Create Employee</h2>
                <h2>Full Name</h2>
            </div>
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="middle-name">Middle Name</label>
                <input type="text" id="middle-name" name="middle_name" placeholder="Middle Name">
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
            <div class="form-group full-width">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number">
            </div>
            <div class="form-group full-width">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Address">
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
                <label for="reports-to">Reports to</label>
                <input type="text" id="reports-to" name="reports_to" placeholder="Reports to">
            </div>
            <div class="form-group">
                <button type="button" onclick="addEmployee()">Add Employee</button>
                <a href="#" class="menu-item" id="empPool" onclick="loadContent('empPool'); return false;">
                    Back
                </a>
            </div>
        </div>
    </main>
</body>
</html>
