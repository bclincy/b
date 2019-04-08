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
     * @var DateTime $createAt
     * @ORM\Column(type="datetime", name="created_at", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $createAt;

    /**
     * @var  DateTime $updateAt
     * @ORM\Column(type="datetime", name="update_at",options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $updateAt;

    /**
     * @return DateTime
     */
    public function getCreateAt(): DateTime
    {
        return $this->createAt;
    }

    /**
     * @param DateTime $createAt
     * @return self
     */
    public function setCreateAt(DateTime $createAt): self
    {
        $this->createAt = $createAt;

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
     * @param DateTime $updateAt
     * @return self
     */
    public function setUpdateAt(DateTime $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPersistTime()
    {
        $this->createAt = new \DateTime();
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