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
                return "SELECT unik_id, name, currency,  action_id, sum(share_number) as share_number FROM (
                            SELECT action.*, action_id, share_number from purchase inner join action on id = action_id
                            UNION ALL
                            SELECT action.*, action_id, -share_number from sell inner join action on id = action_id
                        )vue
                        group by unik_id, name, currency, action_id
                        order by unik_id";
                break;
            case 'purchase':
                return "SELECT * from purchase inner join action on id = action_id";
                break;
            case 'sell':
                return "SELECT * from sell inner join action on id = action_id";
                break;
        }
    }

    function getTransaction($id){
        return "select type, unik_id, id, name, currency, purchase_id as transaction_id, purchase_date as transaction_date, share_price, share_number, ht, purchase_fees as transaction_fees, ttc, purchase_change as transaction_change, chf from (
            select 'Achat' as type, * from action inner join purchase on action.id = purchase.action_id UNION ALL select 'Vente' as type, * from action inner join sell on action.id = sell.action_id )vue where unik_id = $id";
    }
    
?>