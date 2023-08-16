<?php

namespace MichelJonkman\DirectorCollections\Collections\Fields;

use MichelJonkman\DbalSchema\Database\Table;

abstract class Field
{
    public function __construct(protected string $name)
    {
    }

    /**
     * Creates the columns on the table schema
     */
    abstract public function schema(Table $table): Table;
}
