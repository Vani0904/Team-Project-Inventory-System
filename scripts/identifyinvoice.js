function loadInvoice(button) 
{
    var row = button.closest("tr");
    var invoiceId = row.querySelector('td:first-child').innerText;
    var customerId = row.querySelector('td:nth-child(2)').innerText;

    location.href="../pages/view-selected-invoice.php"+'?data='+invoiceId+','+customerId;
}