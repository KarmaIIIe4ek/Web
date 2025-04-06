<?php
require_once '../includes/db_functions.php';

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    deleteProject($project_id);
}

header('Location: projects.php');
exit;
?>