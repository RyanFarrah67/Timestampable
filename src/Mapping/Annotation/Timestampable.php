<?php

namespace Mof\Timestampable\Mapping\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Timestampable
{
    public $createdAt;

    public $updatedAt;
}