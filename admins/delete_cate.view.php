<?php 

require "config/QueryBuilder.php";
if(isset($_GET['id'])){
    $cate_id = $_GET['id'];
    $db->deleteQuery("DELETE FROM categories WHERE id='$cate_id'");
    $_SESSION['success_cate'] = "Deleted category successfully!";
    header("Location: categories_admin");
}else{
    abort(404);
}
?>