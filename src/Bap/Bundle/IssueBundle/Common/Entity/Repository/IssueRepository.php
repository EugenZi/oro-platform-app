<?php

namespace Bap\Bundle\IssueBundle\Common\Entity\Repository;

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
            $key          = $item['label'];
            $count        = $item['count_issues'];
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
            ->groupBy('workflowStep.label')
            ->orderBy('count_issues')
            ->setParameter('d_name', 'issue_flow');

        return $qb
            ->getQuery()
            ->getArrayResult();
    }
}