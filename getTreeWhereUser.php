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
    $userID = $_GET['userID'];
    $result = mysqli_query($link, " SELECT 
                                        treedata.id,treedata.nameTree,lat,lng,IF(name is null,treedata.nameTree,name)name,
                                        urlImage,IF(color is null,'240.0',color) as coloricon,IF(treedata.height ='',database.nature,treedata.height)height
                                    FROM treedata 
                                        left outer join `database` on treedata.idTree=database.id 
                                    where idRec=$userID");
    if ($result) {
        while($row=mysqli_fetch_assoc($result)){
        $output[]=$row;
        }	// while
        echo json_encode($output);
    }	
}
	mysqli_close($link);
?>