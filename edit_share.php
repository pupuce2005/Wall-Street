<?php 
    include './inc/db_connect.php';
    include './inc/request_sql.php';
    include './inc/header.php';

    $share_id_result = pg_query(connect_DB('action'), getCount('action'));
    $share_id_row = pg_fetch_assoc($share_id_result);
    $share_id = htmlspecialchars($share_id_row['unik_id']);

    if(isset($_GET['unik_id']) and $_GET['unik_id']>=1 and $_GET['unik_id']<$share_id){
        $result = pg_query(connect_DB('action'), getdetail('action',$_GET['unik_id']));
    }
    elseif($_POST['unik_id'] and $_POST['unik_id']>=1 and $_POST['unik_id']<$share_id){
        $unik=$_POST['unik_id'];
        $id=$_POST['id'];
        $name=$_POST['name'];
        $currency=$_POST['currency'];
        
        $query="UPDATE action SET id = '$id', name ='$name', currency = '$currency' WHERE unik_id = $unik";
        var_dump($query);
        if(pg_query(connect_DB('action'), $query)){
            echo "Succès";
            $_POST['id']=null;
            $_POST['name']=null;
            $_POST['currency']=null;
            header('Location: ./list_share.php');
        }
        else{echo 'Erreur';}
    }
    else{
        header('Location: ./list_share.php');
        echo 'Retour';
    }    
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Application</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <?php echo getHeader();
    while ($row = pg_fetch_assoc($result)) {
    ?>

    <h2>Ajouter un Nouvel Enregistrement</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table>
            <tr>
                <td>ID </td>
                <td><input readonly type="number" name="unik_id"
                        <?php echo 'value="'.htmlspecialchars($row["unik_id"]).'"'?>>
                </td>
            </tr>
            <tr>
                <td>Code: </td>
                <td><input type="text" name="id" <?php echo 'value="'.htmlspecialchars($row["id"]).'"'?>>
                </td>
            </tr>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="name" <?php echo 'value="'.htmlspecialchars($row["name"]).'"'?>>
                </td>
            </tr>
            <tr>
                <td>Currency</td>
                <td>
                    <select name='currency'>
                        <option value="USD" <?php if(htmlspecialchars($row["currency"]) == 'USD'){echo 'selected';}?>>
                            USD</option>
                        <option value="CHF" <?php if(htmlspecialchars($row["currency"]) == 'CHF'){echo 'selected';}?>>
                            CHF</option>
                        <option value="EUR" <?php if(htmlspecialchars($row["currency"]) == 'EUR'){echo 'selected';}?>>
                            EUR</option>
                    </select>
                </td>
            </tr>
            <?php }?>

        </table>
        <input type="submit">
    </form>
</body>

</html>