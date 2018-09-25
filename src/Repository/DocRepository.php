<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use App\Entity\Docs;
use Doctrine\ORM\EntityManagerInterface;
/**
* DocRepository
*
*/
class DocRepository extends EntityRepository
{

    /** @var  EntityManager */
    private $em;

    /**
     * DocRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, Docs::class);
    }

    public function newDocs (
        string $title,
        string $keywords,
        string $description,
        string $content,
        string $docType,
        int $active,
        string $docName)
    {
        $docs = new Docs();
        $docs->setTitle($title)
            ->setKeywords($keywords)
            ->setDescription($description)
            ->setContent($content)
            ->setDocType($docType)
            ->setActive($active)
            ->setDocName($docName);
        $this->em->presist($docs);
        $this->em->flush();
    }
}