<?php

namespace Mof\Timestampable\Event;

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Mof\Timestampable\Mapping\Annotation\Timestampable;
use Doctrine\Common\Annotations\Reader;

/**
 * Listener which handle creation and update's date on properties managed by Mapping\Annotation\Timestampable annotation class
 */
class TimestampableSubscriber implements EventSubscriber
{

    /**
     * Annotation values to check on prePersist
     *
     * @var array
     */
    protected $prePersist = [
        'create',
        'update'
    ];

    /**
     * Annotation values to check on preUpdate
     *
     * @var array
     */
    protected $preUpdate = [
        'update'
    ];

    /**
     * @var Reader
     */
    protected $annotationReader;

    /**
     * @param Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate
        );
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $reflectionEntity = new \ReflectionClass($entity);

        $classMedata = $args->getEntityManager()->getClassMetadata(get_class($entity));

        foreach($reflectionEntity->getProperties() as $reflectionProperty) {
            if($annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Timestampable::class)) {
                if(in_array($annotation->on, $this->prePersist)) {
                    $field = $reflectionProperty->getName();
                    $classMedata->setFieldValue($entity, $field, new \DateTime());
                }
            }
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $reflectionEntity = new \ReflectionClass($entity);

        $classMedata = $args->getEntityManager()->getClassMetadata(get_class($entity));

        foreach($reflectionEntity->getProperties() as $reflectionProperty) {
            if($annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Timestampable::class)) {
                if(in_array($annotation->on, $this->preUpdate)) {
                    $field = $reflectionProperty->getName();
                    $classMedata->setFieldValue($entity, $field, new \DateTime());
                }
            }
        }
    }
}