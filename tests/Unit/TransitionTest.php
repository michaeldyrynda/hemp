<?php

namespace Tests\Unit;

use App\Enum\InvoiceStatus;
use App\Invoice;
use Exception;
use PHPUnit\Framework\TestCase;

class TransitionTest extends TestCase
{
    protected Invoice $invoice;

    /** @test */
    public function it_can_transition_to_open_state_from_draft()
    {
        $this->createInvoice(InvoiceStatus::Draft);
        $this->assertEquals(InvoiceStatus::Draft, $this->invoice->status);
        $this->invoice->transitionTo(InvoiceStatus::Open);
        $this->assertEquals(InvoiceStatus::Open, $this->invoice->status);
    }

    /** @test */
    public function it_throws_exception_if_transition_disallowed()
    {
        $this->createInvoice(InvoiceStatus::Void);
        $this->assertEquals(InvoiceStatus::Void, $this->invoice->status);
        $this->expectException(Exception::class);
        $this->invoice->transitionTo(InvoiceStatus::Open);
    }

    protected function createInvoice(InvoiceStatus $status): void
    {
        $this->invoice = new Invoice($status);
    }
}
