<?php

namespace App\Application\Handler;

use App\Application\Command\Command;
use App\Application\Command\CommandHandler;
use App\Application\Command\RegisterCustomerCommand;
use App\Domain\Models\Customer;
use App\Domain\Repositories\CustomerRepository;
use App\Domain\ValueObjects\BankAccountNumber;
use App\Domain\ValueObjects\BirthDate;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\FirstName;
use App\Domain\ValueObjects\LastName;
use App\Domain\ValueObjects\PhoneNumber;

class RegisterCustomerHandler implements CommandHandler {

    public function __construct( private CustomerRepository $customerRepository ) {
        //
    }

    public function handle( Command|RegisterCustomerCommand $command ) {
        $customer = Customer::register(
            new FirstName( $command->firstName ),
            new LastName( $command->lastName ),
            new Email( $command->email ),
            new BirthDate( $command->birthDate ),
            new PhoneNumber( $command->phoneNumber ),
            new BankAccountNumber( $command->bankAccountNumber )
        );
        $this->customerRepository->persist( $customer );
    }
}
