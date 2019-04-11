<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 4/11/19
 * Time: 5:13 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string$username
     * @ORM\Column(type="string", length=35, nullable=false)
     */
    protected $username;

    /**
     * @var string $usernamecanonical
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $usernamecanonical;

    /**
     * @var string $email
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @var boolean $isEnabled
     * @ORM\Column(type="boolean", nullable=false, options={"default"=false})
     */
    protected $isEnabled;

    /**
     * @var string $salt
     * @ORM\Column(type="string", nullable=true, length=200)
     */
    protected $salt;

    /**
     * @var string $password
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    protected $password;

    /**
     * @var \DateTime $lastLogin
     * @ORM\Column(type="datetime", name="last_login",options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $lastLogin;

    /**
     * @var string $confirmationToken
     * @ORM\Column(type="string", nullable=true)
     */
    protected $confirmationToken;

    /**
     * @var \DateTime $passwordRequestAt
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $passwordRequestAt;

    /**
     * @var string $role
     * @ORM\Column(type="string", nullable=true)
     */
    protected $role;

    /**
     * @var string $firstName
     * @ORM\Column(type="string", nullable=true, length=100)
     */
    protected $firstName;

    /**
     * @var string $lastName
     * @ORM\Column(type="string", nullable=true, length=100)
     */
    protected $lastName;

    /**
     * @var \DateTime $dob
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dob;

    /**
     * @var integer $customerId
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $customerId;

    /**
     * @var Docs $author
     * @ORM\OneToMany(targetEntity="User", mappedBy="authorId")
     */
    protected $author;

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsernamecanonical(): string
    {
        return $this->usernamecanonical;
    }

    /**
     * @param string $usernamecanonical
     */
    public function setUsernamecanonical(string $usernamecanonical)
    {
        $this->usernamecanonical = $usernamecanonical;
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
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin(): \DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     */
    public function setLastLogin(\DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return string
     */
    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }

    /**
     * @param string $confirmationToken
     */
    public function setConfirmationToken(string $confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * @return \DateTime
     */
    public function getPasswordRequestAt(): \DateTime
    {
        return $this->passwordRequestAt;
    }

    /**
     * @param \DateTime $passwordRequestAt
     */
    public function setPasswordRequestAt(\DateTime $passwordRequestAt)
    {
        $this->passwordRequestAt = $passwordRequestAt;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getDob(): \DateTime
    {
        return $this->dob;
    }

    /**
     * @param \DateTime $dob
     * @return User
     */
    public function setDob(\DateTime $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return User
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return Docs
     */
    public function getAuthor(): Docs
    {
        return $this->author;
    }

    /**
     * @param Docs $author
     * @return User
     */
    public function setAuthor(Docs $author): self
    {
        $this->author = $author;

        return $this;
    }


}