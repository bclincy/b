<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/3/18
 * Time: 7:58 AM
 */

namespace app\Content;


/**
 * Class Podcast
 * @package app\Content
 */
class Podcast
{
    /**
     * @var \PDO $pdo
     */
    private $pdo;
    /**
     * @var int $pid
     */
    private $pid;
    /**
     * @var array $notesId
     */
    private $notesId;

    private $page;

    /**
     * Podcast constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    private function displayPodcast ()
    {

    }

    private static function savePodcast (array $formData, \PDO $pdo)
    {


    }

    private function validateFrm (array $mustHaves)
    {

    }
}