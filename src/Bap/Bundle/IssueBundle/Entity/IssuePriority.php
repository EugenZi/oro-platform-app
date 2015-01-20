<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bap\Bundle\IssueBundle\Entity\BaseIssuePriority;

/**
 * Bap\Bundle\IssueBundle\Entity\IssuePriority
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssuePriorityRepository")
 */
class IssuePriority extends BaseIssuePriority
{
}