<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 4/11/19
 * Time: 8:17 AM
 */

namespace App\Entity;

use App\Entity\Traits\TimeStamping;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BoardApps
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\BoardAppsRepository")
 * @ORM\Table(name="board_apps")
 */
class BoardApps
{
    use TimeStamping;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @var  string $fname
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $fname;

    /** @ORM\Column(type="string", nullable=false, length=100) */
    protected $lname;

    /**
     * @var string $title
     * @ORM\Column(type="string", nullable=false, length=100)
     */
    protected $title;

    /** @ORM\Column(type="string", nullable=true, length=150) */
    protected $email;

    /**
     * @var string $phone
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $phone;

    /** @ORM\Column(type="text", nullable=true)   */
    protected $bio;

    /**
     * @var string $address
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $address;
    /**
     * @var  string $address_2
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $address_2;

    /**
     * @var string $city
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $city;

    /**
     * @var States $state
     * @ORM\ManyToMany(targetEntity="States")
     */
    protected $state;
    /**
     * @var string $zipcode
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $zipcode;

    public function __construct()
    {
        $this->state = new ArrayCollection();
    }

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
    public function getFname(): string
    {
        return $this->fname;
    }

    /**
     * @param string $fname
     * @return BoardApps
     */
    public function setFname(string $fname): self
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param mixed $lname
     * @return BoardApps
     */
    public function setLname($lname): self
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return BoardApps
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @return BoardApps
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
     * @return BoardApps
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     * @return BoardApps
     */
    public function setBio($bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address_2;
    }

    /**
     * @param string $address_2
     * @return $this
     */
    public function setAddress2(string $address_2): self
    {
        $this->address_2 = $address_2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return States
     */
    public function getState(): States
    {
        return $this->state;
    }

    /**
     * @param States $state
     * @return $this
     */
    public function setState(States $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

}