<?php
	include 'connected.php';
	header("Access-Control-Allow-Origin: *");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;   
    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
}

if (isset($_GET)) {
	$id = $_GET['id']; 				
    $name = $_GET['name'];  
    echo $sql = "update `user` set `name`= '$name' where `id`=$id";
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo "true";
    } else {
        echo "false";
    }
}
mysqli_close($link);
?>