<?php

namespace App\Infrastructure\DBRepositories;

use App\Domain\Models\Customer;
use App\Domain\Repositories\CustomerRepository;
use App\Infrastructure\Models\EloquentCustomer;

class EloquentCustomerRepository implements CustomerRepository {

    private array $seen;

    public function persist( Customer $customer ) {

        EloquentCustomer::create( [
            'first_name'          => $customer->getFirstName(),
            'last_name'           => $customer->getLastName(),
            'birth_date'          => $customer->getBirthDate(),
            'phone_number'        => $customer->getPhoneNumber(),
            'email'               => $customer->getEmail(),
            'bank_account_number' => $customer->getBankAccountNumber()
        ] );

        $this->seen[] = $customer;
    }

    public function update( int $customerId, array $data ): void {
        EloquentCustomer::whereId( $customerId )->update( $data );
    }

    public function getById( $customerId ) {
        return EloquentCustomer::whereId( $customerId )->first();
    }
    public function delete( int $customerId ) {
        $customer = EloquentCustomer::whereId( $customerId )->first();
        if ( ! $customer ) {
            throw new \InvalidArgumentException( "Customer not found!" );
        }
        $customer->delete();
    }

    public function seen(): array {
        return $this->seen;
    }
}
