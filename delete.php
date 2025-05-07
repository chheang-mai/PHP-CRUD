<?php
    include('connection.php');
    $paramId = $_GET['id'];
    $sqlStr = "DELETE FROM `users` WHERE id = $paramId";
    $result = $con->query($sqlStr);
    if($result) {
        echo 'លុបចេញហើយ';
    }
?>
<a href="list-users.php">Back to lists</a>
