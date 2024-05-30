<?php
include 'db_connect.php';

$db = connect_DB('action');

$query = "select * from purchase inner join action on id = action_id";
$result = pg_query($db, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <h2>Liste des Achats</h2>

    <?php
if (pg_num_rows($result) > 0) {
    echo "<table><tr><th>UNIK</th><th>ID</th><th>Nom</th><th>Devise</th><th>Date d'Achat</th><th>Prix par Action</th><th>Nombre</th><th>Total Devise HT</th><th>Frais d'Achat</th><th>Total Devise TTC</th><th>change</th><th>Total CHF</th><th>Actions</th></tr>";
    while($row = pg_fetch_assoc($result)) {
        echo "<tr><td>".$row["purchase_id"]."</td><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["currency"]."</td><td>".$row["purchase_date"]."</td><td>".$row["share_price"]."</td><td>".$row["share_number"]."</td><td>".$row["ht"]."</td><td>".$row["purchase_fees"]."</td><td>".$row["ttc"]."</td><td>".$row["change"]."</td><td>".$row["chf"]."</td><td><a href='edit_record.php?id=".$row["id"]."'>✏️</a> | <a href='delete_record.php?id=".$row["id"]."'>🚮</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 résultats";
}
pg_close($db);
?>