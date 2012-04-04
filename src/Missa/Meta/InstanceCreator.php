<?php

namespace Missa\Meta;

class InstanceCreator
{
    static function create($class)
    {
        $obj = self::newInstanceWithoutConstructor($class);
        Injector::inject($obj);
        if ($constructor = Reflector::reflectClass($class)->getConstructor()) {
            /* @var $constructor \ReflectionMethod */
            $constructor->invoke($obj);
        }

        return $obj;
    }

    protected static function newInstanceWithoutConstructor($class)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            $meta = Reflector::reflectClass($class);
            return $meta->newInstanceWithoutConstructor();
        }
        $length = strlen($class);
        return unserialize("O:$length:\"$class\":0:{}");
    }
}
