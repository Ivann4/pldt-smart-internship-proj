<?php
class empDashboard {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render() {
        include 'head.php';
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