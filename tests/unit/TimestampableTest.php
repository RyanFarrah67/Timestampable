<?php

use Mof\Timestampable\Test\Fixture\EntityTest;

class TimestampableTest extends \Codeception\Test\Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testEntityCreated()
    {
        $now = new \DateTime();
        $now = $now->format('Y-m-d');
        $testEntity = new EntityTest;
        $testEntity->setName('test');

        $this->tester->persistEntity($testEntity);
        $testEntity = $this->tester->grabEntityFromRepository(EntityTest::class, [
            'name' => 'test'
        ]);

        $this->tester->assertEquals($now, $testEntity->getCreatedAt()->format('Y-m-d'));
        $this->tester->assertEquals($now, $testEntity->getUpdatedAt()->format('Y-m-d'));
    }

    public function testEntityUpdated()
    {
        $testEntity = new EntityTest();
        $testEntity->setName('test');

        $this->tester->persistEntity($testEntity);
        $testEntity = $this->tester->grabEntityFromRepository(EntityTest::class, [
            'name' => 'test'
        ]);
        $pastDate = $testEntity->getUpdatedAt();

        sleep(1);

        $testEntity->setName('new name');
        $this->tester->persistEntity($testEntity);
        $testEntity = $this->tester->grabEntityFromRepository(EntityTest::class, [
            'name' => 'new name'
        ]);

        $this->tester->assertInstanceOf(\DateTime::class, $testEntity->getUpdatedAt());
        $this->tester->assertGreaterThan($pastDate, $testEntity->getUpdatedAt());

    }
}