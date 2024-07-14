
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
    require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
    $db = Database::getInstance();
?>
<style>
        /* General styles */
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
        .main .high-priority {
            color: red;
        }
        .main .moderate-priority {
            color: #e6b800;
        }
        .main .low-priority {
            color: green;
        }

        /* Popup styles */
        .main .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 150%; /* Adjusted width */
            max-height: 100%;
            overflow: auto;
        }
        .main .popup-content {
            text-align: left;
        }
        .main .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        /* Styling for actions dropdown */
        .main .actions select {
            padding: 6px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .main .actions select:hover {
            border-color: #aaa;
        }
        .main .actions select:focus {
            border-color: #66afe9;
            outline: 0;
            box-shadow: 0 0 5px rgba(102, 175, 233, 0.6);
        }

        /* Button styles */
        .main .actions button {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 5px; /* Added margin for spacing */
        }

        .main .actions button:hover {
            background-color: #0056b3;
        }

        .main .actions .edit-btn {
            background-color: #007bff;
        }

        .main .actions .edit-btn:hover {
            background-color: #007bff;
        }

        .main .actions .delete-btn {
            background-color: #dc3545;
        }

        .main .actions .delete-btn:hover {
            background-color: #c82333;
        }

        /* Form styles */
        .main .edit-form {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .main .edit-form label {
            display: block;
            margin-bottom: 5px;
        }
        .main .edit-form input,
        .main .edit-form select {
            width: 100%;
            padding: 6px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .main .edit-form .btn-container {
            text-align: right;
        }
        .main .edit-form button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .main .edit-form button:hover {
            background-color: #45a049;
        }

        /* Horizontal menu styles */
        .task-menu {
            display: flex;
            justify-content: left;
            gap: 20px; /* Space between menu items */
            margin-bottom: 20px;
        }
        .task-menu-item {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
            text-align: center;
            gap: 8px; /* Space between image and text */
        }
        .task-menu-item img {
            width: 24px; /* Adjust the size as needed */
            height: 24px; /* Adjust the size as needed */
        }

    </style>
</head>
<body>
    <main class="main">
        <h2>Task Pool</h2>
        <div class="task-menu">
            <a href="#" class="task-menu-item" id="createTask" onclick="loadContent('createTask'); return false;">
                <img src="/assets/create-emp.svg" alt="Create Icon" />
                Create Task
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Deadline</th>
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Assigned to</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="task-table-body">
                <?php
                    $tasks = $db->getTasksByLimitAdmin(20);
                    while ($row = $tasks->fetch_assoc()) {
                        $priorityClass = '';
                        if ($row['priority'] === 'HIGH') {
                            $priorityClass = 'high-priority';
                        } else if ($row['priority'] === 'MODERATE') {
                            $priorityClass = 'moderate-priority';
                        } else {
                            $priorityClass = 'low-priority';
                        }
                        echo '<tr id="task-' . $row['task_id'] . '">';
                        echo '<td>'.$row['task_name'].'</td>';
                        echo '<td id="task-"'.$row['task_id'].'-deadline >' . $row['deadline'] . '</td>';
                        echo '<td class="' . $priorityClass . '">' . $row['priority'] . '</td>';
                        echo '<td>' . $row['Department'] . '</td>';
                        echo '<td>' . $row['user_id'] . '</td>';
                        echo '<td class="actions">';
                        echo '<button class="edit-btn" onclick="editTask(\'task-'.$row['task_id'].'\', \''.$row['task_name'].'\' , \''.$row['priority'].'\' , \''.$row['user_id'].'\' , \''.$row['Department'].'\')">';
                        echo 'Edit</button>';
                        echo '<button class="delete-btn" onclick="deleteTask(\'task-' . $row['task_id'] . '\')">Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <div class="popup" id="popup">
            <div class="popup-content" id="popup-content"></div>
            <span class="close" onclick="closePopup()">X</span>
        </div>
    </main>

