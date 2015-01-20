<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bap\Bundle\IssueBundle\Entity\BaseIssueResolution;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueResolution
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueResolutionRepository")
 */
class IssueResolution extends BaseIssueResolution
{
}