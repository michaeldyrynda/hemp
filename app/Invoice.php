<?php

namespace App;

use App\Concerns\UsesStateMachine;
use App\Enum\InvoiceStatus;

class Invoice
{
    use UsesStateMachine;

    public static $stateMachine = InvoiceStateMachine::class;

    public function __construct(
        public InvoiceStatus $status,
    ) {
    }

    public function update(array $data = []): bool
    {
        $this->status = $data['status'] ?? $this->status;

        return true;
    }
}
