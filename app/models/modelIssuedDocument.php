<?php
class IssuedDocument
{
    public $day;
    public $document_number_from;
    public $document_number_to;
    public $cash_register_or_system_number;
    public $computerized;
    public $sales_exempt;
    public $sales_internal;
    public $sales_exports;
    public $daily_sales_total;
    public $sales_own;
    public $sales_third_party;

    public function __construct(
        $day, 
        $document_number_from, 
        $document_number_to, 
        $cash_register_or_system_number, 
        $computerized, 
        $sales_exempt, 
        $sales_internal, 
        $sales_exports, 
        $daily_sales_total, 
        $sales_own, 
        $sales_third_party
    ) {
        $this->day = $day;
        $this->document_number_from = $document_number_from;
        $this->document_number_to = $document_number_to;
        $this->cash_register_or_system_number = $cash_register_or_system_number;
        $this->computerized = $computerized;
        $this->sales_exempt = $sales_exempt;
        $this->sales_internal = $sales_internal;
        $this->sales_exports = $sales_exports;
        $this->daily_sales_total = $daily_sales_total;
        $this->sales_own = $sales_own;
        $this->sales_third_party = $sales_third_party;
    }

    public function saveIssuedDocument($collection)
    {
        $document = [
            'day' => $this->day,
            'document_number_from' => $this->document_number_from,
            'document_number_to' => $this->document_number_to,
            'cash_register_or_system_number' => $this->cash_register_or_system_number,
            'computerized' => $this->computerized,
            'sales' => [
                'exempt' => $this->sales_exempt,
                'internal' => $this->sales_internal,
                'exports' => $this->sales_exports,
                'daily_total' => $this->daily_sales_total,
                'own' => $this->sales_own,
                'third_party' => $this->sales_third_party,
            ]
        ];

        $result = $collection->insertOne($document);

        if ($result->getInsertedCount() == 1) {
            echo "Document successfully issued and recorded. ID: " . $result->getInsertedId();
        } else {
            echo "Error recording the issued document.";
        }
    }
}
?>
