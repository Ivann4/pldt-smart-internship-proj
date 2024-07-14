<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
    $db = Database::getInstance();
?>
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
<?php 
    require_once(__DIR__.'/../auth/auth.php');
    $db->initializeAssignedTasks($_SESSION['empId']);
?>

<script>
    // on-click event for submit button
    function clickButtonEvent(elem){
        console.log("button clicked");
        //var select = elem.parentElement.querySelector('select');
        //var selectedValue = select.value;
        //// map selectedValue to db status (Accomplished -> COMPLETE, In Progress -> IN-PROGRESS, Not Started -> NOT STARTED)
        //if(selectedValue === 'Accomplished') {
        //    selectedValue = 'COMPLETE';
        //} else if(selectedValue === 'In Progress') {
        //    selectedValue = 'IN-PROGRESS';
        //} else if(selectedValue === 'Not Started') {
        //    selectedValue = 'NOT STARTED';
        //}
        //var taskName = elem.parentElement.parentElement.querySelector('td a');
        //var task = taskName.textContent;
        //fetch('/auth/updateTaskStatus.php', {
        //    method: 'POST',
        //    headers: {
        //        'Content-Type': 'application/json'
        //    },
        //    body: JSON.stringify({
        //        task_id: task,
        //        status: selectedValue
        //    })
        //}).then(function(response) {
        //    if(response.ok) {
        //        alert('Task status updated successfully');
        //    } else {
        //        alert('Failed to update task status');
        //    }
        //});
    }

</script>

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
<?php
    $tasks = $db->getTasksByLimit(10);
    if($tasks->num_rows > 0) {
        while($row = $tasks->fetch_assoc()) {
            echo '<tr>';
            echo '<td><a href="#" onclick="showPopup(\''.$row['task_name'].'\', \''.$row['author'].'\', \''.$row['assignee'].'\', \''.$row['deadline'].'\', \''.$row['description'].'\'); return false;">'.$row['task_name'].'</a></td>';
            echo '<td>'.$row['deadline'].'</td>';
            echo '<td class="'.$row['priority'].'">'.$row['priority'].'</td>';
            echo '<td class="actions">';
            echo '<select>';
            echo '<option value="-">--Select an action--</option>';
            echo '<option value="Accomplished">Accomplished</option>';
            echo '<option value="In Progress">In Progress</option>';
            echo '<option value="Not Started">Not Started</option>';
            echo '</select>';
            echo '<button type="button" onclick="clickButtonEvent(this)">Submit</button>';
            echo '</td>';
            echo '</tr>';
        }
    }
?>
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
</div>

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
</script>
