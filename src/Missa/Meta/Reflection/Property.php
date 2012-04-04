<?php

namespace Missa\Meta\Reflection;

class Property extends \ReflectionProperty
{
    function getAnnotations()
    {
        $annotation_list = array();
        if (preg_match_all('/@([A-Z][a-zA-Z]*)/', $this->getDocComment(), $capture)) {
            $annotation_list = array_unique($capture[1]);
        }
        return $annotation_list;
    }

    function hasAnnotation($annotation)
    {
        return in_array($annotation, $this->getAnnotations(), TRUE);
    }

    function getType()
    {
        if (preg_match('/@var\\s+([A-Za-z][^\\s]+)/', $this->getDocComment(), $capture)) {
            $type = $capture[1];
            if ($type[0] !== '\\') {
                $type = $this->getDeclaringClass()->getNamespaceName() . '\\' . $type;
            }
            return $type;
        }
        return null;
    }
}
