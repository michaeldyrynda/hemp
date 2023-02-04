<?php

namespace App\Concerns;

use App\Enum\InvoiceStatus;
use App\Invoice;
use Exception;

trait HandlesTransitions
{
    public function transitionTo(InvoiceStatus $status, Invoice $invoice): void
    {
        $transitionClass = static::states()[$status];

        /** @var \App\Transitions\Contracts\Transition */
        $transition = new $transitionClass($invoice);

        if (! $transition->allowed($invoice)) {
            throw new Exception('Cannot transition to this state.');
        }

        $transition->handle();
    }
}
