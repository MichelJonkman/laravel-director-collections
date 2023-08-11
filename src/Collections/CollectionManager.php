<?php

namespace MichelJonkman\DirectorCollections\Collections;

class CollectionManager
{
    protected array $collectionPaths = [];

    public function addCollectionPath(string $path)
    {
        $this->collectionPaths[] = $path;
    }
}
