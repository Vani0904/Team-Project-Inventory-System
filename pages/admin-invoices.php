<?php
require_once '../controllers/controller-admin-invoices.php';

include '../includes/check-if-admin.php';

AdminInvoicesController::process();
?>