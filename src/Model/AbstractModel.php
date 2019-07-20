<?php

namespace Guym4c\Kasa\Model;

abstract class AbstractModel {

    protected static function hydrate(AbstractModel $model, array $json): void {
        foreach (get_object_vars($model) as $property => $value) {

            if (empty($value))
                $model->{$property} = $json[$property] ?? null;
        }
    }
}