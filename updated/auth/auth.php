<?php
    session_start();

    class Database {
        private $host = 'localhost';
        private $db_name = '';
        private $username = '';
        private $password = '';
        private $assignedTasks = 0;
        private $completedTasks = 0;
        private $pendingTasks = 0;
        private $inprogressTasks = 0;
        private $fullname = '';
        private $ITTasks = 0;
        private $TransportTasks = 0;
        private $CyberSecurityTasks = 0;
        public $conn;

        private static $instances = [];
        protected function __construct() { }
        protected function __clone() { }
        public function __wakeup() {
            throw new \Exception("Cannot unserialize a singleton.");
        }
        public static function getInstance() {
            $cls = static::class;
            if (!isset(self::$instances[$cls])) {
                self::$instances[$cls] = new static;
                self::$instances[$cls]->initEnvironment();
            }
            return self::$instances[$cls];
        }
        
        private function initEnvironment() {
            $root = $_SERVER['DOCUMENT_ROOT'];
            $envFile = $root . '/.env';
            if(file_exists($envFile)){
                $file = new \splFileObject($envFile);
                
                while (!$file->eof()) {
                    $line = $file->fgets();
                    $line = explode('=', $line);
                    $_ENV[$line[0]] = $line[1];
                }
                //$this->host = trim($_ENV['SERVER']);
                $this->db_name = trim($_ENV['DB_NAME']);
                $this->username = trim($_ENV['DB_USER']);
                $this->password = trim($_ENV['DB_PASS']);
            }
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die('Connection failed: ' . $this->conn->connect_error);
            }
        }

        public function initializeAssignedTasks($empId) {
            $sql = "SELECT * FROM Tasks WHERE user_id = '$empId' AND status != 'COPMLETE'";
            $result = $this->conn->query($sql);
            $this->assignedTasks = $result->num_rows;

            // get the pending tasks from the result
            $result = $this->conn->query("SELECT * FROM Tasks WHERE user_id = '$empId' AND status = 'NOT STARTED'");
            $this->pendingTasks = $result->num_rows;

            // get the completed tasks from the result
            $result = $this->conn->query("SELECT * FROM Tasks WHERE user_id = '$empId' AND status = 'COMPLETE'");
            $this->completedTasks = $result->num_rows;

            // get the in progress tasks from the result
            $result = $this->conn->query("SELECT * FROM Tasks WHERE user_id = '$empId' AND status = 'IN-PROGRESS'");
            $this->inprogressTasks = $result->num_rows;
        }

        public function createTask(){

            $_POST = json_decode(file_get_contents('php://input'), true);

            $user_id = $_POST['empId'];
            $task_name = $_POST['task_name'];
            $deadline = $_POST['deadline'];
            $priority = $_POST['priority'];
            $status = "NOT STARTED";
            error_log('------------create task-------------');
            error_log($user_id);
            error_log($task_name);
            error_log($deadline);
            error_log($priority);
            
            $sql = "INSERT INTO Tasks(user_id, task_name, deadline, priority, status) VALUES ('$user_id', '$task_name', '$deadline', '$priority', '$status')";
            if ($this->conn->query($sql) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        
        public function getFullName($empId) {
            $sql = "SELECT * FROM UserInformation WHERE userInfo_id = '$empId'";
            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();
            $this->fullname = $row['fname'] . ' ' . $row['lname'];
            return $this->fullname;
        }

        public function getTasksBasedOnDate($date) {
            // get the tasks < the date base on the user id
            $empId = $_SESSION['empId'];
            $sql = "SELECT * FROM Tasks WHERE user_id = '$empId' AND deadline < '$date' AND status != 'COMPLETE'";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function getTasksByLimit($limit) {
            $empId = $_SESSION['empId'];
            $sql = "SELECT * FROM Tasks WHERE user_id = '$empId' AND status != 'COMPLETE' LIMIT $limit";
            $result = $this->conn->query($sql);
            return $result;
        }
        
        public function getTasksByLimitAdmin($limit) {
            $sql = "SELECT * FROM Tasks INNER JOIN UserInformation WHERE status != 'COMPLETE' AND Tasks.user_id = UserInformation.userInfo_id LIMIT ".$limit;
            $result = $this->conn->query($sql);
            return $result;
        }

        public function getTasksByLimitAdminUser(){
            $POST = json_decode(file_get_contents('php://input'), true);
            
            $empId = $POST['empId'];
            $limit = $POST['limit'];
            $sql = "SELECT * FROM UserInformation INNER JOIN Tasks WHERE status != 'COMPLETE' AND Tasks.user_id = UserInformation.userInfo_id AND Tasks.user_id = '$empId' LIMIT ".$limit;
            $result = $this->conn->query($sql);
            $resultArray = [];
            while($row = $result->fetch_assoc()) {
                array_push($resultArray, $row);
            }
            $result = json_encode($resultArray);
            echo $result;
            return $result;
        }

        public function getAssignedTasks() {
            return $this->assignedTasks;
        }

        public function getCompletedTasks() {
            return $this->completedTasks;
        }

        public function getPendingTasks() {
            return $this->pendingTasks;
        }

        public function getInProgressTasks() {
            return $this->inprogressTasks;
        }

        public function getITTasks() {
            $sql = "SELECT * FROM UserInformation INNER JOIN Tasks ON UserInformation.userInfo_id = Tasks.user_id WHERE department = 'IT'";
            $result = $this->conn->query($sql);
            $this->ITTasks = $result->num_rows;
            return $this->ITTasks;
        }

        public function getTransportTasks() {
            $sql = "SELECT * FROM UserInformation INNER JOIN Tasks ON UserInformation.userInfo_id = Tasks.user_id WHERE department = 'TRANSPORT'";
            $result = $this->conn->query($sql);
            $this->TransportTasks = $result->num_rows;
            return $this->TransportTasks;
        }

        public function getCyberSecurityTasks() {
            $sql = "SELECT * FROM UserInformation INNER JOIN Tasks ON UserInformation.userInfo_id = Tasks.user_id WHERE department = 'CYBERSECURITY'";
            $result = $this->conn->query($sql);
            $this->CyberSecurityTasks = $result->num_rows;
            return $this->CyberSecurityTasks;
        }
        
        public function getDepartmentUsers(){
            $department = $_SESSION['department'];
            $sql = "SELECT * FROM UserInformation INNER JOIN Users where Department = '$department' and Users.user_id = UserInformation.userInfo_id";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function getAllEmployees(){
            $sql = "SELECT * FROM UserInformation INNER JOIN Users where Users.user_id = UserInformation.userInfo_id and Users.role = 'employee'";
            $result = $this->conn->query($sql);
            return $result;
        }
        
        public function getAllUserInformation(){
            $id = $_SESSION['empId'];
            $sql = "SELECT * FROM UserInformation INNER JOIN Users where Users.user_id = UserInformation.userInfo_id and Users.user_id = '$id'";
            $result = $this->conn->query($sql);
            return $result;
        }
        public function getAllUserSpecificInformation($id){
            $sql = "SELECT * FROM UserInformation INNER JOIN Users where Users.user_id = UserInformation.userInfo_id and Users.user_id = '$id'";
            $result = $this->conn->query($sql);
            // encode the result to json
            header('Content-Type: application/json');
            $result = json_encode($result->fetch_assoc());
            error_log($result);

            echo $result;
            return $result;
        }

        public function processLogout(){
            session_unset();
            session_destroy();
            header('Location: /auth/login.php');
            exit;
        }

        public function processRegister(){
            $conn = $this->conn;

            // get all the values from the form
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_SESSION['role'];
            $department = $_POST['department'];
            $position = $_POST['role'];
            
            // all caps the position
            $position = strtoupper($position);
            
            // query to insert the user into the database
            $sql = "INSERT INTO Users(email,password,role) VALUES ('$email', '$password', '$role')";
            if ($conn->query($sql) === TRUE) {
                // query to insert the userinfo into the database
                $sql = "INSERT INTO UserInformation(fname, lname, phone_number, department) VALUES ('$fname', '$lname','00000', '$department')";
                if ($conn->query($sql) === TRUE) {
                    header('Location: /auth/login.php');
                    exit;
                } else {
                    echo 'Error: ' . $sql . '<br>' . $conn->error;
                }
            } else {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }
        }

        public function addEmployee(){
            $conn = $this->conn;

            $_POST = json_decode(file_get_contents('php://input'), true);

            // get all the values from the form
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = "@PLDT123";
            $role = "employee";
            $department = $_POST['department'];
            $position = $_POST['position'];
            
            // all caps the position
            $position = strtoupper($position);
            $department = strtoupper($department);
            
            // query to insert the user into the database
            $sql = "INSERT INTO Users(email,password,role) VALUES ('$email', '$password', '$role')";
            if ($conn->query($sql) === TRUE) {
                $name = $_SESSION['name'];
                $id = $_SESSION['empId'];

                // query to insert the userinfo into the database
                $sql = "INSERT INTO UserInformation(fname, lname, phone_number, Department, Position, administrator, administrator_name) VALUES ('$fname', '$lname','00000', '$department', '$position', '$id', '$name')";
                if ($conn->query($sql) === TRUE) {
                    header('Location: /auth/login.php');
                    exit;
                } else {
                    echo 'Error: ' . $sql . '<br>' . $conn->error;
                }
            } else {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }
           
        }
        public function updateEmployee(){
            $conn = $this->conn;

            $_POST = json_decode(file_get_contents('php://input'), true);

            // get all the values from the form
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $department = $_POST['department'];
            $position = $_POST['position'];
            $id = $_POST['employee_id'];
            error_log("------------HEREEE----------");
            error_log($id);
            
            // all caps the position
            $position = strtoupper($position);
            $department = strtoupper($department);
            
            // query to insert the userinfo into the database
            $sql = "UPDATE UserInformation SET fname = '$fname', lname = '$lname', Department = '$department', Position = '$position' WHERE userInfo_id = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        
        public function deleteEmployee(){
            $conn = $this->conn;

            $_POST = json_decode(file_get_contents('php://input'), true);

            // get all the values from the form
            $id = $_POST['employee_id'];
            
            // query to insert the userinfo into the database
            $sql = "DELETE FROM UserInformation WHERE userInfo_id = '$id'";
            if ($conn->query($sql) === TRUE) {
                $sql = "DELETE FROM Users WHERE user_id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
        }

        public function updateTaskStatus($task, $status) {
            $empId = $_SESSION['empId'];
            $conn = $this->conn;
            $sql = "UPDATE Tasks SET status = '$status' WHERE task_name= '$task' AND user_id = '$empId'";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }

        public function updateTask(){
            $conn = $this->conn;

            $_POST = json_decode(file_get_contents('php://input'), true);

            // get all the values from the form
            $task_name = $_POST['task_name'];
            $priority = $_POST['priority'];
            $id = $_POST['task_id'];

            error_log('update task');
            error_log($id);
            error_log($task_name);
            error_log($priority);
            
            // query to insert the userinfo into the database
            $sql = "UPDATE Tasks SET task_name = '$task_name', priority = '$priority' WHERE task_id = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        
        public function deleteTask(){
            $conn = $this->conn;

            $_POST = json_decode(file_get_contents('php://input'), true);

            // get all the values from the form
            $id = $_POST['task_id'];
            
            // query to insert the userinfo into the database
            $sql = "DELETE FROM Tasks WHERE task_id = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }


        public function processLogin(){
            $conn = $this->conn;

            // get email and password from the form
            $email = $_POST['email'];
            $password = $_POST['password'];

            // query to check if the user exists
            $sql = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['empId'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['authenticated'] = true;
                $this->initializeAssignedTasks($row['user_id']);

                // Get the user information
                $id = $row['user_id'];
                $sql = "SELECT * FROM UserInformation WHERE userInfo_id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];
                $_SESSION['department'] = $row['Department'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['phone'] = $row['phone_number'];

                //error_log($_POST['email']);
                //error_log($_POST['password']);
                //error_log($_SESSION['empId']);
                //error_log($_SESSION['role']);
                //error_log($_SESSION['name']);
                //error_log($_SESSION['department']);
                //error_log($_SESSION['position']);
                //error_log($_SESSION['phone']);
                //error_log($_SESSION['authenticated']);

                if($_SESSION['role'] == 'admin'){
                    error_log('admin');
                    header('Location: /admin/adminDashboard.php');
                } else {
                    error_log('employee');
                    header('Location: /employee/empDashboard.php');
                }
            } else {
                $_SESSION['authenticated'] = false;
                header('Location: /auth/login.php');
            }

        }
    }

    $authType = "";
    if(isset($_GET['authType'])){
        $authType = $_GET['authType'];
        error_log("My AuthType:".$authType);
    }

    if($authType == 'register'){
        Database::getInstance()->processRegister();
    } else if($authType == 'login'){
        Database::getInstance()->processLogin();
    } else if($authType == 'logout'){
        Database::getInstance()->processLogout();
    }else if($authType == '1'){
        Database::getInstance()->initializeAssignedTasks($_SESSION['empId']);
    }elseif($authType == '2'){
        $tasks = Database::getInstance()->getTasksBasedOnDate(date('Y-m-d', strtotime('+7 days')));
        if($tasks > 0) {
            while($row = $tasks->fetch_assoc()) {
                echo '<div class="deadline-card">';
                echo '<div class="content">';
                echo '<p>'.$row['task_name'].'</p>';
                echo '<p>'.$row['deadline'].'</p>';
                echo '</div>';
                echo '</div>';
            }
        }

    }elseif($authType == '3'){  
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        Database::getInstance()->addEmployee();
    }elseif($authType == '4'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        Database::getInstance()->updateEmployee();
    }elseif($authType == '5'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        Database::getInstance()->deleteEmployee();
    }elseif($authType == '6'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        return Database::getInstance()->getAllUserSpecificInformation($_GET['id']);
    }elseif($authType == '7'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        return Database::getInstance()->updateTask();
    }elseif($authType == '8'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        return Database::getInstance()->deleteTask();
    }elseif($authType == '9'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        return Database::getInstance()->createTask();
    }elseif($authType == '10'){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /auth/login.php');
            exit;
        }
        return Database::getInstance()->getTasksByLimitAdminUser();
    }
else{
        error_log('No auth type');
}
?>

