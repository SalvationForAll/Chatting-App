<?php

    $con = mysqli_connect('localhost','root','', 'chatbox');

    $result1 = mysqli_query($con,"SELECT * FROM message ORDER BY id");

    while($extract = mysqli_fetch_array($result1)) {
        echo "</span>: <span>" . $extract['msg'] . "</span><br />";
    }

?>