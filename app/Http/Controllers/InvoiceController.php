<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Http\Requests\StoreInvoiceItem;
use App\Http\Requests\StoreInvoiceRequest;
use App\ItemType;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();


        return response()->json($invoices);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function generate(StoreInvoiceRequest $request)
    {
        $data_invoice = $request->safe()->only(['company_id','client_id','due_date', 'discount', 'tax', 'subtotal', 'total']);
        $data_invoice_item = $request->safe()->only(['items']);

        $invoice = new Invoice();
        $invoice->status = InvoiceStatus::Draft;
        $invoice->fill($data_invoice);
        $invoice->save();

        $itemPlaceholder = new Item();
        $invoiceItemPlaceholder = new InvoiceItem();

        foreach ($data_invoice_item['items'] as $item) {

            $itemPlaceholder->fill($item);
            $itemPlaceholder->save();

            $invoiceItemPlaceholder->fill($item);
            $invoiceItemPlaceholder->invoice_id = $invoice->id;
            $invoiceItemPlaceholder->item_id = $itemPlaceholder->id;
            $invoiceItemPlaceholder->save();
        }

        return response()->json($invoice, JsonResponse::HTTP_CREATED);
    }

    /**
     * Genrate invoice detail with items
     */
    public function detail(StoreInvoiceItem $request)
    {

        $valid_data = $request->safe()->only([
            'invoice_id',
            'item_id',
            'quantity',
            'unit_price'
        ]);

        $invoice_item = new InvoiceItem();
        $invoice_item->fill($valid_data);
        $invoice_item->save();

        return response()->json($invoice_item);
    }

    public function getPdf()
    {
        $now = Carbon::now();
        $pdf_name = 'invoice_me_' . $now->format('dmY') . '.pdf';
        $invoice = Invoice::with('invoice_items')->with('invoice_items.item')->with('client')->with('client.company')->find(2);
        return Pdf::view('pdfs.invoice',['invoice' => $invoice])->name($pdf_name)->download();
    }

    public function testPdf() {
        $invoice = Invoice::with('invoice_items')->with('invoice_items.item')->with('client')->with('client.company')->find(2);
        return view('pdfs.invoice', ['invoice' => $invoice]);
    }
}
