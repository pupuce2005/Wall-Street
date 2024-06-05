<?php
include './inc/db_connect.php';
include './inc/request_sql.php';
include './inc/header.php';

$result = pg_query(connect_DB('action'), getList('action'));
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
    <h2>Liste des Actions <a class="lien" href="./add_share.php">➕</a></h2>

    <?php
    if (pg_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>UNIK ID</th><th>ID</th><th>Nom</th><th>Nombre</th><th>Devise</th><th>Actions</th></tr>";
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["unik_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["action_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["share_number"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["currency"]) . "</td>";
            echo "<td><a href='share.php?unik_id=" . htmlspecialchars($row["unik_id"]) . "'>🔍</a> | <a href='edit_record.php?unik_id=" . htmlspecialchars($row["unik_id"]) . "'>✏️</a> | <a href='delete_record.php?unik_id=" . htmlspecialchars($row["unik_id"]) . "'>🚮</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>0 résultats</p>";
    }
    ?>

</body>