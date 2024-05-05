<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Customer;

interface CustomerRepository {
    public function persist( Customer $customer );

    public function seen(): array;
}
