<?php
function renderTaskTable() {
    $html = '
    <style>
        /* Styles specific to task table */
        .task-table-container {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .task-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        .task-table th, .task-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center; /* Center text */
            background-color: #fff; /* Set background color to white */
        }
        .task-table th {
            background-color: #f2f2f2;
        }
        .task-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .task-table tr:hover {
            background-color: #ddd;
        }
        .task-table .high-priority {
            color: red;
        }
        .task-table .moderate-priority {
            color: #e6b800;
        }
        .task-table .low-priority {
            color: green;
        }

        /* Popup styles */
        .popup {
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
        .popup-content {
            text-align: left;
        }
        .popup .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        /* Styling for actions dropdown */
        .task-table .actions {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .task-table .actions select {
            padding: 6px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .task-table .actions select:hover {
            border-color: #aaa;
        }
        .task-table .actions select:focus {
            border-color: #66afe9;
            outline: 0;
            box-shadow: 0 0 5px rgba(102, 175, 233, 0.6);
        }
        .task-table .actions button {
            padding: 6px 10px;
            margin-left: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .task-table .actions button:hover {
            background-color: #0056b3;
        }
    </style>
    
    <div class="task-table-container">
        <table class="task-table">
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
                    <td><a href="#" onclick="showPopup(\'Task 1\', \'John Doe\', \'Jane Smith\', \'2024-06-25\', \'Detailed description for Task 1.\'); return false;">Task 1</a></td>
                    <td>2024-06-25</td>
                    <td class="high-priority">High !!!</td>
                    <td class="actions">
                        <select>
                            <option value="-">--Select an action--</option>
                            <option value="Accomplished">Accomplished</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Not Started">Not Started</option>
                        </select>
                        <button type="button">Submit</button>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="showPopup(\'Task 2\', \'Alice Brown\', \'Bob Green\', \'2024-07-01\', \'Detailed description for Task 2.\'); return false;">Task 2</a></td>
                    <td>2024-07-01</td>
                    <td class="moderate-priority">Moderate</td>
                    <td class="actions">
                        <select>
                            <option value="-">--Select an action--</option>
                            <option value="Accomplished">Accomplished</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Not Started">Not Started</option>
                        </select>
                        <button type="button">Submit</button>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="showPopup(\'Task 3\', \'Charlie White\', \'David Black\', \'2024-07-15\', \'Detailed description for Task 3.\'); return false;">Task 3</a></td>
                    <td>2024-07-15</td>
                    <td class="low-priority">Low</td>
                    <td class="actions">
                        <select>
                            <option value="-">--Select an action--</option>
                            <option value="Accomplished">Accomplished</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Not Started">Not Started</option>
                        </select>
                        <button type="button">Submit</button>
                    </td>
                </tr>
                <!-- Add more tasks here -->
            </tbody>
        </table>
    </div>

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
    </div>';

    // JavaScript for showing and hiding popup
    $html .= '
    <script>
        function showPopup(title, author, assignee, deadline, description) {
            document.getElementById(\'popup-title\').textContent = title;
            document.getElementById(\'popup-author\').textContent = author;
            document.getElementById(\'popup-assignee\').textContent = assignee;
            document.getElementById(\'popup-deadline\').textContent = deadline;
            document.getElementById(\'popup-description\').textContent = description;
            document.getElementById(\'popup\').style.display = \'block\';
        }

        function hidePopup() {
            document.getElementById(\'popup\').style.display = \'none\';
        }
    </script>';

    return $html;
}   

if (isset($_GET["getTasks"])) { // corrected array index quotes
    echo renderTaskTable();
    exit;
}
?>
