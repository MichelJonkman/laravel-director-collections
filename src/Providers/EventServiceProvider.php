<?php

namespace MichelJonkman\DirectorCollections\Providers;

use App\Providers\EventServiceProvider as ServiceProvider;
use MichelJonkman\DbalSchema\Events\GetDeclarationsEvent;
use MichelJonkman\DirectorCollections\Listeners\GetDeclarationsListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        GetDeclarationsEvent::class => [
            GetDeclarationsListener::class
        ]
    ];
}
