<?php

namespace Bap\Bundle\IssueBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class IssueRepository
 * @package Bap\Bundle\IssueBundle\Entity\Repository
 */
class IssueRepository extends  EntityRepository
{
    public function getIssuesByStatus()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

    }
}