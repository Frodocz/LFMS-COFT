<?php
    $pageNumber = $invoice->setSourceFile("support/invoice_template.pdf");
    $template = $invoice->importPage(1,'/Template');


    $invoice->Output('invoices/invoice_'.$invoice_id.'@'.date("Y-M-d").'.pdf', 'F');
?>