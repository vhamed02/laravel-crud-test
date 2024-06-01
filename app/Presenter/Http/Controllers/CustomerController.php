<?php

namespace App\Presenter\Http\Controllers;

use App\Application\Command\CommandBus;
use App\Application\Query\GetCustomerQuery;
use App\Application\Query\QueryBus;
use App\Application\Command\DeleteCustomerCommand;
use App\Application\Command\RegisterCustomerCommand;
use App\Application\Command\UpdateCustomerCommand;
use App\Application\Query\Query;
use App\Infrastructure\Models\EloquentCustomer;
use App\Presenter\Rules\PhoneNumber;
use Illuminate\Http\Request;
use libphonenumber\PhoneNumberUtil;

class CustomerController extends Controller {

    public function __construct( private CommandBus $commandBus, private QueryBus $queryBus ) {
        //
    }

    public function view( $customerId ) {
        return response()->json(
            [
                'customer' => $this->queryBus->handle( new GetCustomerQuery( (int) $customerId ) )
            ]
        );
    }

    public function create( Request $request ) {
        $request->validate( [
            'firstName'         => 'required',
            'lastName'          => 'required',
            'email'             => 'required|email|unique:customers',
            'birthDate'         => 'required',
            'phoneNumber'       => [ 'required', new PhoneNumber ],
            'bankAccountNumber' => 'required'
        ] );
        $this->commandBus->handle( new RegisterCustomerCommand(
            $request->get( 'firstName' ),
            $request->get( 'lastName' ),
            $request->get( 'email' ),
            $request->get( 'birthDate' ),
            $request->get( 'phoneNumber' ),
            $request->get( 'bankAccountNumber' ),
        ) );

        return response()->json( [
            'success' => 'true',
            'message' => 'Customer created successfully'
        ] );
    }

    public function update( Request $request, $id ) {
        $request->validate( [
            'email'       => 'email|unique:customers',
            'phoneNumber' => [ 'sometimes', new PhoneNumber ],
        ] );
        $customer = $this->queryBus->handle( new GetCustomerQuery( $id ) );
        if ( false === $customer ) {
            return throw new \InvalidArgumentException( 'Customer not found!' );
        }
        $this->commandBus->handle( new UpdateCustomerCommand(
            $id,
            $request->firstName ?? $customer->first_name,
            $request->lastName ?? $customer->last_name,
            $request->email ?? $customer->email,
            $request->bankAccountNumber ?? $customer->bank_account_number,
            $request->phoneNumber ?? $customer->phone_number,
            $request->birthDate ?? $customer->birth_date
        ) );

        return response()->json( [
            'success' => 'true',
            'message' => 'Customer updated successfully'
        ] );
    }

    public function delete( int $id ) {
        $this->commandBus->handle( new DeleteCustomerCommand( $id ) );

        return response()->json( [
            'success' => 'true',
            'message' => 'Customer removed successfully'
        ] );
    }
}
