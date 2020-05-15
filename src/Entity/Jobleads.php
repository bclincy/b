<?php

namespace App\Entity;

use App\Entity\Traits\TimeStamping;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Podcast
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PodcastRepository")
 * @ORM\Table(name="podcast")
 */

class Jobleads
{
    use TimeStamping;
    /**
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var string $email
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @var string $agency
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $agency;

    /**
     * @var string $devType
     *
     * @ORM\Column(type="string", length=255, name="DevType")
     */
    protected $devType;

    /**
     * @var string $note
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $note;

    /**
     * @var string $linkedIn
     *
     * @ORM\Column(type="string", length=255, name="linkedIn")
     */
    protected $linkedIn;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Jobleads
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Jobleads
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getAgency(): string
    {
        return $this->agency;
    }

    /**
     * @param string $agency
     * @return Jobleads
     */
    public function setAgency(string $agency): self
    {
        $this->agency = $agency;

        return $this;
    }

    /**
     * @return string
     */
    public function getDevType(): string
    {
        return $this->devType;
    }

    /**
     * @param string $devType
     */
    public function setDevType(string $devType): self
    {
        $this->devType = $devType;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Jobleads
     */
    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinkedIn(): string
    {
        return $this->linkedIn;
    }

    /**
     * @param string $linkedIn
     * @return Jobleads
     */
    public function setLinkedIn(string $linkedIn): self
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }


}