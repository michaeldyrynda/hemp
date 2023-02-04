<?php

namespace App\Transitions;

use App\Enum\InvoiceStatus;
use App\Invoice;

class OpenTransition
{
    public function __construct(public Invoice $invoice)
    {
    }

    public function allowed(): bool
    {
        return in_array($this->invoice->status, [
            InvoiceStatus::Draft,
        ]);
    }

    public function handle(): void
    {
        $this->invoice->update(['status' => InvoiceStatus::Open]);
    }
}
