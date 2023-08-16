<?php

namespace MichelJonkman\DirectorCollections\Collections;

use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;

class CollectionManager
{
    protected array $collectionPaths = [];

    public function addCollectionPath(string $path): void
    {
        $this->collectionPaths[] = $path;
    }

    public function getCollectionPaths(): array
    {
        return $this->collectionPaths;
    }

    /**
     * @return Collection[]
     * @throws CollectionLoadException
     */
    public function getCollections(): array
    {
        $collectionConverter = app(CollectionLoader::class);
        return $collectionConverter->loadCollections($this->getCollectionPaths());
    }
}
