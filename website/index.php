<?php

$host = "127.0.0.1";
$user = "root";
$pass = "rootpass";
$db = "mydb";

$r = mysql_connect($host, $user, $pass);

if (!$r) {
    echo "Could not connect to server \n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established";
}

$r2 = mysql_select_db($db);

if (!$r2) {
    echo "Cannot select database\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Database selected\n";
}

$query = "SELECT * FROM Cars LIMIT 5";

$rs = mysql_query($query);

if (!$rs) {
    echo "Could not execute query: $query";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Query: $query executed\n";
}

while ($row = mysql_fetch_assoc($rs)) {
    echo $row['Id'] . " " . $row['Name'] . " " . $row['Price'] . "\n";
}

mysql_close();

?>
