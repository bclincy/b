<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 4/8/19
 * Time: 3:17 AM
 */

namespace App\Entity;

use App\Entity\Traits\TimeStamping;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Podcast
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PodcastRepository")
 * @ORM\Table(name="podcast")
 */
class Podcast
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
     * @var  string $title
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @var string $description
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string $link
     * @ORM\Column(type="string", length=255)
     */
    protected $link;

    /**
     * @var string $link
     * @ORM\Column(type="string", nullable=true, length=150)
     */
    protected $webmaster;

    /**
     * @var  string $language
     * @ORM\Column(type="string", length=255, options={"default":"english"})
     */
    protected $language;

    /**
     * @var string $imageUrl
     * @ORM\Column(type="string", name="image_url", length=200, options={"default":"http://brianclincy.com/images/nnuts-rss.jpg"})
     */
    protected $imageUrl;

    /**
     * @var \DateTime $lastBuildDate
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $lastBuildDate;


    /**
     * @var \DateTime $pubDate
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $pubDate;

    /**
     * @var string $guid
     * @ORM\Column(type="guid", length=36)
     */
    protected $guid;

    /**
     * @var string $media
     * @ORM\Column(type="string", length=255)
     */
    protected $media;

    /**
     * @var String $video
     * @ORM\Column(type="string", length=255)
     */
    protected $video;


    protected $notes;

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
     * @return Podcast
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Podcast
     */
    public function setDescription(string $description): self
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
     * @return Podcast
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Podcast
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastBuildDate(): \DateTime
    {
        return $this->lastBuildDate;
    }

    /**
     * @param \DateTime $lastBuildDate
     * @return Podcast
     */
    public function setLastBuildDate(\DateTime $lastBuildDate): self
    {
        $this->lastBuildDate = $lastBuildDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPubDate(): \DateTime
    {
        return $this->pubDate;
    }

    /**
     * @param \DateTime $pubDate
     * @return Podcast
     */
    public function setPubDate(\DateTime $pubDate): self
    {
        $this->pubDate = $pubDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebmaster(): string
    {
        return $this->webmaster;
    }

    /**
     * @param string $webmaster
     * @return Podcast
     */
    public function setWebmaster(string $webmaster): self
    {
        $this->webmaster = $webmaster;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return Podcast
     */
    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotes(): ?PodcastNote
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     * @return Podcast
     */
    public function setNotes(PodcastNote $notes): self
    {
        $this->notes = $notes;

        return $this;
    }



    /**
     * @return GUID
     */
    public function getGuid(): GUID
    {
        return $this->guid;
    }

    /**
     * @param GUID $guid
     * @return Podcast
     */
    public function setGuid(GUID $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * @return string
     */
    public function getMedia(): string
    {
        return $this->media;
    }

    /**
     * @param string $media
     * @return Podcast
     */
    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return String
     */
    public function getVideo(): String
    {
        return $this->video;
    }

    /**
     * @param String $video
     * @return Podcast
     */
    public function setVideo(String $video):self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }




}