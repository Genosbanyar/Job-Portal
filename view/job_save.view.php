<?php 
require "view/partials/header.php";
require "view/components/nav.php";
require "config/QueryBuilder.php";
?>

<?php
if(isset($_GET['job_id']) && isset($_GET['employee_id']) && isset($_GET['status'])){
    $job_id = $_GET['job_id'];
    $employee_id = $_GET['employee_id'];
    $status = $_GET['status'];
    if($status == "save"){
        $db->insertSave([$job_id,$employee_id]);
        header("Location: job_single?job_id=$job_id");
    }else{
        $db->deleteQuery("DELETE FROM saved_jobs WHERE job_id='$job_id' AND employee_id='$employee_id'");
        header("Location: job_single?job_id=$job_id");
    } 
}
?>

<?php require "view/partials/footer.php";?>