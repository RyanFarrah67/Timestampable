[![Build Status](https://travis-ci.org/RyanFarrah67/Timestampable.svg?branch=master)](https://travis-ci.org/RyanFarrah67/Timestampable)

# Presentation

This little library for Doctrine projects allows you to automatically handle creation and update on certain properties of your entity.

## How install

You need to install it via composer : 

`composer require mof/timestampable`  

Then you need to register the annotations and add the event subscriber to the Doctrine event manager :

`AnnotationRegistry::registerLoader('class_exists'); //This register the annotation`

```
$annotationReader = new AnnotationReader();
$eventManager->addEventSubscriber(new TimestampableSubscriber($annotationReader));
```
You can give to the TimestampableSubcriber constructor any class that implements the `Doctrine\Common\Annotations\Reader` interface.

Then you ready to go.

## Usage

In your entity, you can add the events the property will listen to, there are 2 events available :

```
/**
 * When an entity is created
 * @var \DateTime
 * @ORM\Column(type="datetime", name="created_at")
 * @Timestampable(on=Timestampable::ON_CREATE)
 */
protected $createdAt;
```
```
/**
 * When an entity is updated (the date is also set when an entity is created)
 * @var \DateTime
 * @ORM\Column(type="datetime", name="updated_at")
 * @Timestampable(on=Timestampable::ON_UPDATE)
 */
protected $updatedAt;
```

## Tests

You can run the tests by cloning the project and then type :

```
composer install
vendor/bin/codecept run
```

The tests use sqlite for the database behind the scene, for more information, see https://www.php.net/manual/fr/sqlite.installation.php.
