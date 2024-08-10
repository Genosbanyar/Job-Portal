<?php 

require "config/QueryBuilder.php";
if(isset($_GET['id'])){
    $cate_id = $_GET['id'];
    $db->deleteQuery("DELETE FROM jobs WHERE id='$cate_id'");
    $_SESSION['success_cate'] = "Deleted job successfully!";
    header("Location: admin_jobs");
}else{
    abort(404);
}
?>