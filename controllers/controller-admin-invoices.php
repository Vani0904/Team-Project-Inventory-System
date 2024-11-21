<?php
require_once '../models/model-admin-invoices.php';

class AdminInvoicesController 
{
    public static function process() 
    {
        global $distinct_users;
        $distinct_users = AdminInvoices::getDistinctUsers();

        global $invoices;

        require_once '../views/view-admin-invoices.php';
    }

    public static function show_all_invoices() 
    {
        global $invoices;
        $invoices = AdminInvoices::getAllInvoices();
    }

    public static function show_invoices_by_date() 
    {
        global $invoices;
        $invoices = AdminInvoices::getInvoicesByDate();
    }

    public static function show_invoices_by_id() 
    {
        global $invoices;
        $invoices = AdminInvoices::getInvoicesByUserID();
    }

    public static function show_invoices_by_id_and_date() 
    {
        global $invoices;
        $invoices = AdminInvoices::getInvoicesByUserIDAndDate();
    }
}
?>