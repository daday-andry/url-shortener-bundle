<?php

namespace Daday\UrlShortenerBundle\Repository;

use Daday\UrlShortenerBundle\Entity\Url;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Url>
 */
class UrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Url::class);
    }

    public function save(Url $url)
    {
        $this->getEntityManager()->persist($url);
        $this->getEntityManager()->flush();
        return $url;
    }
}
