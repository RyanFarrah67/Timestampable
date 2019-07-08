<?php

namespace Mof\Timestampable\Test;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;
use Doctrine\ORM\EntityManagerInterface;
use Mof\Timestampable\Test\Fixture\EntityTest;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Mof\Timestampable\Event\TimestampableSubscriber;

class ConfigureDb
{
    public static function createEntityManager()
    {
        $isDevMode = true;
        AnnotationRegistry::registerLoader('class_exists');
        
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/Fixture'), $isDevMode, null, null, false);
        
        $conn = array(
            'path' => 'tests/test.db',
            'driver' => 'pdo_sqlite'
        );
        
        $eventManager = new EventManager();
        $eventManager->addEventSubscriber(new TimestampableSubscriber());
        
        
        $entityManager = EntityManager::create($conn, $config, $eventManager);

        return $entityManager;
    }

    /**
     * @param EntityManager $entityManager
     * @return void
     */
    public static function createSchema(EntityManager $entityManager = null)
    {
        if(!$entityManager) {
            $entityManager = self::createEntityManager();
        }
        $tool = new SchemaTool($entityManager);
        $schemaValidator = new SchemaValidator($entityManager);
        $classes = self::getAllClassMetadata($entityManager);
        $tool->createSchema($classes);

        $result = $schemaValidator->validateMapping();
        if(empty($result)) {
            echo "The schema of the database has successfuly been created" . \PHP_EOL;
        } else {
            echo "A problem has happened when creating the schema" . \PHP_EOL;
        }
    }

    /**
     * @param EntityManager $entityManager
     * @return void
     */
    public static function dropSchema(EntityManager $entityManager = null)
    {
        if(!$entityManager) {
            $entityManager = self::createEntityManager();
        }
        $tool = new SchemaTool($entityManager);
        $classes = self::getAllClassMetadata($entityManager);
        $tool->dropSchema($classes);
        echo "The schema of the database has succesfully been dropped" . \PHP_EOL;
    }

    protected static function getAllClassMetadata(EntityManagerInterface $entityManager)
    {
        return array(
            $entityManager->getClassMetadata(EntityTest::class),
        );
    }
}