<?php

namespace Guym4c\Kasa\Model;

abstract class AbstractModel {

    protected function hydrate(array $json): void {
        foreach (get_object_vars($this) as $property => $value) {

            if (empty($value)) {
                $this->{$property} = $json[$property] ?? null;
            }
        }
    }
}