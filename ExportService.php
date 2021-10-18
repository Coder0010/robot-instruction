<?php

namespace App\Services;

use App\Services\Helpers\SetterAndGetter;
use App\Repositories\Contracts\InvoiceRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Services\Contracts\ExportServiceInterface;
use App\Repositories\Contracts\ProductInvoiceRepository;

class ExportService implements ExportServiceInterface
{
    use SetterAndGetter;

    public function __construct(
        CustomerRepository $customerRepository,
        ProductRepository $productRepository,
        InvoiceRepository $invoiceRepository,
        ProductInvoiceRepository $productInvoiceRepository
    ) {
        $this->setCustomerRepository($customerRepository);
        $this->setProductRepository($productRepository);
        $this->setInvoiceRepository($invoiceRepository);
        $this->setProductInvoiceRepository($productInvoiceRepository);
    }
    
    public function export()
    {
        $customers         = $this->getCustomerRepository()->fetchAll();
        $products          = $this->getProductRepository()->fetchAll();
        $invoices          = $this->getInvoiceRepository()->fetchAll();
        $productInvoice    = $this->getProductInvoiceRepository()->fetchAll();
        $convertDataTojson = json_encode([
            "customers"      => $customers,
            "products"       => $products,
            "invoices"       => $invoices,
            "productInvoice" => $productInvoice,
        ]);
        file_put_contents(__DIR__."/../Files/data.json", $convertDataTojson);
    }
}
