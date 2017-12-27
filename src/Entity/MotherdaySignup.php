<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 12/25/17
 * Time: 8:17 AM
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mothersday")
 */
class MotherdaySignup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $fname;
    /**
     * @ORM\Column(type="string")
     */
    protected $lname;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @ORM\Column(type="string")
     */
    protected $reason;
    /**
     * @ORM\Column(type="string")
     */
    protected $mothername;
    /**
     * @ORM\Column(type="string")
     */
    protected $why;
    /**
     * @ORM\Column(type="string")
     */
    protected $created;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
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
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
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
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return mixed
     */
    public function getMothername()
    {
        return $this->mothername;
    }

    /**
     * @param mixed $mothername
     */
    public function setMothername($mothername)
    {
        $this->mothername = $mothername;
    }

    /**
     * @return mixed
     */
    public function getWhy()
    {
        return $this->why;
    }

    /**
     * @param mixed $why
     */
    public function setWhy($why)
    {
        $this->why = $why;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

}