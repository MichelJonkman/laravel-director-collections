<?php

namespace MichelJonkman\DirectorCollections\Collections;

use MichelJonkman\DirectorCollections\Collections\Loaders\JsonLoader;
use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;

class CollectionLoader
{
    protected array $collections = [];
    protected bool $loaded = false;

    /**
     * @throws CollectionLoadException
     */
    public function loadCollections(array $collectionPaths, bool $fresh = false): array
    {
        if (!$this->loaded || $fresh) {
            foreach ($collectionPaths as $collectionPath) {
                $this->collections = array_merge($this->collections, $this->loadCollectionsInPath($collectionPath));
            }

            $this->loaded = true;
        }

        return $this->collections;
    }

    /**
     * @throws CollectionLoadException
     */
    public function loadCollectionsInPath(string $path): array
    {
        $files = glob($path . '/*.json');
        $collections = [];

        foreach ($files as $file) {
            $collections[] = $this->loadCollectionFile($file);
        }

        return $collections;
    }

    /**
     * @throws CollectionLoadException
     */
    public function loadCollectionFile(string $filePath): Collection
    {
        $loader = app(JsonLoader::class);

        return $loader->load($filePath);
    }

    public function loadCollectionClass(Collection $collection): void
    {
        $this->collections[] = $collection;
    }
}
