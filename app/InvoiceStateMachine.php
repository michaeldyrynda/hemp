<?php

namespace App;

use App\Concerns\HandlesTransitions;
use App\Enum\InvoiceStatus;
use App\Transitions\DraftTransition;
use App\Transitions\OpenTransition;
use App\Transitions\PaidTransition;
use App\Transitions\VoidTransition;
use SplObjectStorage;

class InvoiceStateMachine
{
    use HandlesTransitions;

    public static function states(): SplObjectStorage
    {
        return with(new SplObjectStorage, function (SplObjectStorage $store) {
            $store->attach(InvoiceStatus::Draft, DraftTransition::class);
            $store->attach(InvoiceStatus::Open, OpenTransition::class);
            $store->attach(InvoiceStatus::Paid, PaidTransition::class);
            $store->attach(InvoiceStatus::Void, VoidTransition::class);
            $store->attach(InvoiceStatus::Uncollectible, UncollectibleTransition::class);

            return $store;
        });
    }
}

