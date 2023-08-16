<?php

namespace MichelJonkman\DirectorCollections\Collections\Traits;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\SchemaException;
use MichelJonkman\DbalSchema\Database\Table;

trait CreatesSchemaTrait
{
    /**
     * @throws SchemaException
     * @throws Exception
     */
    public function getSchema(): Table
    {
        $table = new Table('collection_' . $this->id);

        $table->addId();

        foreach ($this->fields as $field) {
            $table = $field->schema($table);
        }

        $table->addTimestamps();

        return $table;
    }
}
