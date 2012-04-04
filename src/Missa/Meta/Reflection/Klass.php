<?php

namespace Missa\Meta\Reflection;

class Klass extends \ReflectionClass
{
    public function getProperties($filter = NULL)
    {
        $self = $this;
        $function = function($property) use ($self) {
            /* @var $self Klass */
            /* @var $property \ReflectionProperty */
            return $self->getProperty($property->getName());
        };
        $property_list = is_null($filter) ? parent::getProperties() : parent::getProperties($filter);
        return array_map($function, $property_list);
    }

    /**
     * @param string $name
     * @return \Missa\Meta\Reflection\Property
     */
    public function getProperty($name)
    {
        return new Property($this->getName(), parent::getProperty($name)->getName());
    }
}
