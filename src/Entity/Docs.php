<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/8/18
 * Time: 2:43 PM
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * The docs class simple Doctrine Entity.
 *
 * @ORM\Entity(repositoryClass="DocRepository")
 * @ORM\Table(name="docs")
 */

class Docs
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $keywords;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="active")
     */
    private $isActive;

    /**
     * @var  string
     * @ORM\Column(type="string", length=25)
     */
    private $docType;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $docName;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $category;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     */
    public function setKeywords(string $keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocType(): string
    {
        return $this->docType;
    }

    /**
     * @param string $docType
     * @return $this
     */
    public function setDocType(string $docType)
    {
        $this->docType = $docType;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocName(): string
    {
        return $this->docName;
    }

    /**
     * @param string $docName
     * @return $this
     */
    public function setDocName(string $docName)
    {
        $this->docName = $docName;

        return $this;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     * @return $this
     */
    public function setCategory(int $category)
    {
        $this->category = $category;

        return $this;
    }

}