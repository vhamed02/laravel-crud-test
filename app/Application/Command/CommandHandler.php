<?php

namespace App\Application\Command;

interface CommandHandler {
    public function handle( Command $command );
}
