<?php

namespace App\Domain\ValueObjects;

class BirthDate {
    public function __construct( private string $birthDate ) {
        //
    }

    public function __toString(): string {
        return $this->birthDate;
    }
}
