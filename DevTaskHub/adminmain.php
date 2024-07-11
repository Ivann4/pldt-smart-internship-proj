<script>
    function editTask(title, details) {
    // Fill the form with current task details
    document.getElementById('task-title').value = title;
    document.getElementById('task-details').value = details;
    
    // Display the popup form
    document.getElementById('edit-popup').style.display = 'block';
}

function hidePopup() {
    document.getElementById('edit-popup').style.display = 'none';
}

function saveTaskChanges() {
    // Retrieve edited task details from form
    var newTitle = document.getElementById('task-title').value;
    var newDetails = document.getElementById('task-details').value;

    // Update the corresponding task card with the new details
    var taskCards = document.getElementsByClassName('task-card');
    for (var i = 0; i < taskCards.length; i++) {
        var taskCard = taskCards[i];
        if (taskCard.querySelector('h3').textContent === newTitle) {
            taskCard.querySelector('h3').textContent = newTitle;
            taskCard.querySelector('p').textContent = newDetails;
            break;
        }
    }

    // Hide the popup form after saving changes
    hidePopup();

    // Prevent form submission
    return false;
}
</script>
<main class="main">
    <?php include 'adminheader.php'; ?>
    <div id="dynamic-content">
        <div class="container">
            <h2><b>Dashboard</b></h2>
            <div class="task-pool">
            <div class="task-card" onclick="editTask('KMZ Map Routing', '95 Total Tasks')">
                    <h3>KMZ Map Routing</h3>
                    <p>95 Total Tasks</p>
                </div>
                <div class="task-card" onclick="editTask('Support Facility Inventory', '199 Total Tasks')">
                    <h3>Support Facility Inventory</h3>
                    <p>199 Total Tasks</p>
                </div>
                <div class="task-card" onclick="editTask('IT Process Template', '199 Total Tasks')">
                    <h3>IT Process Template</h3>
                    <p>199 Total Tasks</p>
                </div>
                <div class="task-card" onclick="editTask('Support Facility Inventory', '199 Total Tasks')">
                    <h3>Support Facility Inventory</h3>
                    <p>199 Total Tasks</p>
                </div>

             <!-- Popup Form for Editing Task -->
    <div id="edit-popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="hidePopup()">&times;</span>
            <h2>Edit Task</h2>
            <form id="edit-task-form" onsubmit="return saveTaskChanges()">
                <div class="form-group">
                    <label for="task-title">Task Title</label>
                    <input type="text" id="task-title" name="task_title" required>
                </div>
                <div class="form-group">
                    <label for="task-details">Task Details</label>
                    <textarea id="task-details" name="task_details" rows="4" required></textarea>
                </div>
                <div class="btn-container">
                    <button type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
            </div>
            <div class="deadlines-header">
                <h2><b>My Deadlines</b></h2>
            </div>
            <div class="deadlines">
                <div class="deadline-card">
                    <div class="content">
                        <p>Module Reports</p>
                        <p>12-Jun-24</p>
                    </div>
                </div>
                <div class="deadline-card">
                    <div class="content">
                        <p>Module Reports</p>
                        <p>12-Jun-24</p>
                    </div>
                </div>
                <div class="deadline-card">
                    <div class="content">
                        <p>Module Reports</p>
                        <p>12-Jun-24</p>
                    </div>
                </div>
                <div class="deadline-card">
                    <div class="content">
                        <p>Module Reports</p>
                        <p>12-Jun-24</p>
                    </div>
                </div>
                <div class="deadline-card">
                    <div class="content">
                        <p>Module Reports</p>
                        <p>12-Jun-24</p>
                    </div>
                </div>
                <div class="deadline-card">
                    <div class="content">
                        <p>Module Reports</p>
                        <p>12-Jun-24</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
