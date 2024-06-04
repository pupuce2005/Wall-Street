<?php
include './inc/db_connect.php';
include './inc/request_sql.php';
include './inc/header.php';

$result_ID = pg_query(connect_DB('action'), "SELECT id FROM action");
$purchase_id_result = pg_query(connect_DB('action'), getCount('action'));
$purchase_id_row = pg_fetch_assoc($purchase_id_result);
$purchase_id = htmlspecialchars($purchase_id_row['purchase_id']);


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['share_price']>0) {
    $db_insert = connect_DB('action');

    $action_id = $_POST['action_id'];
    $purchase_date = $_POST['purchase_date'];
    $share_price = $_POST['share_price'];
    $share_number = $_POST['share_number'];
    $ht = $share_price * $share_number;
    $purchase_fees = $_POST['purchase_fees'];
    $ttc = $ht+$purchase_fees;
    $purchase_change = $_POST['purchase_change'];
    $chf = $ttc*$purchase_change;

    $query = "INSERT INTO purchase (purchase_id, action_id, purchase_date, share_price, share_number, ht, purchase_fees, ttc, purchase_change, chf)
              VALUES ($purchase_id, '$action_id', '$purchase_date', $share_price, $share_number, $ht, $purchase_fees, $ttc, $purchase_change, $chf)";

    $result = pg_query($db_insert, $query);

    if ($result) {
        echo "Nouvel enregistrement créé avec succès";
        $_POST['$action_id']=null;
        $_POST['purchase_date']=null;
        $_POST['share_price']=0;
        $_POST['share_number']=0;
        $_POST['purchase_fees']=0;
        $_POST['purchase_change']=0;
        header('Location: ./list_purchase.php');
    } else {
        echo "Erreur: " . pg_last_error($db_insert);
    }

    pg_close($db_insert);
}
$_POST=null;
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Achat d'Actions</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<html>

<body>
    <?php echo getHeader();?>

    <h2>Ajouter un Nouvel Enregistrement</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table>
            <tr>
                <td>ID</td>
                <td><select name='action_id'>
                        <?php
                while ($row_ID = pg_fetch_assoc($result_ID)) { echo "<option value='" . htmlspecialchars($row_ID['id']) . "'>" . htmlspecialchars($row_ID['id']) . "</option>"; }?>
                    </select></td>
            </tr>
            <tr>
                <td>Date d'achat: </td>
                <td><input type="date" name="purchase_date"
                        <?php if(isset($_POST['purchase_date'])){echo 'value="'.$_POST['purchase_date'].'"';}?>></td>
            </tr>
            <tr>
                <td>Prix par action: </td>
                <td><input type="number" step="0.0001" name="share_price"
                        <?php if(isset($_POST['share_price'])){echo 'value="'.$_POST['share_price'].'"';}?>></td>
            </tr>
            <tr>
                <td>Nombre d'action: </td>
                <td><input type="number" step="0.001" name="share_number"
                        <?php if(isset($_POST['share_number'])){echo 'value="'.$_POST['share_number'].'"';}?>>
                </td>
            </tr>
            <tr>
                <td>Frais d'achat: </td>
                <td><input type="number" step="0.01" name="purchase_fees"
                        <?php if(isset($_POST['purchase_fees'])){echo 'value="'.$_POST['purchase_fees'].'"';}?>></td>
            </tr>
            <tr>
                <td>Change: </td>
                <td><input type="number" step="0.000001" name="purchase_change"
                        <?php if(isset($_POST['purchase_change'])){echo 'value="'.$_POST['purchase_change'].'"';}?>>
                </td>
            </tr>


        </table>
        <input type="submit">
    </form>

</body>

</html>