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
            display: none;
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
                <img src="./media/create-emp.svg" alt="Create Icon" />
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
                <tr id="task-1">
                    <td><a href="#" onclick="showPopup('Task 1', 'John Doe', 'Jane Smith', '2024-06-25', 'Detailed description for Task 1.'); return false;">Task 1</a></td>
                    <td>2024-06-25</td>
                    <td class="high-priority">High !!!</td>
                    <td>IT P&G</td>
                    <td>john doe, jane doe</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="editTask('task-1', 'Task 1', 'High !!!', 'Detailed description for Task 1.', 'John Doe', 'IT Program and Governance')">Edit</button>
                        <button class="delete-btn" onclick="deleteTask('task-1')">Delete</button>
                    </td>
                </tr>
                <tr id="task-2">
                    <td><a href="#" onclick="showPopup('Task 2', 'Jane Doe', 'John Smith', '2024-07-01', 'Detailed description for Task 2.'); return false;">Task 2</a></td>
                    <td>2024-07-01</td>
                    <td class="moderate-priority">Moderate !!</td>
                    <td>IT P&G</td>
                    <td>john doe, jane doe</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="editTask('task-2', 'Task 2', 'Moderate !!', 'Detailed description for Task 2.', 'Jane Doe', 'Finance')">Edit</button>
                        <button class="delete-btn" onclick="deleteTask('task-2')">Delete</button>
                    </td>
                </tr>
                <tr id="task-3">
                    <td><a href="#" onclick="showPopup('Task 3', 'Alice Johnson', 'Bob Brown', '2024-07-10', 'Detailed description for Task 3.'); return false;">Task 3</a></td>
                    <td>2024-07-10</td>
                    <td class="low-priority">Low !</td>
                    <td>IT P&G</td>
                    <td>john doe, jane doe</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="editTask('task-3', 'Task 3', 'Low !', 'Detailed description for Task 3.', 'Alice Johnson', 'HR')">Edit</button>
                        <button class="delete-btn" onclick="deleteTask('task-3')">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="popup" id="popup">
            <div class="popup-content" id="popup-content"></div>
            <span class="close" onclick="closePopup()">X</span>
        </div>
    </main>
    <script>
        // Function to show task details popup
        function showPopup(title, proponent, assignee, deadline, description) {
            const popupContent = `
                <h2>${title}</h2>
                <p><strong>Proponent:</strong> ${proponent}</p>
                <p><strong>Assignee:</strong> ${assignee}</p>
                <p><strong>Deadline:</strong> ${deadline}</p>
                <p><strong>Description:</strong> ${description}</p>
            `;
            document.getElementById('popup-content').innerHTML = popupContent;
            document.getElementById('popup').style.display = 'block';
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        // Function to delete a task
        function deleteTask(taskId) {
            const taskRow = document.getElementById(taskId);
            if (taskRow) {
                taskRow.remove();
            }
        }

        // Function to edit a task
        function editTask(taskId, title, priority, description, proponent, department) {
            const taskRow = document.getElementById(taskId);
            if (!taskRow) return;

            const editFormHTML = `
                <div class="edit-form">
                    <label>Title:</label>
                    <input type="text" id="edit-title" value="${title}">
                    <label>Priority:</label>
                    <select id="edit-priority">
                        <option value="High !!!" ${priority === 'High !!!' ? 'selected' : ''}>High !!!</option>
                        <option value="Moderate !!" ${priority === 'Moderate !!' ? 'selected' : ''}>Moderate !!</option>
                        <option value="Low !" ${priority === 'Low !' ? 'selected' : ''}>Low !</option>
                    </select>
                    <label>Description:</label>
                    <input type="text" id="edit-description" value="${description}">
                    <label>Proponent:</label>
                    <input type="text" id="edit-proponent" value="${proponent}">
                    <label>Department:</label>
                    <input type="text" id="edit-department" value="${department}">
                    <div class="btn-container">
                        <button onclick="saveEditTask('${taskId}')">Save</button>
                        <button onclick="cancelEditTask('${taskId}')">Cancel</button>
                    </div>
                </div>
            `;

            // Replace current task row with the edit form
            taskRow.innerHTML = `
                <td colspan="5">
                    ${editFormHTML}
                </td>
            `;
        }

        // Function to save edited task
        function saveEditTask(taskId) {
            const taskRow = document.getElementById(taskId);
            if (!taskRow) return;

            const newTitle = document.getElementById('edit-title').value;
            const newPriority = document.getElementById('edit-priority').value;
            const newDescription = document.getElementById('edit-description').value;
            const newProponent = document.getElementById('edit-proponent').value;
            const newDepartment = document.getElementById('edit-department').value;

            const priorityClass = newPriority === 'High !!!' ? 'high-priority' :
                                  newPriority === 'Moderate !!' ? 'moderate-priority' : 'low-priority';

            // Update the task row with new values
            taskRow.innerHTML = `
                <td><a href="#" onclick="showPopup('${newTitle}', '${newProponent}', 'Assignee', 'Deadline', '${newDescription}'); return false;">${newTitle}</a></td>
                <td>Deadline</td>
                <td class="${priorityClass}">${newPriority}</td>
                <td>${newDepartment}</td>
                <td class="actions">
                    <button class="edit-btn" onclick="editTask('${taskId}', '${newTitle}', '${newPriority}', '${newDescription}', '${newProponent}', '${newDepartment}')">Edit</button>
                    <button class="delete-btn" onclick="deleteTask('${taskId}')">Delete</button>
                </td>
            `;
        }

        // Function to cancel task edit
        function cancelEditTask(taskId) {
            // Reload the page to reset the task list
            location.reload();
        }

        // Function to load content based on clicked menu item
        function loadContent(contentId) {
            console.log("Loading content for:", contentId);
        }
    </script>