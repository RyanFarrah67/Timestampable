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
    public $createdAt;

    public $updatedAt;
}