<?php
include './inc/db_connect.php';
include './inc/request_sql.php';
include './inc/header.php';

$result = pg_query(connect_DB('action'), getList('sell'));
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Ventes</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <?php echo getHeader();?>
    <h2>Liste des Ventes <a class="lien" href="./add_sell.php">➕</a></h2>

    <?php
if (pg_num_rows($result) > 0) {
    echo "<table><tr><th>UNIK</th><th>ID</th><th>Nom</th><th>Devise</th><th>Date d'Vente</th><th>Prix par Action</th><th>Nombre</th><th>Total Devise HT</th><th>Frais d'Vente</th><th>Total Devise TTC</th><th>change</th><th>Total CHF</th><th>Actions</th></tr>";
    while($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["sell_id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["currency"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["sell_date"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["share_price"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["share_number"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["ht"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["sell_fees"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["ttc"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["sell_change"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["chf"]) . "</td>";
        echo "<td><a href='edit_record.php?id=" . htmlspecialchars($row["sell_id"]) . "'>✏️</a> | <a href='delete_record.php?id=" . htmlspecialchars($row["sell_id"]) . "'>🚮</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 résultats";
}
?>