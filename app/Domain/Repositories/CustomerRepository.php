<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Customer;

interface CustomerRepository {
    public function create( Customer $customer );

    public function getById( $customerId );

    public function update( int $customerId, array $data );

    public function delete( int $customerId );
}
