<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_injoon');

if(mysqli_connect_errno()){
    echo "RUSSSAAAKK ". mysqli_connect_error();
}