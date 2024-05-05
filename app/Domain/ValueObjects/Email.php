<?php

namespace App\Domain\ValueObjects;

use PharIo\Manifest\InvalidEmailException;

class Email {
    public function __construct( private string $emailAddress ) {
        if ( ! filter_var( $emailAddress, FILTER_VALIDATE_EMAIL ) ) {
            throw new InvalidEmailException();
        }
    }

    public function __toString(): string {
        return $this->emailAddress;
    }
}
