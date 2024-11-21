<?php
require_once  '../includes/database.php';

class AdminInvoices 
{
    public static function getDistinctUsers()
    {
        $db = Database::connect();
        $query = "SELECT DISTINCT user_id FROM invoices";
        $result = $db->query(query: $query);

        if ($result->num_rows > 0) 
        {
            $distinct_users = [];
            while ($row = $result->fetch_assoc()) 
            {
                $distinct_users[] = $row;
            }
            return $distinct_users;
        }
        return [];
    }

    public static function getAllInvoices() 
    {
        $db = Database::connect();
        $query = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
        users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $invoices = [];
            while ($row = $result->fetch_assoc()) 
            {
                $invoices[] = $row;
            }
            return $invoices;
        }
        return [];
    }

    public static function getInvoicesByUserID()
    {
        $filtered_user = $_SESSION['invoice-filter-selected-id'];

        $db = Database::connect();
        $query = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
        users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id WHERE invoices.user_id = $filtered_user";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $invoices = [];
            while ($row = $result->fetch_assoc()) 
            {
                $invoices[] = $row;
            }
            return $invoices;
        }
        return [];
    }

    public static function getInvoicesByDate()
    {
        $filtered_date_from = $_SESSION['invoice-filter-selected-date-from'];
        $filtered_date_to = $_SESSION['invoice-filter-selected-date-to'];

        $db = Database::connect();
        $query = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
        users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id WHERE invoice_date >= '$filtered_date_from' AND invoice_date <= '$filtered_date_to'";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $invoices = [];
            while ($row = $result->fetch_assoc()) 
            {
                $invoices[] = $row;
            }
            return $invoices;
        }
        return [];
    }

    public static function getInvoicesByUserIDAndDate()
    {
        $filtered_user = $_SESSION['invoice-filter-selected-id'];
        $filtered_date_from = $_SESSION['invoice-filter-selected-date-from'];
        $filtered_date_to = $_SESSION['invoice-filter-selected-date-to'];

        $db = Database::connect();
        $query = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
        users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id WHERE invoices.user_id = $filtered_user AND invoice_date >= '$filtered_date_from' AND invoice_date <= '$filtered_date_to'";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $invoices = [];
            while ($row = $result->fetch_assoc()) 
            {
                $invoices[] = $row;
            }
            return $invoices;
        }
        return [];
    }
}
?>