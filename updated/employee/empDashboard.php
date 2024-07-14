<?php
session_start();

if (!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
    header('Location: /auth/login.php');
    exit;
}
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'employee') {
    header('Location: /auth/login.php');
    exit;
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
class empDashboard {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render() {
        include '../common/head.php';
        echo '<body>';
        echo '<div class="dashboard">';
        include '../common/sidebar.php';
        include 'main.php';
        include '../common/right-sidebar.php';
        echo '</div>';
        include '../common/footer.php';
    }
}

$user = array(
    'name' => 'ivannavi_',
);

$dashboard = new empDashboard($user);
$dashboard->render();
?>

<script>
    // on-click event for submit button
    function clickButtonEvent(elem){
        var select = elem.parentElement.querySelector('select');
        var selectedValue = select.value;
        // map selectedValue to db status (Accomplished -> COMPLETE, In Progress -> IN-PROGRESS, Not Started -> NOT STARTED)
        if(selectedValue === 'Accomplished') {
            selectedValue = 'COMPLETE';
        } else if(selectedValue === 'In Progress') {
            selectedValue = 'IN-PROGRESS';
        } else if(selectedValue === 'Not Started') {
            selectedValue = 'NOT STARTED';
        }
        var taskName = elem.parentElement.parentElement.querySelector('td a');
        var task = taskName.textContent;
        var bodyValues = JSON.stringify({
            task_id: task,
            status: selectedValue
        });
        console.log(bodyValues);

        fetch('/auth/updateTaskStatus.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: bodyValues
        }).then(function(response) {
            if(response.ok) {
                alert('Task status updated successfully');
            } else {
                alert('Failed to update task status');
            }
        });
    }

</script>

