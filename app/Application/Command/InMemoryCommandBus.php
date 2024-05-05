<?php

namespace App\Application\Command;

use App\Application\Handler\DeleteCustomerHandler;
use App\Application\Handler\RegisterCustomerHandler;
use App\Application\Handler\UpdateCustomerHandler;
use App\Domain\Repositories\CustomerRepository;

class InMemoryCommandBus implements CommandBus {
    private array $commandsMap = [
        RegisterCustomerCommand::class => RegisterCustomerHandler::class,
        UpdateCustomerCommand::class   => UpdateCustomerHandler::class,
        DeleteCustomerCommand::class   => DeleteCustomerHandler::class,
    ];

    public function handle( Command $command ) {
        $class   = $this->commandsMap[ get_class( $command ) ];
        $handler = app( $class );
        $handler->handle( $command );
        $properties = ( new \ReflectionObject( $handler ) )->getProperties();
        foreach ( $properties as $property ) {
            if ( $property instanceof CustomerRepository ) {
                foreach ( $property->seen() as $event ) {
                    // TODO: handle event
                }
            }
        }
    }
}
