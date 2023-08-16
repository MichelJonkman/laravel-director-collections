<?php

namespace MichelJonkman\DirectorCollections\Collections;

use MichelJonkman\DirectorCollections\Collections\Fields\Field;
use MichelJonkman\DirectorCollections\Collections\Traits\CreatesSchemaTrait;

class Collection
{
    use CreatesSchemaTrait;

    protected string $id;
    protected string $name;

    /**
     * @var Field[]
     */
    protected array $fields;

    public function __construct(string $id, string $name, array $fields)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fields = $fields;
    }
}
