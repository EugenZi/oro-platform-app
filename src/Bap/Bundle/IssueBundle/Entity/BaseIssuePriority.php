<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssuePriority
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssuePriorityRepository")
 * @ORM\Table(name="bap_issue_priority", uniqueConstraints={@ORM\UniqueConstraint(name="value_UNIQUE", columns={"`value`"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssuePriority", "extended"="IssuePriority"})
 */
abstract class BaseIssuePriority
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="`value`", type="string", length=45)
     */
    protected $value;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="issuePriority")
     * @ORM\JoinColumn(name="`value`", referencedColumnName="priority")
     */
    protected $issues;
}