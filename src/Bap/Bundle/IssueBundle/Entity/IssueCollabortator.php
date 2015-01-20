<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bap\Bundle\IssueBundle\Entity\BaseIssueCollabortator;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueCollabortator
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueCollabortatorRepository")
 */
class IssueCollabortator extends BaseIssueCollabortator
{
}