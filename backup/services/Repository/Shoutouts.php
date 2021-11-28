<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/24/18
 * Time: 4:31 AM
 */

namespace App\Repository;


/**
 * Class Shoutouts
 * @package app\Content
 */
/**
 * Class Shoutouts
 * @package app\Content
 */
class Shoutouts
{

    /** @var \PDO */
    private $pdo;
    /**
     * @var
     */
    private $status;

    /**
     * Shoutouts constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * @param array $data
     * @return bool|string
     */
    public function Add(array $data)
    {
        $sql = 'INSERT INTO Shoutouts (name, shoutout, website, slugs, created, location) VALUE
                 (:name, :shoutout, :website, :slugs, now(), :location)';
        $stmt = $this->pdo->prepare($sql);
        array_walk($data,function ($a, $b) use (&$stmt){
           if ($a === '' || $a === null){
               $stmt->bindValue($b, NULL, \PDO::PARAM_NULL);
           } else {
               $stmt->bindValue($b, $a);
           }
        });
        $stmt->execute();
        $id = $this->pdo->lastInsertId();

        return isset($id) && $id !== null ? $id : false;
    }


    /**
     * @param array $data
     * @return array
     */
    public function select(array $data = [])
    {
        $max = isset($data['max']) ? $data['max'] : 50;
        $min = isset($data['min']) ? $data['min'] : 0;
        $stmt = $this->pdo->prepare('SELECT * FROM Shoutouts LIMIT ?, ?');
        $stmt->bindParam(1, $min, \PDO::PARAM_INT);
        $stmt->bindParam(2, $max, \PDO::PARAM_INT);
        $stmt->execute();
        $shoutouts = $records = $stmt->fetchAll()[0];

        return is_array($shoutouts) ? $shoutouts : [];

    }

}