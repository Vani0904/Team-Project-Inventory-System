<?php
require_once '../models/model-admin-analytics.php';

$branch_id = 1;
$branch_text = "Sheffield";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $branch_id = $_GET['branch'] ?? 1;

    switch($branch_id)
    {
        case 1:
            $branch_text = "Sheffield";
            break;
        case 2:
            $branch_text = "Leeds";
                break;
        case 3:
            $branch_text = "Manchester";
                break;
        case 4:
            $branch_text = "Nottingham";
                break;
    }
}

class AdminAnalyticsController
{
    public static function process()
    {
        global $branch_id;

        global $inventory_items_all;
        $inventory_items_all = AdminAnalytics::get_all_inventory_items_including_product_names();
        
        global $inventory_items_branch;
        $inventory_items_branch = AdminAnalytics::get_all_inventory_items_by_branch($branch_id);

        global $inventory_items_all_json;
        $inventory_items_all_json = json_encode(value: $inventory_items_all);

        global $inventory_items_branch_json;
        $inventory_items_branch_json = json_encode(value: $inventory_items_branch);

        require_once '../views/view-admin-analytics.php';
    }
}
?>