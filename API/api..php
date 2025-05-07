<?php 
    header("Content-Type: application/json");
    $data=[
        ["id" => 1,"name" => "Messi","gender" => "Male"],
        ["id" => 2,"name" => "Ronaldo","gender" => "Male"],
    ];
    if(isset($_GET['id'])){ //get  data by  id
        $id  = intval($_GET['id']);
        foreach($data as $row){
            if($row['id'] == $id){
                echo json_encode($row,JSON_PRETTY_PRINT);
                exit;
            }
        }
        echo json_encode(['message' => "data not  found"]);
    }else{  //get  all data
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
?>