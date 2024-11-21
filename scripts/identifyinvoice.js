function loadInvoice(button) 
{
    var row = button.closest("tr");
    var invoiceId = row.querySelector('td:first-child').innerText;
    location.href="../pages/selected-invoice.php"+'?data='+invoiceId;
}