<?php
date_default_timezone_set('ASIA/JAKARTA');
$conn = mysqli_connect('localhost', 'root', '', 'db_injoon');

if (mysqli_connect_errno()) {
    echo "RUSSSAAAKK " . mysqli_connect_error();
}
