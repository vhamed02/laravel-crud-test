<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
class EloquentCustomer extends Model {
    protected $table = 'customers';
    protected $guarded = [];
}
