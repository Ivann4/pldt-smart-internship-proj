<?php
    session_start();
    if (!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        header('Location: /auth/login.php');
        exit;
    }
    require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
    $db = Database::getInstance();
    $db->initializeAssignedTasks($_SESSION['empId']);
?>
<main class="main">
    <div id="dynamic-content">
        <div class="container">
            <h2><b>Dashboard</b></h2>
            <div class="task-pool">
                <div class="task-card">
                    <h3>IT Tasks</h3>
                    <?php echo $db->getITTasks();?>
                </div>
                <div class="task-card">
                    <h3>Transport Tasks</h3>
                    <?php echo $db->getTransportTasks();?>
                </div>
                <div class="task-card">
                    <h3>Cybersecurity Tasks</h3>
                    <?php echo $db->getCyberSecurityTasks();?>
                </div>
            </div>
            <div class="deadlines-header">
                <h2><b>My Deadlines</b></h2>
            </div>
            <div class="deadlines">
            <script>
                
                function fetchTasks(){
                    fetch('/auth/auth.php?authType=2').then(response => response.text()).then(data => {
                        document.querySelector('.deadlines').innerHTML = data;
                    });
                }
                fetchTasks();
            </script>
            </div>
        </div>
    </div>
</main>
