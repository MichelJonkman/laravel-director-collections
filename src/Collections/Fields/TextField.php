<?php

namespace MichelJonkman\DirectorCollections\Collections\Fields;

use Doctrine\DBAL\Schema\SchemaException;
use MichelJonkman\DbalSchema\Database\Table;

class TextField extends Field
{

    /**
     * @throws SchemaException
     */
    public function schema(Table $table): Table
    {
        $table->addColumn($this->name, 'string');

        return $table;
    }
}
