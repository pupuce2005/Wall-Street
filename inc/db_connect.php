<?php
function connect_DB($dbname)
{
    // Informations de connexion à la base de données PostgreSQL
    $host = 'localhost';
    $port = '5432';
    $user = 'action';
    $password = 'action';

    // Connexion à la base de données
    $db = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if (!$db) {
        die("Erreur de connexion à la base de données.");
    }
    return $db;
}