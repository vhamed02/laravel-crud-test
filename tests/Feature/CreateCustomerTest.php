<?php

namespace Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Infrastructure\Models\EloquentCustomer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCustomerTest extends TestCase {
    use DatabaseTransactions;

    public function test_user_can_create_a_customer(): void {
        $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'vhamed02@example.com',
            'birthDate'         => '2024-10-11',
            'bankAccountNumber' => '123456789',
            'phoneNumber'       => '+14134240397',
        ] )->assertJson( [ 'success' => 'true' ] );
    }

    public function test_user_cannot_create_a_customer_with_duplicated_email() {
        $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'duplicate.mail@test.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] );
        $response = $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'duplicate.mail@test.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+14134240397',
        ] );

        $response->assertSessionHasErrors( 'email' );
    }

    public function test_user_cannot_create_a_customer_with_wrong_phone_number() {
        $response = $this->post( route( 'customer.create' ), [
            'firstName'         => 'Hamed',
            'lastName'          => 'Najari',
            'email'             => 'duplicate.mail@test.com',
            'birthDate'         => '2024-10-10',
            'bankAccountNumber' => '123456788',
            'phoneNumber'       => '+9182938192381928',
        ] );
        $response->assertSessionHasErrors( 'phoneNumber' );
    }
}
