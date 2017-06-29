<?php
/*
 * This is to connect to my database.
 */
$mysqli = new mysqli('localhost','root','haha','exposight');
if(mysqli_errno()){
    printf("Connect failed: %s\n", mysqli_error());
    exit();
}
