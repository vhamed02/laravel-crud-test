<?php

namespace App\Domain\ValueObjects;

class BankAccountNumber {
    public function __construct( private string $bankAccountNumber ) {
        //
    }

    public function __toString(): string {
        return $this->bankAccountNumber;
    }
}
