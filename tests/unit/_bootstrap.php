<?php

use Mof\Timestampable\Test\ConfigureDb;

$entityManager = ConfigureDb::createEntityManager();

ConfigureDb::dropSchema($entityManager);
ConfigureDb::createSchema($entityManager);