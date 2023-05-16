<?php

namespace Tests\Feature;

use App\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

it('can store a customer', function () {
    $customer = Customer::factory()->make();

    $response = $this->postJson("/api/customers/", $customer->toArray());

    $response->assertStatus(Response::HTTP_CREATED);
    $response->assertJsonStructure([
        'id',
        'firstName',
        'dateOfBirth',
        'lastName',
        'email',
        'phoneNumber',
        'bankAccountNumber',
    ]);
    $response->assertJson([
        'firstName' => $customer->first_name,
        'dateOfBirth' => $customer->date_of_birth,
        'lastName' => $customer->last_name,
        'email' => $customer->email,
        'phoneNumber' => $customer->phone_number,
        'bankAccountNumber' => $customer->bank_account_number,
    ]);
});

// TODO:: failed on validation test