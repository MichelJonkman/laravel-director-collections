<?php

namespace MichelJonkman\DirectorCollections\Providers;

use Illuminate\Support\AggregateServiceProvider;
use MichelJonkman\DirectorCollections\Collections\CollectionManager;

class CollectionServiceProvider extends AggregateServiceProvider
{
    public function boot(CollectionManager $collectionManager): void
    {
        $collectionManager->addCollectionPath(resource_path('collections'));

        $collectionManager->getCollections();
    }

    protected $providers = [
        BindServiceProvider::class
    ];
}
