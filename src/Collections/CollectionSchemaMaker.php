<?php

namespace MichelJonkman\DirectorCollections\Collections;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\SchemaException;
use MichelJonkman\DbalSchema\Database\Table;
use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;

class CollectionSchemaMaker
{

    public function __construct(protected CollectionManager $collectionManager)
    {
    }

    /**
     * @return Table[]
     * @throws CollectionLoadException
     * @throws SchemaException
     * @throws Exception
     */
    public function getSchemas(): array
    {
        $collections = $this->collectionManager->getCollections();
        $tables = [];

        foreach ($collections as $collection) {
            $tables[] = $collection->getSchema();
        }

        return $tables;
    }

}
