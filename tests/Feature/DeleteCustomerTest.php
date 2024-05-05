<?php

namespace Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Infrastructure\Models\EloquentCustomer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCustomerTest extends TestCase {
    use DatabaseTransactions;

    public function test_user_can_delete_a_customer() {
        $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'delete@sample.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] )->assertJson( [ 'success' => 'true' ] );

        $customer = EloquentCustomer::where( 'email', 'delete@sample.com' )->first();

        $this->post( route( 'customer.delete', $customer->id ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'delete@sample.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] )->assertJson( [ 'success' => 'true' ] );

        $removedCustomer = EloquentCustomer::where( 'email', 'delete@sample.com' )->first();
        $this->assertNull( $removedCustomer );
    }
}
