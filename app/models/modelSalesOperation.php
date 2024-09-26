<?php
class SalesOperation
{
    public $day;
    public $internal_correlative;
    public $preprinted_number;
    public $control_number;
    public $client_name;
    public $principal_or_agent;
    public $nrc;
    public $own_sales_exempt;
    public $own_sales_taxable;
    public $own_sales_tax_debit;
    public $third_party_sales_exempt;
    public $third_party_sales_taxable;
    public $third_party_sales_tax_debit;
    public $total;
    public $withheld_vat;

    public function __construct(
        $day, 
        $internal_correlative, 
        $preprinted_number, 
        $control_number, 
        $client_name, 
        $principal_or_agent, 
        $nrc, 
        $own_sales_exempt, 
        $own_sales_taxable, 
        $own_sales_tax_debit, 
        $third_party_sales_exempt, 
        $third_party_sales_taxable, 
        $third_party_sales_tax_debit, 
        $total, 
        $withheld_vat
    ) {
        $this->day = $day;
        $this->internal_correlative = $internal_correlative;
        $this->preprinted_number = $preprinted_number;
        $this->control_number = $control_number;
        $this->client_name = $client_name;
        $this->principal_or_agent = $principal_or_agent;
        $this->nrc = $nrc;
        $this->own_sales_exempt = $own_sales_exempt;
        $this->own_sales_taxable = $own_sales_taxable;
        $this->own_sales_tax_debit = $own_sales_tax_debit;
        $this->third_party_sales_exempt = $third_party_sales_exempt;
        $this->third_party_sales_taxable = $third_party_sales_taxable;
        $this->third_party_sales_tax_debit = $third_party_sales_tax_debit;
        $this->total = $total;
        $this->withheld_vat = $withheld_vat;
    }

    public function saveSalesOperation($collection)
    {
        $document = [
            'day' => $this->day,
            'internal_correlative' => $this->internal_correlative,
            'preprinted_number' => $this->preprinted_number,
            'control_number' => $this->control_number,
            'client_name' => $this->client_name,
            'principal_or_agent' => $this->principal_or_agent,
            'nrc' => $this->nrc,
            'own_sales' => [
                'exempt' => $this->own_sales_exempt,
                'taxable' => $this->own_sales_taxable,
                'tax_debit' => $this->own_sales_tax_debit,
            ],
            'third_party_sales' => [
                'exempt' => $this->third_party_sales_exempt,
                'taxable' => $this->third_party_sales_taxable,
                'tax_debit' => $this->third_party_sales_tax_debit,
            ],
            'total' => $this->total,
            'withheld_vat' => $this->withheld_vat
        ];

        $result = $collection->insertOne($document);

        if ($result->getInsertedCount() == 1) {
            echo "Sales operation successfully registered. ID: " . $result->getInsertedId();
        } else {
            echo "Error registering the sales operation.";
        }
    }
}
?>
