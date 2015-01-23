<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueType
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueTypeRepository")
 */
class IssueType extends BaseIssueType
{
    /**
     * Issue type table real name
     */
    const TABLE_NAME    = 'bap_issue_type';

    /**
     * Issue type task
     */
    const TASK_TYPE     = 'task';

    /**
     * Issue type story
     */
    const STORY_TYPE    = 'story';

    /**
     * Issue type sub-task
     */
    const SUB_TASK_TYPE = 'sub_task';

    /**
     * Issue type bug
     */
    const BUG_TYPE      = 'bug';

    /**
     * Base issue type constructor
     */
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
     * @param string $name
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
     */
    public function setValue($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * Return fields used to serialization
     *
     * @return array
     */
    public function __sleep()
    {
        return ['id', 'value'];
    }
}