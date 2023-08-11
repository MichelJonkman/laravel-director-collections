<?php

namespace MichelJonkman\DirectorCollections\Collections;

use MichelJonkman\DirectorCollections\Collections\Loaders\JsonLoader;
use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;
use PhpParser\JsonDecoder;

class CollectionLoader
{
    public function loadCollections(array $collectionPaths): array
    {
        $collections = [];

        foreach ($collectionPaths as $collectionPath) {
            $collections = array_merge($collections, $this->loadCollectionsInPath($collectionPath));
        }

        return $collections;
    }

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
}
