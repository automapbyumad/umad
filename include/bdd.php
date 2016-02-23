<?php
// Connexion base de donnée
error_reporting(E_ALL ^ E_DEPRECATED);

if (!mysql_connect("localhost", "root", "root")) {
    exit();
}

if (!mysql_select_db("test")) {
    exit();
}
?>
