<?php

namespace MichelJonkman\DirectorCollections\Collections;

class Collection
{

    protected string $name;
    protected array $fields;

    public function __construct(string $name, array $fields)
    {
        $this->name = $name;
        $this->fields = $fields;
    }

}
