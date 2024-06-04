<?php
include './inc/db_connect.php';
include './inc/request_sql.php';
include './inc/header.php';

$db = connect_DB('action');

$query = getList('purchase');
$result = pg_query($db, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Achats</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <?php echo getHeader();?>
    <h2>Liste des Achats <a class="lien" href="./add_purchase.php">➕</a></h2>

    <?php
if (pg_num_rows($result) > 0) {
    echo "<table><tr><th>UNIK</th><th>ID</th><th>Nom</th><th>Devise</th><th>Date d'Achat</th><th>Prix par Action</th><th>Nombre</th><th>Total Devise HT</th><th>Frais d'Achat</th><th>Total Devise TTC</th><th>change</th><th>Total CHF</th><th>Actions</th></tr>";
    while($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["purchase_id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["currency"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["purchase_date"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["share_price"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["share_number"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["ht"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["purchase_fees"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["ttc"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["purchase_change"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["chf"]) . "</td>";
        echo "<td><a href='edit_record.php?id=" . htmlspecialchars($row["purchase_id"]) . "'>✏️</a> | <a href='delete_record.php?id=" . htmlspecialchars($row["purchase_id"]) . "'>🚮</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 résultats";
}
pg_close($db);
?>