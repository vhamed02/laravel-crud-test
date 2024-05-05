<?php

namespace App\Application\Query;

class GetCustomerQuery implements Query {
    public function __construct( private int $ID ) {
        //
    }

    public function getId() {
        return $this->ID;
    }
}
