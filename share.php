<?php
    include './inc/db_connect.php';
    include './inc/request_sql.php';
    include './inc/header.php';

    $purchase_id_result = pg_query(connect_DB('action'), getCount('action'));
    $purchase_id_row = pg_fetch_assoc($purchase_id_result);
    $purchase_id = htmlspecialchars($purchase_id_row['purchase_id']);

    if(isset($_GET['unik_id']) and $_GET['unik_id']>=1 and $_GET['unik_id']<$purchase_id){
        $result = pg_query(connect_DB('action'), getTransaction($_GET['unik_id']));
    }
    else{
        header('Location: ./list_share.php');
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <?php echo getHeader();?>


    <?php
    if (pg_num_rows($result) > 0) {
        echo '<h2>Liste des Transaction pour : '.$_GET['name'].'</h2>';
        echo "<table><tr><th>UNIK</th><th>ID</th><th>Nom</th><th>Devise</th><th>Transaction ID</th><th>Date d'Achat</th><th>Prix par Action</th><th>Nombre</th><th>Total Devise HT</th><th>Frais d'Achat</th><th>Total Devise TTC</th><th>change</th><th>Total CHF</th><th>Actions</th></tr>";
        while($row = pg_fetch_assoc($result)) {
            
            $purchase=false;
            if(htmlspecialchars($row["type"])==='purchase'){
                $purchase=true;}

                
            if($purchase){echo '<tr class="purchase">';}
            else{echo '<tr class="sell">';}

            if($purchase){echo '<td>+</td>';}
            else{echo '<td>-</td>';}
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["currency"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["transaction_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["transaction_date"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["share_price"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["share_number"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["ht"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["transaction_fees"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["ttc"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["transaction_change"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["chf"]) . "</td>";
            echo "<td><a href='edit_record.php?id=" . htmlspecialchars($row["transaction_id"]) . "'>✏️</a> | <a href='delete_record.php?id=" . htmlspecialchars($row["transaction_id"]) . "'>🚮</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }
    ?>

</body>