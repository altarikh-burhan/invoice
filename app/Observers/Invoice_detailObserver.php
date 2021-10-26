<?php

namespace App\Observers;

use App\Models\InvoiceDetail;
use App\Models\Invoice;

class Invoice_detailObserver
{
    public function generateTotal($invoiceDetail)
    {
        $invoice_id = $invoiceDetail->invoice_id;
        $invoice_detail = InvoiceDetail::where('invoice_id', $invoice_id)->get();
        $total = $invoice_detail->sum(function($i) {
            return $i->price * $i->qty;
        });
        $invoiceDetail->invoice()->update([
            'total' => $total
        ]);
    }
    /**
     * Handle the InvoiceDetail "created" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function created(InvoiceDetail $invoiceDetail)
    {
         $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the InvoiceDetail "updated" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function updated(InvoiceDetail $invoiceDetail)
    {
         $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the InvoiceDetail "deleted" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function deleted(InvoiceDetail $invoiceDetail)
    {
         $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the InvoiceDetail "restored" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function restored(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Handle the InvoiceDetail "force deleted" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function forceDeleted(InvoiceDetail $invoiceDetail)
    {
        //
    }
}
