<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\IssuePriority
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssuePriorityRepository")
 */
class IssuePriority extends BaseIssuePriority
{
    /**
     * Issue table real name
     */
    const TABLE_NAME = 'bap_issue_priority';

    /**
    public function __construct()
    {
        $this->issues = new ArrayCollection();
    }

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
     * Set the value of value.
     *
     * @param string $value
     * @return \Bap\Bundle\IssueBundle\Entity\IssuePriority
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
     * Get the value of value.
     *
     * @return string
     */
    public function __sleep()
    {
        return ['id', 'value'];
    }
}