<?php

namespace App\Application\Command;

interface CommandBus {
    public function handle( Command $command );
}
