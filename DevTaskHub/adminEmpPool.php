<main class="main">
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
    </style>
</head>
<body>
    <main class="main">
        <h2>Employee Pool</h2><br>
        <div class="emp-menu">
            <a href="#" class="emp-menu-item" id="createEmp" onclick="loadContent('createEmp'); return false;">
                <img src="./media/create-emp.svg" alt="Create Icon" />
                Create Employee
            </a>
            <a href="#" class="emp-menu-item" id="updateEmp" onclick="loadContent('updateEmp'); return false;">
                <img src="./media/edit-emp.svg" alt="Update Icon" />
                Update Employee
            </a>
            <a href="#" class="emp-menu-item" id="deleteEmp" onclick="loadContent('deleteEmp'); return false;">
                <img src="./media/del-emp.svg" alt="Delete Icon" />
                Delete Employee
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>IT Systems Analyst</td>
                    <td>IT P&G</td>
                </tr>
            </tbody>
        </table>
    </main>