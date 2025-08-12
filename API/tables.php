<?php
    header('Content-Type: application/json');
    include '../db.php';
    $res = mysqli_query($conn, "SELECT * FROM tables");
    $data = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = (object)$row; 
        }
        $output = new stdClass();
        $output->total = mysqli_num_rows($res);
        $output->data = $data;
        echo json_encode($output);
    }else{
        echo json_encode(["message" => "0 data found"]);
    }
?>