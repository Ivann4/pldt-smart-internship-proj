
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
<?php
class empDashboard {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render() {
        include '../common/head.php';
        echo '<body>';
        echo '<div class="dashboard">';
        include 'adminsidebar.php';
        include 'adminmain.php';
        include 'adminright-sidebar.php';
        echo '</div>';
        include 'footer.php';
    }
}

$user = array(
    'name' => 'ivannavi_',
);

$dashboard = new empDashboard($user);
$dashboard->render();


?>

<script>
    function consolidateAllForms() {
        const fname = document.getElementById('first-name').value;
        const lname = document.getElementById('last-name').value;
        const email = document.getElementById('email').value;
        const department = document.getElementById('department').value;
        const position = document.getElementById('position').value;
        const employee_id = document.getElementById('employee-id').value;
        return { fname, lname, email, department, position, employee_id};
    }
    
    function addEmployee() {
        const confirmAdd = confirm("Are you sure you want to add this employee to the system?");
        if (confirmAdd) {
            const employeeData = consolidateAllForms();
            var value = fetch('/auth/auth.php?authType=3', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(employeeData)
            });
        }
    }

    function updateEmployee() {
        const confirmAdd = confirm("Are you sure you want to add this employee to the system?");
        if (confirmAdd) {
            const employeeData = consolidateAllForms();
            var value = fetch('/auth/auth.php?authType=4', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(employeeData)
            });
        }
    }

    function deleteEmployee() {
        const confirmAdd = confirm("Are you sure you want to add this employee to the system?");
        if (confirmAdd) {
            const employee_id = document.getElementById('employee-id').value;
            var value = fetch('/auth/auth.php?authType=5', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({employee_id})
            });
        }
    }

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
                    option.value = roleName.toLowerCase();
                    option.textContent = roleName;
                    role.appendChild(option);
                });
            }
        }

    function fetchEmployeeDetails() {
        const employeeId = document.getElementById('employee-id').value;

        var employeeData = fetch('/auth/auth.php?authType=6&id=' + employeeId)
.then(response => response.text()).
then(data => {
    data = JSON.parse(data);
    document.getElementById('summary-employee-id').innerHTML = data.fname;
    document.getElementById('summary-last-name').innerHTML = data.lname;
    document.getElementById('summary-first-name').innerHTML = data.email;
    document.getElementById('summary-department').innerHTML = data.Department;
    document.getElementById('summary-job-title').innerHTML = data.position;
});

        // Show summary container
        const summaryContainer = document.getElementById('summary-container');
        summaryContainer.style.display = 'block';
    }
</script>

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
        //
        function deleteTask(taskId) {
            var real_id = taskId.split('-');
            real_id = real_id[1];
            fetch('/auth/auth.php?authType=8', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({task_id: real_id})
            });
            window.location.href = "/admin/adminDashboard.php";

        }
        // Function to edit a task
        function editTask(taskId, title, priority, proponent, department) {
            const taskRow = document.getElementById(taskId);
            if (!taskRow) return;

            var real_id = taskId.split('-');
            real_id = real_id[1];

            const editFormHTML = `
                <div class="edit-form">
                    <input type="hidden" id="edit-task-id" value="${taskId} name="task_id"">
                    <label>Title:</label>
                    <input type="text" id="edit-title" value="${title}">
                    <label>Priority:</label>
                    <select id="edit-priority">
                        <option value="High !!!" ${priority === 'High !!!' ? 'selected' : ''}>High !!!</option>
                        <option value="Moderate !!" ${priority === 'Moderate !!' ? 'selected' : ''}>Moderate !!</option>
                        <option value="Low !" ${priority === 'Low !' ? 'selected' : ''}>Low !</option>
                    </select>
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
            var taskRow = document.getElementById(taskId);
            if (!taskRow) return;

            var real_id = taskId.split('-');
            real_id = real_id[1];

            var newTitle = document.getElementById('edit-title').value;
            var newPriority = document.getElementById('edit-priority').value;
            var newProponent = document.getElementById('edit-proponent').value;
            var newDepartment = document.getElementById('edit-department').value;
            console.log(newTitle, newPriority, newProponent, newDepartment);

            var priorityClass = "";
            if(newPriority === 'High !!!') {
                priorityClass = 'HIGH';
            } else if(newPriority === 'Moderate !!') {
                priorityClass = 'MODERATE';
            } else {
                priorityClass = 'LOW';
            }
            
            fetch('/auth/auth.php?authType=7', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({task_id: real_id, task_name: newTitle, priority: priorityClass, user_id: newProponent, Department: newDepartment})
            });

            window.location.href = "/admin/adminDashboard.php";
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


<script>
    function consolidateFormDataCreate() {
        const taskName = document.getElementById('first-name').value;
        const priorityLevel = document.getElementById('prioritylvl').value;
        const user_id = document.getElementById('assign-task').value;
        const deadline = document.getElementById('deadline').value;

        var priorityClass = '';
        if(priorityLevel === 'Low') {
            priorityClass = 'LOW';
        } else if(priorityLevel === 'Moderate') {
            priorityClass = 'MODERATE';
        } else if(priorityLevel === 'High') {
            priorityClass = 'HIGH';
        }
        return {
            empId: user_id,
            task_name: taskName,
            deadline: deadline,
            priority: priorityClass,
        };
    }
    
    function addTask() {
        const confirmAdd = confirm("Are you sure you want to add this task to the system?");
        if (confirmAdd) {
            const formData = consolidateFormDataCreate();
            console.log(formData);
            fetch('/auth/auth.php?authType=9', {
                method: 'POST',
                body: JSON.stringify(formData)
            });
            alert("Task added to the system!");
            location.reload();
        }
    }
</script>

<script>
    async function processEmployeeName(){
        const empName = document.getElementById('emp-name').value;
        const limit = 10;
        
        // get the task assigned to the employee
        // returns a mysql result object
        var element = document.getElementById('task-table-body');
        element.innerHTML = '';

        var tasks = await fetch('/auth/auth.php?authType=10', {
            method: 'POST',
            body: JSON.stringify({empId: empName, limit})
        }).then(response => response.text())
        .then(data => {
            data = JSON.parse(data);
            console.log(data);
            data.forEach(task => {
                priorityClass = '';
                if (task.priority === 'HIGH') {
                    priorityClass = 'high-priority';
                } else if (task.priority === 'MODERATE') {
                    priorityClass = 'moderate-priority';
                } else {
                    priorityClass = 'low-priority';
                }
                element.innerHTML += `
                    <tr id="task-${task.task_id}">
                        <td>${task.task_name}</td>
                        <td>${task.deadline}</td>
                        <td class="${priorityClass}">${task.priority}</td>
                        <td>${task.department}</td>
                        <td>${task.user_id}</td>
                        <td>${task.status}</td>
                    </tr>
                `;
            })
});
    }
</script>

