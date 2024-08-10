<?php 
require "config/QueryBuilder.php";
if(isset($_GET['id']) && isset($_GET['status'])){
    $job_id = $_GET['id'];
    if($_GET['status'] == 1){
        $db->updateStatus("UPDATE jobs SET status=0 WHERE id='$job_id'");
    }else{
        $db->updateStatus("UPDATE jobs SET status=1 WHERE id='$job_id'");
    }
    
    $_SESSION['success_cate'] = "Deleted category successfully!";
    header("Location: admin_jobs");
}else{
    abort(404);
}
?>