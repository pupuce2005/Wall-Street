<?php
    function getHeader(){
        $header = '<header><nav><ul>';
        $header .= '<li><a href="list_share.php">Liste des Actions</a></li>';
        $header .= '<li><a href="list_purchase.php">Liste des Achats</a></li>';
        $header .= '<li><a href="list_sell.php">Liste des Ventes</a></li>';
        $header .= '</ul></nav></header>';
        return $header;
    }

    function getFooter(){
        $footer = '';
        return $footer;
    }
?>