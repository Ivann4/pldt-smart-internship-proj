<?php 
    require_once(__DIR__.'/../auth/auth.php');
?>

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
<aside class="right-sidebar">
    <section class="summary">
        <h2>Tasks</h2>
        <div class="stats">
            <div class="stat">
                <h3>Assigned Tasks</h3>
                <p><?php echo $db->getAssignedTasks(); ?></p>
            </div>
            <div class="stat">
                <h3>Pending Tasks</h3>
                <p><?php echo $db->getPendingTasks(); ?></p>
            </div>
            <div class="stat">
                <h3>Tasks In Progress</h3>
                <p><?php echo $db->getInProgressTasks(); ?></p>
            </div>
            <div class="stat">
                <h3>Tasks Finished</h3>
                <p><?php echo $db->getCompletedTasks(); ?></p>
            </div>
        </div>
    </section>
    <section class="activities">
        <h2>Task Activities</h2>
        <p>lagay ng chart here (any chart u want :>)</p>
    </section>
</aside>
