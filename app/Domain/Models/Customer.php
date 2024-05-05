<?php

namespace App\Domain\Models;

use App\Domain\Events\CustomerRegistered;
use App\Domain\ValueObjects\BankAccountNumber;
use App\Domain\ValueObjects\BirthDate;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\FirstName;
use App\Domain\ValueObjects\LastName;
use App\Domain\ValueObjects\PhoneNumber;

class Customer {
    private int $ID;
    private array $events;

    public function __construct(
        private FirstName $firstName,
        private LastName $lastName,
        private Email $email,
        private BirthDate $birthDate,
        private PhoneNumber $phoneNumber,
        private BankAccountNumber $bankAccountNumber,
    ) {
        //
    }

    protected function capture( $event ) {
        $this->events[] = $event;
    }

    public static function register(
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        BirthDate $birthDate,
        PhoneNumber $phoneNumber,
        BankAccountNumber $bankAccountNumber
    ) {
        $customer = new self(
            $firstName,
            $lastName,
            $email,
            $birthDate,
            $phoneNumber,
            $bankAccountNumber,
        );
        $customer->capture( new CustomerRegistered( $customer ) );

        return $customer;
    }

    public function getID(): int {
        return $this->ID;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getBirthDate(): string {
        return $this->birthDate;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getBankAccountNumber(): string {
        return $this->bankAccountNumber;
    }

    public function getEmail(): Email {
        return $this->email;
    }
}
