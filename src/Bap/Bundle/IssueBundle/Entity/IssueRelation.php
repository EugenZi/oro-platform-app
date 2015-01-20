<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bap\Bundle\IssueBundle\Entity\BaseIssueRelation;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueRelation
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueRelationRepository")
 */
class IssueRelation extends BaseIssueRelation
{
}