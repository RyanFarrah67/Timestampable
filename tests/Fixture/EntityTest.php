<?php

namespace Mof\Timestampable\Test\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Mof\Timestampable\Mapping\Annotation\Timestampable;

/**
 * @ORM\Entity
 */
class EntityTest
{
    /**
     * @var int
     * @ORM\Id 
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
    * @var \DateTime
    * @ORM\Column(type="datetime", name="created_at")
    * @Timestampable(on=Timestampable::ON_CREATE)
    */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at")
     * @Timestampable(on=Timestampable::ON_UPDATE)
     */
    protected $updatedAt;


    /**
     * @return string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * 
     * @return self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return  \DateTime
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * 
     * @return self
     */ 
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return \DateTime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */ 
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}