<?php

namespace App\Repo;

use Doctrine\ORM\EntityRepository;
use App\Entity\Docs;

/**
* DocRepository
*
*/
class DocsRepository extends EntityRepository
{

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