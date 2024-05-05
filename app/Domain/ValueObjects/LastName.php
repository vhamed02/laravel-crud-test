<?php

namespace App\Domain\ValueObjects;

class LastName {
    public function __construct( private string $lastName ) {
        //
    }

    public function __toString(): string {
        return $this->lastName;
    }
}
