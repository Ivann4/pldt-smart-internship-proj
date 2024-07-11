<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <style>
        /* General styles */
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Table styles */
        .main table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        .main th, .main td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center; /* Center text */
            background-color: #fff; /* Set background color to white */
        }
        .main th {
            background-color: #f2f2f2;
        }
        .main tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .main tr:hover {
            background-color: #ddd;
        }

        /* Horizontal menu styles */
        .emp-menu {
            display: flex;
            justify-content: left;
            gap: 20px; /* Space between menu items */
            margin-bottom: 20px;
        }
        .emp-menu-item {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
            text-align: center;
            gap: 8px; /* Space between image and text */
        }
        .emp-menu-item img {
            width: 24px; /* Adjust the size as needed */
            height: 24px; /* Adjust the size as needed */
        }

        /* Form styles */
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

        function addTask() {
            const confirmAdd = confirm("Are you sure you want to add this task to the system?");
            if (confirmAdd) {
                alert("Task added to the system!");
                // mode code hereeeee
            }
        }

        function processEmployeeName() {
            const empID = document.getElementById('emp-id').value;
            alert(`Processing Employee ID: ${empID}`);
            // Add your code here to process the Employee ID
        }
    </script>
</head>
<body>
    <main class="main">
        <div class="form-container">
            <div class="form-section">
                <h2>User Reports</h2>
            </div>
            <div class="form-group">
                <label for="emp-name">Employee Name</label>
                <input type="text" id="emp-name" name="emp-name" placeholder="Enter Employee ID for specific set of tasks for each employee">
                <button onclick="processEmployeeName()">Submit</button>
            </div>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Deadline</th>
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Assigned to</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="task-table-body">
                <tr id="task-1">
                    <td><a href="#" onclick="showPopup('Task 1', 'John Doe', 'Jane Smith', '2024-06-25', 'Detailed description for Task 1.'); return false;">Task 1</a></td>
                    <td>2024-06-25</td>
                    <td class="high-priority">High !!!</td>
                    <td>IT P&G</td>
                    <td>john doe, jane doe</td>
                    <td>Accomplished</td>
                </tr>
                <tr id="task-2">
                    <td><a href="#" onclick="showPopup('Task 2', 'Jane Doe', 'John Smith', '2024-07-01', 'Detailed description for Task 2.'); return false;">Task 2</a></td>
                    <td>2024-07-01</td>
                    <td class="moderate-priority">Moderate !!</td>
                    <td>IT P&G</td>
                    <td>john doe, jane doe</td>
                    <td>Accomplished</td>
                </tr>
                <tr id="task-3">
                    <td><a href="#" onclick="showPopup('Task 3', 'Alice Johnson', 'Bob Brown', '2024-07-10', 'Detailed description for Task 3.'); return false;">Task 3</a></td>
                    <td>2024-07-10</td>
                    <td class="low-priority">Low !</td>
                    <td>IT P&G</td>
                    <td>john doe, jane doe</td>
                    <td>Accomplished</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>
