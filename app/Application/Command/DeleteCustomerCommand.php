<?php

namespace App\Application\Command;

class DeleteCustomerCommand implements Command {
    public function __construct( private int $ID ) {
        //
    }

    public function getId() {
        return $this->ID;
    }
}
