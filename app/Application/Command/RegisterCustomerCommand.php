<?php

namespace App\Application\Command;

class RegisterCustomerCommand implements Command {
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $birthDate,
        public string $phoneNumber,
        public string $bankAccountNumber,
    ) {
        //
    }
}
