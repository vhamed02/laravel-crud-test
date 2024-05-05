<?php

namespace App\Domain\ValueObjects;

class FirstName {
    public function __construct( private string $firstName ) {
        //
    }

    public function __toString(): string {
        return $this->firstName;
    }
}
