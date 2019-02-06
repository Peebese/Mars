<?php


use PhilipBrown\Mars\Application\Command;
use PhilipBrown\Mars\Application\Navigate;

return [
    'command' => function() {
        $navigate = new Navigate();
        return new Command($navigate);
    }
];