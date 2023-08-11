<?php

namespace MichelJonkman\DirectorCollections\Collections\Loaders;

use JsonSchema\Validator;
use MichelJonkman\DirectorCollections\Collections\Collection;
use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;

class JsonLoader
{
    public function load(string $filePath): Collection {
        $json = file_get_contents($filePath);

        $data = json_decode($json, true);
        if (json_last_error()) {
            throw new CollectionLoadException('JSON decoding error: ' . json_last_error_msg());
        }

        $validator = new Validator();
        $validator->validate($data, (object)['$ref' => 'file://' . realpath(__DIR__ . '/../../../json/schema.json')]);

        if ($validator->isValid()) {
            echo "The supplied JSON validates against the schema.\n";
        } else {
            echo "JSON does not validate. Violations:\n";
            foreach ($validator->getErrors() as $error) {
                printf("[%s] %s\n", $error['property'], $error['message']);
            }
        }


        $collection = new Collection($data['name'], $data['fields']);

        return $collection;
    }
}
