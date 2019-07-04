<?php

    //this file is used to insert messages into the database table
    $con = mysqli_connect('localhost','root','', 'chatbox');
    $msg = mysqli_real_escape_string($con,$_REQUEST['msg']);
    mysqli_query($con,"INSERT INTO message (msg) VALUES ('$msg')");

    $result1 = mysqli_query($con,"SELECT * FROM message ORDER BY id");

    while($extract = mysqli_fetch_array($result1)) {
        echo "</span>: <span>" . $extract['msg'] . "</span><br />";
    }

?>