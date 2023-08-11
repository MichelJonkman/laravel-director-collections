<?php

namespace MichelJonkman\DirectorCollections\Collections;

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

    public function getCollections()
    {
        $collectionConverter = app(CollectionLoader::class);
        $collections = $collectionConverter->loadCollections($this->getCollectionPaths());
        dd($collections);
    }
}
