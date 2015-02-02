<?php

namespace Bap\Bundle\IssueBundle\Entity\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;

/**
 * Class IssueRepository
 * @package Bap\Bundle\IssueBundle\Entity\Repository
 */
class IssueRepository extends EntityRepository
{
    public function getIssuesByStatus($status)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select(['COUNT(issue.id) as cnt', 'workflowStep.label'])
            ->from('OroWorkflowBundle:WorkflowStep', 'workflowStep')
            ->leftJoin('workflowStep.definition', 'definition')
            ->leftJoin(
                'BapIssueBundle:Issue',
                'issue',
                'WITH',
                'issue.workflowStep = workflowStep AND definition.name = :d_name'
            )
            ->andWhere('')
            ->groupBy('workflowStep.label')
            ->orderBy('cnt')
            ->setParameter('d_name', 'issue_flow');

        return $qb
            ->getQuery()
            ->getResult(
                AbstractQuery::HYDRATE_SIMPLEOBJECT
            );
    }
}