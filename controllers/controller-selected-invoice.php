<?php
require_once '../models/model-selected-invoice.php';

class SelectedInvoiceController
{
    public static function processInvoice()
    {
        global $invoice_details; 
        $invoice_details = SelectedInvoice::getInvoiceDetails();
        
        require_once '../views/view-selected-invoice.php';
    }
}
?>