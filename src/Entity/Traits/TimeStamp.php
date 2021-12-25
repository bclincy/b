<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 4/7/19
 * Time: 2:03 PM
 */

namespace App\Entity\Traits;

use DateTime;

trait TimeStamping
{

    /**
     * @var DateTime $createdAt
     * @ORM\Column(type="datetime", name="created_at", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $createdAt;

    /**
     * @var  DateTime $updatedAt
     * @ORM\Column(type="datetime", name="updated_at",options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $updatedAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updateAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return self
     */
    public function setUpdateAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPersistTime()
    {
        $this->createdAt = new \DateTime();
        $this->updateAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function onUpdate()
    {
        $this->updateAt = new \DateTime();
    }
}