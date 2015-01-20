<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bap\Bundle\IssueBundle\Entity\BaseIssue;

/**
 * Bap\Bundle\IssueBundle\Entity\Issue
 *
 * @ORM\Entity(repositoryClass="Bap\Bundle\IssueBundle\Entity\Repository\IssueRepository")
 */
class Issue extends BaseIssue
{
}