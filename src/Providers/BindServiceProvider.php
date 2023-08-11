<?php

namespace MichelJonkman\DirectorCollections\Providers;

use MichelJonkman\Director\Providers\ServiceProvider;
use MichelJonkman\DirectorCollections\Collections\CollectionManager;

class BindServiceProvider extends ServiceProvider
{
    public function registerService(): void
    {
        $this->app->scoped(CollectionManager::class);
    }
}
