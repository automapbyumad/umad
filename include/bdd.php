<?php
// Connexion base de donnée
if (!mysql_connect("localhost", "umad", "utch36fthk")) {
    exit();
}

if (!mysql_select_db("umad")) {
    exit();
}
?>
