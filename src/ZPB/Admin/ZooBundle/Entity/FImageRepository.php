<?php

namespace ZPB\Admin\ZooBundle\Entity;


use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * FImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FImageRepository extends SortableRepository
{
    public function findAllAlphaOrdered()
    {
        $qb = $this->createQueryBuilder('i')->orderBy('i.name', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function countImages()
    {
        return $this->createQueryBuilder('i')->select('COUNT(i)')->getQuery()->getSingleScalarResult();
    }
}