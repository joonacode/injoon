<?php
date_default_timezone_set('ASIA/JAKARTA');
$conn = mysqli_connect('localhost', 'root', '', 'db_injoon');

if (mysqli_connect_errno()) {
    echo "RUSSSAAAKK " . mysqli_connect_error();
}

function rupiah($str)
{
    return number_format($str, 0, ",", ".");
}
