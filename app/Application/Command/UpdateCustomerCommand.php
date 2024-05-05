<?php

namespace App\Application\Command;

class UpdateCustomerCommand implements Command {
    public function __construct(
        private int $ID,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $bankAccountNumber,
        private string $phoneNumber,
        private string $dateOfBirth,
    ) {
        //
    }

    public function getId(): int {
        return $this->ID;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getBankAccountNumber(): string {
        return $this->bankAccountNumber;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getDateOfBirth(): string {
        return $this->dateOfBirth;
    }

}
