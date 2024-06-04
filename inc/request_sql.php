<?php 
    function getCount($table){
        switch ($table) {
            case 'action':
                return "SELECT count(purchase_id) + 1 as purchase_id FROM purchase";
                break;
            case 'purchase':
                return "SELECT count(purchase_id) + 1 as purchase_id FROM purchase";
                break;
            case 'sell':
                return "SELECT count(purchase_id) + 1 as purchase_id FROM purchase";
                break;
        }
    }

    function getList($table){
        switch ($table) {
            case 'action':
                return "SELECT * from action";
                break;
            case 'purchase':
                return "SELECT * from purchase inner join action on id = action_id";
                break;
            case 'sell':
                return "SELECT * from sell inner join action on id = action_id";
                break;
        }
    }
    
?>