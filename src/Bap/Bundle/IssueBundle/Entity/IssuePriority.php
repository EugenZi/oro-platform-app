<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssuePriority
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssuePriorityRepository")
 * @ORM\Table(
 *      name="bap_issue_priority",
 *      indexes={
 *          @ORM\Index(name="BAP_ISSUE_PRIORITY_PRIORITY_FIELD_IDX", columns={"priority"})
 *      },
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="BAP_ISSUE_PRIORITY_NAME_FIELD_UNIQUE_IDX", columns={"value"})
 *      }
 * )
 */
class IssuePriority
{
    /**
     * Issue table real name
     */
    const TABLE_NAME = 'bap_issue_priority';

    /**
     * Issue priority Blocker
     */
    const BLOCKER  = 'Blocker';

    /**
     * Issue priority Bug
     */
    const BUG      = 'Bug';

    /**
     * Issue priority Critical
     */
    const CRITICAL = 'Critical';

    /**
     * Issue priority Major
     */
    const MAJOR    = 'Major';

    /**
     * Issue priority Minor
     */
    const MINOR    = 'Minor';

    /**
     * Issue priority Trivial
     */
    const TRIVIAL  = 'Trivial';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return IssuePriority
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return IssuePriority
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the value of value.
     *
     * @return string
     */
    public function __sleep()
    {
        return ['id', 'name', 'value'];
    }
}