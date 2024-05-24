<?php
$serverName = "100.87.4.62"; //serverName\instanceName
$connectionInfo = array("Database" => "tes", "UID" => "sa", "PWD" => "Dev12345.");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "koneksi sukses";
} else {
    echo "Connection could not be established.<br />";
    die(print_r(sqlsrv_errors(), true));
}