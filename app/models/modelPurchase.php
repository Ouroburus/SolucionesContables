<?php
class Purchase
{
    public $issue_number;
    public $nit_or_dui;
    public $nrc;
    public $exempt_purchases;
    public $taxable_purchases_domestic;
    public $taxable_purchases_import;
    public $tax_credit;
    public $withheld_vat;
    public $total_purchases;
    public $excluded_subjects;

    public function __construct($issue_number, $nit_or_dui, $nrc, $exempt_purchases, $taxable_purchases_domestic, $taxable_purchases_import, $tax_credit, $withheld_vat, $total_purchases, $excluded_subjects)
    {
        $this->issue_number = $issue_number;
        $this->nit_or_dui = $nit_or_dui;
        $this->nrc = $nrc;
        $this->exempt_purchases = $exempt_purchases;
        $this->taxable_purchases_domestic = $taxable_purchases_domestic;
        $this->taxable_purchases_import = $taxable_purchases_import;
        $this->tax_credit = $tax_credit;
        $this->withheld_vat = $withheld_vat;
        $this->total_purchases = $total_purchases;
        $this->excluded_subjects = $excluded_subjects;
    }

    public function savePurchase($collection)
    {
        $document = [
            'issue_number' => $this->issue_number,
            'nit_or_dui' => $this->nit_or_dui,
            'nrc' => $this->nrc,
            'exempt_purchases' => $this->exempt_purchases,
            'taxable_purchases_domestic' => $this->taxable_purchases_domestic,
            'taxable_purchases_import' => $this->taxable_purchases_import,
            'tax_credit' => $this->tax_credit,
            'withheld_vat' => $this->withheld_vat,
            'total_purchases' => $this->total_purchases,
            'excluded_subjects' => $this->excluded_subjects
        ];

        $result = $collection->insertOne($document);

        if ($result->getInsertedCount() == 1) {
            echo "Purchase successfully registered. ID: " . $result->getInsertedId();
        } else {
            echo "Error registering the purchase.";
        }
    }
}
?>
