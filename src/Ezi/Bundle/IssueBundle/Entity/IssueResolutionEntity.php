<?php

namespace Ezi\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="ISSUE_RESOLUTION_UNIQ_IDX", columns={"resolution"})})
 */
class IssueResolutionEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $resolution;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="resolution")
     */
    private $issues;
}