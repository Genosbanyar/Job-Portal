<?php
require "view/partials/header.php";
require "view/components/nav.php";
require "config/QueryBuilder.php";

if(isset($_SESSION['type']) && $_SESSION['type'] != 'Company'){
    header("Location: /");
}
if(isset($_GET['id'])){
    $deleteId = $_GET['id'];
    $db->deleteQuery("DELETE FROM jobs WHERE id='$deleteId'");
    header("Location: /");
}
require "view/partials/footer.php";