<?php

namespace App\Domain\ValueObjects;

use PharIo\Manifest\InvalidEmailException;

class PhoneNumber {
    public function __construct( private string $phoneNumber ) {
        //
    }
    public function __toString(): string {
        return $this->phoneNumber;
    }
}
