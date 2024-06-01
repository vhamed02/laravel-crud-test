<?php

namespace App\Application\Handler;

use App\Application\Command\Command;
use App\Application\Command\CommandHandler;
use App\Application\Command\UpdateCustomerCommand;
use App\Domain\Repositories\CustomerRepository;

class UpdateCustomerHandler implements CommandHandler {
    public function __construct( private CustomerRepository $customerRepository ) {
        //
    }
    public function handle( Command|UpdateCustomerCommand $command ) {
        $data = [
            'first_name'          => $command->getFirstName(),
            'last_name'           => $command->getLastName(),
            'email'               => $command->getEmail(),
            'bank_account_number' => $command->getBankAccountNumber(),
            'phone_number'        => $command->getPhoneNumber(),
            'birth_date'          => $command->getDateOfBirth(),
        ];
        $this->customerRepository->update( $command->getId(), $data );
    }
}
