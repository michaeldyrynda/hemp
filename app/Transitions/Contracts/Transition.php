<?php

namespace App\Transitions\Contracts;

interface Transition
{
    public function allowed(): bool;

    public function handle(): void;
}
