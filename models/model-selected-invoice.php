<?php
require_once  '../includes/database.php';

class SelectedInvoice 
{
    public static function getInvoiceDetails()
    {
        $db = Database::connect();

        $invoice_id = (int)$_GET['data'];
        
        $query = "SELECT invoice_id, invoice_description, invoice_date, total_cost,
        supplier_name, supplier_address_1, supplier_address_2, supplier_address_3, supplier_postcode,
        customer_name, customer_address_1, customer_address_2, customer_address_3, customer_postcode
        FROM invoices WHERE invoice_id = '$invoice_id'";

        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $invoice_results = [];
            while ($row = $result->fetch_assoc()) 
            {
                $invoice_results[] = $row;
            }
            return $invoice_results;
        }
        return [];
    }
}
?>