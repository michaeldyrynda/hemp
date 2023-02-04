<?php

namespace App\Concerns;

use App\Enum\InvoiceStatus;

trait UsesStateMachine
{
    public function transitionTo(InvoiceStatus $status): void
    {
        (new static::$stateMachine)->transitionTo($status, $this);
    }
}
