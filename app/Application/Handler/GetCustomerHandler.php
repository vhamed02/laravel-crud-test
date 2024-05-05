<?php

namespace App\Application\Handler;

use App\Application\Command\DeleteCustomerCommand;
use App\Application\Query\GetCustomerQuery;
use App\Application\Query\Query;
use App\Application\Query\QueryHandler;
use App\Domain\Repositories\CustomerRepository;

class GetCustomerHandler implements QueryHandler {

    public function __construct( private CustomerRepository $customerRepository ) {
        //
    }


    public function handle( Query|GetCustomerQuery $query ) {
        return $this->customerRepository->getById( $query->getId() );
    }
}
