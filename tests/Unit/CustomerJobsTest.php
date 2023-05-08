<?php

namespace Tests\Unit;

use App\Jobs\Customer\IndexJob;
use App\Jobs\Customer\SingleJob;
use App\Jobs\Customer\StoreJob;
use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomerJobsTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * A basic unit test example.
	 */
	public function test_store_job(): void
	{
		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new StoreJob( $customerData ) );
		$this->assertDatabaseHas( Customer::class, $customerData );
	}

	public function test_index_job(): void
	{
		$total = rand( 1, 5 );
		for ( $i = 0; $i < $total; $i++ )
		{
			$customerData = ( new ( CustomerFactory::class )() )->definition();
			dispatch_sync( new StoreJob( $customerData ) );
		}
		$index = dispatch_sync( new IndexJob() );
		$this->assertCount( $total, $index );
	}

	public function test_single_job(): void
	{
		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new StoreJob( $customerData ) );
		$customer = Customer::first();
		$single = dispatch_sync( new SingleJob($customer->id) );
		$this->assertEquals($single,$customer);
	}

}
