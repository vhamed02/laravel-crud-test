<?php

namespace App\Domain\Events;

use App\Domain\Models\Customer;

class CustomerRegistered {
    private \DateTimeImmutable $timestamp;
    public function __construct( Customer $customer) {

    }
}
