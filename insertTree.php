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

$idRec = $_POST['idRec'];
$idTree = $_POST['idTree'];
$color = $_POST['color'];
$nameTree = $_POST['nameTree'];
$height = $_POST['height'];
$image = $_FILES['image']['name'];
$imageName = $_POST['imageName'];
$imagePath = 'image/'.$imageName;
$tmp_name = $_FILES['image']['tmp_name'];

$lat = $_POST['lat'];
$lng = $_POST['lng'];

move_uploaded_file($tmp_name,$imagePath);

if($idTree!='0'){
    $sql1 ="SELECT * FROM `database` where id=$idTree";
    $query1 = mysqli_query($link,$sql1);
    $result1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
    $nameTree=$result1['name'];
}else{
    if($color=='Red'){
        $CodeColor='0.0';
    }else if($color=='Blue'){
        $CodeColor='240.0';
    }else if($color=='Green'){
        $CodeColor='120.0';
    }else if($color=='Yellow'){
        $CodeColor='60.0';
    }else{
        $CodeColor='300.0';
    }
    $sql2 = "INSERT INTO `database`(`name`,`nature`,`color`) 
        VALUES ('$nameTree','$height','$CodeColor')";
    $result = mysqli_query($link, $sql2);
    $idTree = $link->insert_id;
}

$sql = "INSERT INTO `treeData`(`idRec`, `idTree`, `nameTree`, `urlImage`, `lat`, `lng`, `dateTimeRec`, `height`) 
	VALUES ('$idRec','$idTree','$nameTree','$imagePath','$lat','$lng',now(),'$height')";
$result = mysqli_query($link, $sql);
if ($result) {
	echo "true";
} else {
	echo "false";
}  

mysqli_close($link);
?>