<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 4/11/19
 * Time: 9:43 AM
 */

namespace App\Entity;

use App\Entity\Traits\TimeStamping;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PodcastNote
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PodcastNoteRepository")
 * @ORM\Table(name="podcast_notes")
 */
class PodcastNote
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
     * @var string $noteName
     * @ORM\Column(type="string", length=255)
     */
    protected $noteName;

    /**
     * @var String $description
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string $link
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $link;

    /**
     * @var string $linkText
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $linkText;

    /**
     * @var string $tags
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $tags;
    /**
     * @var Podcast $podcast
     * @ORM\ManyToOne(targetEntity="Podcast")
     * @ORM\JoinColumn(name="podcast_id", referencedColumnName="id")
     */
    protected $podcast;

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
    public function getNoteName(): string
    {
        return $this->noteName;
    }

    /**
     * @param string $noteName
     * @return PodcastNote
     */
    public function setNoteName(string $noteName): self
    {
        $this->noteName = $noteName;

        return $this;
    }

    /**
     * @return String
     */
    public function getDescription(): String
    {
        return $this->description;
    }

    /**
     * @param String $description
     * @return PodcastNote
     */
    public function setDescription(String $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return PodcastNote
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinkText(): string
    {
        return $this->linkText;
    }

    /**
     * @param string $linkText
     * @return PodcastNote
     */
    public function setLinkText(string $linkText): self
    {
        $this->linkText = $linkText;

        return $this;
    }

    /**
     * @return string
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     * @return PodcastNote
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return Podcast
     */
    public function getPodcast(): Podcast
    {
        return $this->podcast;
    }

    /**
     * @param Podcast $podcast
     * @return PodcastNote
     */
    public function setPodcast(Podcast $podcast): self
    {
        $this->podcast = $podcast;

        return $this;
    }


}