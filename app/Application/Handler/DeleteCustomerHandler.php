<?php

namespace App\Application\Handler;

use App\Application\Command\Command;
use App\Application\Command\CommandHandler;
use App\Application\Command\DeleteCustomerCommand;
use App\Domain\Repositories\CustomerRepository;

class DeleteCustomerHandler implements CommandHandler {

    public function __construct( private CustomerRepository $customerRepository ) {
        //
    }

    public function handle( Command|DeleteCustomerCommand $command ) {
        $this->customerRepository->delete( $command->getId() );
    }
}
