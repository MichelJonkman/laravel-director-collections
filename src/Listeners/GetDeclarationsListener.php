<?php

namespace MichelJonkman\DirectorCollections\Listeners;

use Doctrine\DBAL\Schema\SchemaException;
use MichelJonkman\DbalSchema\Events\GetDeclarationsEvent;
use MichelJonkman\DirectorCollections\Collections\CollectionSchemaMaker;
use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;

class GetDeclarationsListener
{
    public function __construct(protected CollectionSchemaMaker $collectionSchemaMaker)
    {
    }

    /**
     * @throws CollectionLoadException
     * @throws SchemaException
     */
    public function handle(GetDeclarationsEvent $event): void
    {
        $tables = $this->collectionSchemaMaker->getSchemas();

        foreach ($tables as $table) {
            $event->tables[] = $table;
        }
    }
}
