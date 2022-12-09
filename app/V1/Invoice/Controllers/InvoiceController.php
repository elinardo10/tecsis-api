<?php

namespace App\V1\Invoice\Controllers;

use App\Http\Controllers\Controller;
use App\V1\Invoice\Models\Invoice;
use App\V1\Invoice\Resources\InvoiceResource;
use App\V1\Invoice\Services\InvoiceService;
use App\V1\Invoices\Requests\InvoiceStoreRequest;

class InvoiceController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function store(InvoiceStoreRequest $request)
    {
        $input = $request->validated();
        $invoice = $this->invoiceService->create($input);
        return new InvoiceResource($invoice);
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function delete(Invoice $invoice)
    {
        $invoice->delete();
    }
}
