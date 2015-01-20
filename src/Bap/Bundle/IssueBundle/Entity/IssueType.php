<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueType
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueTypeRepository")
 */
class IssueType extends BaseIssueType
{
    const TABLE_NAME = 'bap_issue_type';

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
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
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
     * Add Issue entity to collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
     */
    public function addIssue(Issue $issue)
    {
        $this->issues[] = $issue;

        return $this;
    }

    /**
     * Remove Issue entity from collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
     */
    public function removeIssue(Issue $issue)
    {
        $this->issues->removeElement($issue);

        return $this;
    }

    /**
     * Get Issue entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssues()
    {
        return $this->issues;
    }

    public function __sleep()
    {
        return array('id', 'value');
    }
}