<?php

namespace App\Application\Query;

interface QueryHandler {
    public function handle( Query $query );
}
