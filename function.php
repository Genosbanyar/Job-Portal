<?php
function dd($code){
    echo "<pre>";
    var_dump($code);
    echo "</pre>";
    die();
}

function abort($errCode){
    http_response_code($errCode);
    require "$errCode.php";
}
