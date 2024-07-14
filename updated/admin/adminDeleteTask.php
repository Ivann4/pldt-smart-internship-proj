
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
<script>
            function showPopup(title, author, assignee, deadline, description) {
                document.getElementById('popup-title').textContent = title;
                document.getElementById('popup-author').textContent = author;
                document.getElementById('popup-assignee').textContent = assignee;
                document.getElementById('popup-deadline').textContent = deadline;
                document.getElementById('popup-description').textContent = description;
                document.getElementById('popup').style.display = 'block';
            }

            function hidePopup() {
                document.getElementById('popup').style.display = 'none';
            }

            function deleteTask(taskTitle) {
                // Logic to delete the task from the table or data model
                // For demonstration, let's remove the row from the table
                var table = document.querySelector('table');
                var rows = table.getElementsByTagName('tr');
                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];
                    if (row.cells[0].textContent === taskTitle) {
                        row.parentNode.removeChild(row);
                        break;
                    }
                }
                // After deleting, you might want to update your data model or perform other actions
            }
        </script>   
<main class="main">
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

        /* Delete button styles */
        .main .actions button {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .main .actions button:hover {
            background-color: #0056b3;
        }

        .main .actions .delete-btn {
            background-color: #dc3545;
        }

        .main .actions .delete-btn:hover {
            background-color: #c82333;
        }

    </style>
</head>
<body>
    <main class="main">

        <!-- Your existing content starts here -->
        <h2>Delete Task</h2>
        <table>
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Deadline</th>
                    <th>Priority</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#" onclick="showPopup('Task 1', 'John Doe', 'Jane Smith', '2024-06-25', 'Detailed description for Task 1.'); return false;">Task 1</a></td>
                    <td>2024-06-25</td>
                    <td class="high-priority">High !!!</td>
                    <td class="actions">
                        <button onclick="deleteTask('Task 1')">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="showPopup('Task 2', 'Jane Doe', 'John Smith', '2024-06-26', 'Detailed description for Task 2.'); return false;">Task 2</a></td>
                    <td>2024-06-26</td>
                    <td class="moderate-priority">Moderate !!</td>
                    <td class="actions">
                        <button onclick="deleteTask('Task 2')">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="showPopup('Task 3', 'John Smith', 'Jane Doe', '2024-06-27', 'Detailed description for Task 3.'); return false;">Task 3</a></td>
                    <td>2024-06-27</td>
                    <td class="low-priority">Low !</td>
                    <td class="actions">
                        <button onclick="deleteTask('Task 3')">Delete</button>
                    </td>
                </tr>
                <!-- Include other tasks as needed -->
            </tbody>
        </table>

        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="hidePopup()">&times;</span>
                <h2 id="popup-title"></h2>
                <p><strong>Author:</strong> <span id="popup-author"></span></p>
                <p><strong>Assignee:</strong> <span id="popup-assignee"></span></p>
                <p><strong>Deadline:</strong> <span id="popup-deadline"></span></p>
                <p><strong>Description:</strong></p>
                <p id="popup-description"></p>
            </div>
        </div>
    </main>
