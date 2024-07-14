
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
    </script>
</head>
<body>
    <main class="main">
        <div class="form-container">
            <div class="form-section">
                <h2>Create Task</h2>
            </div>
            <div class="form-group">
                <label for="first-name">Task Name</label>
                <input type="text" id="first-name" name="first_name" placeholder="ex: Process Template">
            </div>
            <div class="form-group">
                <label for="middle-name">Priority Level</label>
                <select id="prioritylvl" name="priority-level">
                    <option value="">-- Select Priority Level --</option>
                    <option value="Low">Low Priority !</option>
                    <option value="Moderate">Moderate Priority !!</option>
                    <option value="High">High Priority !!!</option>
                </select>
            </div>
            <div class="form-group full-width">
                <label for="address">Assign Task to (Employee ID)</label>
                <input type="text" id="assign-task" name="assign-task" placeholder="1">
            </div>
            <div class="form-group">
                <label for="reports-to">Task Deadline</label>
                <input type="Date" id="deadline">
            </div>
            <div class="form-group">
                <button type="button" onclick="addTask()">Add Task</button>
                <a href="#" class="menu-item" id="taskPool" onclick="loadContent('taskPool'); return false;">
                    Back
                </a>
            </div>
        </div>
    </main>
</main>


