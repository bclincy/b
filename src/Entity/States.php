<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/11/18
 * Time: 12:13 PM
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * The docs class simple Doctrine Entity.
 *
 * @ORM\Entity(repositoryClass="DocRepository")
 * @ORM\Table(name="states")
 */


class States
{
  /**
   * @var  integer
   * @ORM\Id
   * @ORM\Column(type="integer", name="stateId")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=2)
     */
    protected $abbreviation;

    /**
     * @var string
     * @ORM\Column(type="string", length=25)
     */
    protected $state;

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
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     * @return $this
     */
    public function setAbbreviation(string $abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state)
    {
        $this->state = $state;
        return $this;
    }


}
