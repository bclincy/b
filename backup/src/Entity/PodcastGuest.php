<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 4/15/19
 * Time: 11:50 PM
 */

namespace App\Entity;
use App\Entity\Traits\TimeStamping;
use Doctrine\ORM\Mapping as ORM;

/**
 * The docs class simple Doctrine Entity.
 * @ORM\Entity(repositoryClass="App\Repository\PodcastGuestRepository")
 * @ORM\Table(name="podcast_guest")
 */


class PodcastGuest
{
    use TimeStamping;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $phone;
    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    protected $isConnected;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return PodcastGuest
     */
    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return PodcastGuest
     */
    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return PodcastGuest
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return PodcastGuest
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return bool
     */
    public function getisConnected()
    {
        return $this->isConnected;
    }

    /**
     * @param mixed $isConnected
     * @return PodcastGuest
     */
    public function setIsConnected($isConnected): self
    {
        $this->isConnected = $isConnected;

        return $this;
    }


}