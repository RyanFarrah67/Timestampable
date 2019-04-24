<?php

namespace Mof\Timestampable\Event;

use Entity\Product;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Annotations\AnnotationReader;
use Mof\Timestampable\Mapping\Annotation\Timestampable;
/**
 * Listener which handle creation and update's date on properties managed by Mapping\Annotation\Timestampable annotation class
 */
class TimestampableSubscriber implements EventSubscriber
{

    /**
     * @var AnnotationReader|null
     */
    protected $annotationReader;

    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        if(!$this->annotationReader) {
            $this->annotationReader = new AnnotationReader();
        }
        
        $entity = $args->getEntity();
        $reflectionEntity = new \ReflectionClass($entity);

        $classMedata = $args->getEntityManager()->getClassMetadata(get_class($entity));

        foreach($reflectionEntity->getProperties() as $reflectionProperty) {
            if($this->annotationReader->getPropertyAnnotation($reflectionProperty, Timestampable::class)) {
                $field = $reflectionProperty->getName();
                $classMedata->setFieldValue($entity, $field, new \DateTime());
            }
        }
    }
}