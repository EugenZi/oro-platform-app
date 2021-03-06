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
    public function getIssuesByStatus()
    {
        $items  = $this->getCountIssuesByLabel();
        $result = [];

        while($item = array_pop($items)) {
            $key   = $item['label'];
            $count = $item['count_issues'];

            $result[$key] = [
                'count' => $count
            ];
        }

        return $result;
    }

    public function getCountIssuesByLabel()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select(['COUNT(issue.id) as count_issues', 'workflowStep.label'])
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