# Presentation

This little library for Doctrine projects allows you to automatically handle creation and update on certain properties of your 
entity.

## How install

You need to install it via composer : 

`composer require mof/timestampable`  

Then you need to register the annotations and the event subscriber to the Doctrine event manager :

`AnnotationRegistry::registerLoader('class_exists'); //This register the annotation`

`$eventManager->addEventSubscriber(new TimestampableSubscriber());`

Then you ready to go.

## Tests

You can run the tests by cloning the project and then type :

`vendor/bin/codecept run`

The tests use sqlite for the database behind the scene, for more information, see https://www.php.net/manual/fr/sqlite.installation.php.
