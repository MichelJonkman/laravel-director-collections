<?php

namespace MichelJonkman\DirectorCollections\Collections\Loaders;

use JsonSchema\Validator;
use MichelJonkman\DirectorCollections\Collections\Collection;
use MichelJonkman\DirectorCollections\Collections\Fields\Field;
use MichelJonkman\DirectorCollections\Exceptions\CollectionLoadException;
use stdClass;

class JsonLoader
{
    /**
     * @throws CollectionLoadException
     */
    public function load(string $filePath): Collection
    {
        $json = file_get_contents($filePath);

        $data = json_decode($json);
        if (json_last_error()) {
            throw new CollectionLoadException('JSON decoding error: ' . json_last_error_msg());
        }

        $validator = new Validator();
        $validator->validate($data, (object)['$ref' => 'file://' . realpath(__DIR__ . '/../../../json/schema.json')]);

        if (!$validator->isValid()) {
            $errors = [];

            foreach ($validator->getErrors() as $error) {
                $errors[] = "[{$error['property']}] {$error['message']}";
            }

            throw new CollectionLoadException('JSON does not validate. Violations: ' . implode(', ', $errors));
        }

        $data = json_decode(json_encode($data), true);

        $fields = $this->loadFields($data['fields']);

        $id = pathinfo($filePath, PATHINFO_FILENAME);

        return new Collection($id, $data['name'], $fields);
    }

    /**
     * @throws CollectionLoadException
     */
    public function loadFields(array $fields): array
    {
        $fieldObjects = [];

        foreach ($fields as $name => $field) {
            if (!is_subclass_of($field['class'], Field::class)) {
                throw new CollectionLoadException('err');
            }

            $fieldObjects[$name] = app($field['class'], [
                'name' => $name
            ]);
        }

        return $fieldObjects;
    }
}
