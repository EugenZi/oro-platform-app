<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssuePriority
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssuePriorityRepository")
 * @ORM\Table(
 *      name="bap_issue_priority",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="value_UNIQUE",
 *              columns={"`value`"}
 *          )
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
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the value of value.
     *
     * @param string $value
     * @return IssuePriority
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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
        return ['id', 'value'];
    }
}