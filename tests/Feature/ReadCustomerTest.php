<?php

namespace Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Infrastructure\Models\EloquentCustomer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadCustomerTest extends TestCase {
    use DatabaseTransactions;

    public function test_user_can_view_a_customer(): void {
        $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'vhamed02@example.com',
            'birthDate'         => '2024-10-11',
            'bankAccountNumber' => '123456789',
            'phoneNumber'       => '+14134240397',
        ] )->assertJson( [ 'success' => 'true' ] );

        $customer = EloquentCustomer::where( 'email', 'vhamed02@example.com' )->first();
        $this->get( route( 'customer.view', $customer->id ) )
             ->assertJson( [ 'customer' => [ 'id' => $customer->id ] ] );
    }
}
