<?php 

    var_dump($_SESSION);
    if(isset($_SESSION['empId'])){
        header('Location: /employee/empDashboard.php');
    }
    elseif (isset($_SESSION['adminId'])) {
        header('Location: /admin/adminDashboard.php');
    }
    else{
        header('Location: /auth/login.php');
    }

?>
