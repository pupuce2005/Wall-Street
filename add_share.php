<?php
include './inc/db_connect.php';
include './inc/request_sql.php';
include './inc/header.php';

$share_id_result = pg_query(connect_DB('action'), getCount('action'));
$share_id_row = pg_fetch_assoc($share_id_result);
$share_id = htmlspecialchars($share_id_row['unik_id']);


if ($_SERVER["REQUEST_METHOD"] == "POST" &&  strlen($_POST['id'])>=2 &&  strlen($_POST['name'])>=2 ) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $currency = $_POST['currency'];

    $query = "INSERT INTO action (unik_id, id, name, currency)
              VALUES ($share_id, '$id', '$name', '$currency')";

    $result = pg_query(connect_DB('action'), $query);

    if ($result) {
        echo "Nouvel enregistrement créé avec succès";
        $_POST['id']=null;
        $_POST['name']=null;
        $_POST['currency']=null;
        header('Location: ./list_share.php');
    } else {
        echo "Erreur";
    }
}
$_POST=null;
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire des actions</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<html>

<body>
    <?php echo getHeader();?>

    <h2>Ajouter un Nouvel Enregistrement</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table>
            <tr>
                <td>ID </td>
                <td><a><?php echo $share_id;?></a>
                </td>
            </tr>
            <tr>
                <td>Code: </td>
                <td><input type="text" name="id" <?php if(isset($_POST['id'])){echo 'value="'.$_POST['id'].'"';}?>>
                </td>
            </tr>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="name"
                        <?php if(isset($_POST['name'])){echo 'value="'.$_POST['name'].'"';}?>>
                </td>
            </tr>
            <tr>
                <td>Currency</td>
                <td>
                    <select name='currency'>
                        <option value="USD">USD</option>
                        <option value="CHF">CHF</option>
                        <option value="EUR">EUR</option>
                    </select>
                </td>
            </tr>


        </table>
        <input type="submit">
    </form>

</body>

</html>