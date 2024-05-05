<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Infrastructure\Models\EloquentCustomer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCustomerTest extends TestCase {
    use DatabaseTransactions;

    private EloquentCustomer $customer;

    public function setUp(): void {
        parent::setUp();

        $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'update@sample.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] )->assertJson( [ 'success' => 'true' ] );

        $this->customer = EloquentCustomer::where( 'email', 'update@sample.com' )->first();
    }

    public function test_user_can_update_a_customer() {
        $this->post( route( 'customer.update', $this->customer->id ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'njr',
            'email'             => 'another.mail@sample.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] )->assertJson( [ 'success' => 'true' ] );

        $updatedCustomer = EloquentCustomer::find( $this->customer->id );
        $this->assertEquals( 'njr', $updatedCustomer->last_name );
        $this->assertEquals( 'another.mail@sample.com', $updatedCustomer->email );
    }

    public function test_user_cannot_update_a_customer_email_to_an_existing_one() {
        $response = $this->post( route( 'customer.update', $this->customer->id ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'njr',
            'email'             => 'update@sample.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] );

        $response->assertSessionHasErrors( 'email' );
    }

    public function test_user_cannot_update_a_customer_with_invalid_phone_number() {
        $response = $this->post( route( 'customer.update', $this->customer->id ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'njr',
            'email'             => 'another.mail@sample.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+9319293819283',
        ] );
        $response->assertSessionHasErrors( 'phoneNumber' );
    }
}
