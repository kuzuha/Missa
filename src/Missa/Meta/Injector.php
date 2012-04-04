<?php

namespace Missa\Meta;

class Injector
{
    static function inject($object)
    {

        $function = function ($property)
        {
            /* @var $property \Missa\Meta\Reflection\Property */
            return $property->hasAnnotation('Inject');
        };

        $property_list = array_filter(Reflector::reflectClass($object)->getProperties(), $function);

        foreach ($property_list as $property) {
            /* @var $property \Missa\Meta\Reflection\Property */
            $property->setAccessible(TRUE);
            $property->setValue($object, InstanceCreator::create($property->getType()));
        }
    }
}
