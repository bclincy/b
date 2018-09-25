<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/24/18
 * Time: 9:15 PM
 */

namespace App\repository;


class Podcast
{
    /** @var \PDO pdo  */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function select(array $data)
    {
        $max = isset($data['max']) ? $data['max'] : 50;
        $min = isset($data['min']) ? $data['min'] : 0;
        $stmt = $this->pdo->prepare('SELECT * FROM podcast LIMIT ?, ?');
        $stmt->execute([$min, $max]);
        $podcast = $records = $stmt->fetchAll()[0];

        return is_array($podcast) ? $podcast : [];

    }

}