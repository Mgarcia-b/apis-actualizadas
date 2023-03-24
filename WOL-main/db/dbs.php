<?php

// Create connection
$db = new mysqli("122.8.178.249", "automatizacion", "Aut0m4_u23", "DBCLARO", 3306);
if ($db->connect_error) {
    die('Error de Conexión (' . $db->connect_errno . ') '
            . $db->connect_error);
}
// $db = new mysqli("10.10.2.51", "sistemas", "#Tum@dre!", "medios", 3306);
// if ($db->connect_error) {
//     die('Error de Conexión (' . $db->connect_errno . ') '
//             . $db->connect_error);
// }

$servername = "122.8.178.249";
$database = "DBCLARO";
$username = "automatizacion";
$password = "Aut0m4_u23";

?>
