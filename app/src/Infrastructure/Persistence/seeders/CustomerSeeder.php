<?php

namespace Ddd\Infrastructure\Persistence\seeders;


use Ddd\Infrastructure\Persistence\Eloquent\Models\CustomerModel;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numCustomers = 10; // Number of fake customers to create
        CustomerModel::factory()->count($numCustomers)->create();
    }
}