<main class="main">
<script>
        function fetchEmployeeDetails() {
            const employeeId = document.getElementById('employee-id').value;
    
            // Simulated data - replace with actual data retrieval logic
            const employeeData = {
                employee_id: '14',
                last_name: 'Specter',
                first_name: 'Harvey',
                department: 'Pearson-Specter-Litt',
                job_title: 'Corporate Attorney'
            };
    
            // Update summary with employee data
            document.getElementById('summary-employee-id').textContent = employeeData.employee_id;
            document.getElementById('summary-last-name').textContent = employeeData.last_name;
            document.getElementById('summary-first-name').textContent = employeeData.first_name;
            document.getElementById('summary-department').textContent = employeeData.department;
            document.getElementById('summary-job-title').textContent = employeeData.job_title;
    
            // Show summary container
            const summaryContainer = document.getElementById('summary-container');
            summaryContainer.style.display = 'block';
        }
    
        function confirmDelete() {
            const employeeId = document.getElementById('employee-id').value;
            const confirmed = confirm(`Are you sure you want to delete employee with ID ${employeeId}?`);
    
            if (confirmed) {
                // Implement delete logic here
                alert('Deleting employee...');
            } else {
                // Optionally, you can provide feedback or take other actions if the user cancels
                console.log('Deletion canceled.');
            }
        }
    </script>
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
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            background-color: #dc3545; /* Bootstrap's danger color */
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
    
        .form-group button:hover {
            background-color: #c82333; /* Darker shade of #dc3545 */
        }
    
        .summary-container {
            max-width: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: #f5f5f5;
            border-radius: 5px;
            width: 350px;
            margin: 20px auto;
        }
    
        .summary-header {
            color: #007bff;
            font-size: 1.25em;
            margin-bottom: 20px;
            text-align: center;
        }
    
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    
        .summary-label {
            font-weight: bold;
        }
    
        .summary-value {
            text-align: right;
        }

        #delete-button {
            margin-left: 160px;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            background-color: #dc3545; /* Bootstrap's danger color */
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        #delete-button:hover {
            background-color: #c82333; /* Darker shade of #dc3545 */
        }
    </style>
    
    <h2>Delete Employee</h2>
    <div class="form-container">
        <div class="form-group">
            <label for="employee-id">Enter Employee ID:</label>
            <input type="text" id="employee-id" name="employee_id" placeholder="Employee ID">
            <button onclick="fetchEmployeeDetails()">Show Details</button>
            <a href="#" class="menu-item" id="empPool" onclick="loadContent('empPool'); return false;">
                    Back
            </a>
        </div>
        <div class="summary-container" id="summary-container" style="display: none;">
            <div class="summary-header">Employee Summary</div>
            <div class="summary-row">
                <div class="summary-label">Employee ID</div>
                <div class="summary-value" id="summary-employee-id"></div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Last Name</div>
                <div class="summary-value" id="summary-last-name"></div>
            </div>
            <div class="summary-row">
                <div class="summary-label">First Name</div>
                <div class="summary-value" id="summary-first-name"></div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Department</div>
                <div class="summary-value" id="summary-department"></div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Job Title</div>
                <div class="summary-value" id="summary-job-title"></div>
            </div>
            <button id="delete-button" onclick="confirmDelete()">Delete Employee</button>
        </div>
    </div>
</main>
