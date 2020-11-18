<?php


namespace Core;


class DataBinder implements DataBinderInterface
{

    public function bind($formData, $className)
    {

        $object = new $className();

        foreach ($formData as $field => $value) {
            $methodName = "set" . implode("", array_map(function ($el) { return ucfirst($el); }, explode("_", $field)));

            if (method_exists($object, $methodName)) {
                $object->$methodName($value);
            }
        }

        return $object;
    }
}