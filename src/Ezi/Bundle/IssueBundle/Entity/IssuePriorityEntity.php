<?php

namespace Ezi\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="ISSUE_PRIORITY_UNIQ_IDX", columns={"priority"})})
 */
class IssuePriorityEntity
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
    private $priority;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="priority")
     */
    private $issues;
}