<?php

namespace App\Transitions;

use App\Enum\InvoiceStatus;
use App\Invoice;
use App\Transitions\Contracts\Transition;

class DraftTransition implements Transition
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
        $this->invoice->update(['status' => InvoiceStatus::Draft]);
    }
}
