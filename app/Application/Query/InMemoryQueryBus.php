<?php

namespace App\Application\Query;

use App\Application\Command\Command;
use App\Application\Command\CommandBus;
use App\Application\Handler\DeleteCustomerHandler;
use App\Application\Handler\GetCustomerHandler;
use App\Application\Handler\RegisterCustomerHandler;
use App\Application\Handler\UpdateCustomerHandler;
use App\Domain\Repositories\CustomerRepository;

class InMemoryQueryBus implements QueryBus {
    private array $queriesMap = [
        GetCustomerQuery::class => GetCustomerHandler::class,
    ];

    public function handle( Query $query ) {
        $class   = $this->queriesMap[ get_class( $query ) ];
        $handler = app( $class );
        return $handler->handle( $query );
    }
}
