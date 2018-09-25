<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/3/18
 * Time: 7:58 AM
 */

namespace App\Content;
use Doctrine\ORM\EntityManager;


/**
 * Class Podcast
 * @package app\Content
 */
class Podcast extends Model
{
    /**
     * @var EntityManager $pdo
     */
    private $em;
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
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function totalPodcast ()
    {
        $stmt = $this->em->getConnection()->prepare('SELECT count(id) FROM podcast');
        $stmt->execute();
        $result = $stmt->fetchColumn(0);

        return $result;
    }

    public function getByName (string $name): array
    {
        $name = '%' . $name . '%';
        $query = $this->em->prepare('SELECT * FROM podcast where title like :name');
        $query->execute([':name' => $name]);
        $results = $query->fetchAll();

        return $results[0];
    }
    public function displayPodcast ()
    {
        $stmt = $this->em->getConnection()->prepare('SELECT * FROM podcast ORDER BY id DESC');
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    private static function savePodcast (array $formData, \PDO $pdo)
    {


    }

    private function validateFrm (array $mustHaves)
    {

    }
}