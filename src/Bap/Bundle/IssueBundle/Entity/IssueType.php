<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bap\Bundle\IssueBundle\Entity\BaseIssueType;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueType
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueTypeRepository")
 */
class IssueType extends BaseIssueType
{
}