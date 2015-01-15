<?php

namespace Ezi\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="ISSUE_TYPE_UNIQ_IDX", columns={"type"})})
 */
class IssueTypeEntity
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="type")
     */
    private $issues;
}