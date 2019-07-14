<?php

namespace Mof\Timestampable\Mapping\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Annotation which allows to indicate the properties who will be handled for creation or update date
 * @Annotation
 * @Target("PROPERTY")
 */
class Timestampable
{
    const ON_CREATE = 'create';
    const ON_UPDATE = 'update';

    /**
     * on indicates at which event you want to listen for the property, the constants in this class indicate the events available
     *
     * @var string
     */
    public $on;
}