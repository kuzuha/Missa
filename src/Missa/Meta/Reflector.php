<?php

namespace Missa\Meta;

class Reflector
{
    /**
     * @static
     * @param $class_or_object
     * @return \Missa\Meta\Reflection\Klass
     */
    static function reflectClass($class_or_object)
    {
        return new \Missa\Meta\Reflection\Klass($class_or_object);
    }
}
