<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
use Oro\Bundle\ActivityBundle\Model\ExtendActivity;
use Oro\Bundle\TagBundle\Entity\Taggable;

use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;

use Oro\Bundle\WorkflowBundle\Entity\WorkflowItem;
use Oro\Bundle\WorkflowBundle\Entity\WorkflowStep;

/**
 * @ORM\Entity(repositoryClass="Bap\Bundle\IssueBundle\Entity\Repository\IssueRepository")
 *
 * @package Bap\IssueBundle\Entity
 */
class Issue extends BaseIssue implements ActivityInterface, Taggable
{
    use ExtendActivity;

    /**
     * Issue table real name
     */
    const TABLE_NAME              = 'bap_issue';

    /**
     * Issues to users intermediate table name
     */
    const COLLABORATOR_TABLE_NAME = 'bap_issue_collaborator';

    /**
     * Workflow issue status
     */
    const STATUS_OPEN        = 'open';

    /**
     * Workflow issue status
     */
    const STATUS_IN_PROGRESS = 'in_progress';

    /**
     * Workflow issue status
     */
    const STATUS_CLOSED      = 'closed';

    /**
     * Workflow issue status
     */
    const STATUS_RESOLVED    = 'resolved';

    /**
     * Workflow issue status
     */
    const STATUS_REOPENED    = 'reopened';

    /**
     * Issue constructor
     */
    public function __construct()
    {
        $this->tags          = new ArrayCollection();
        $this->collaborators = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param $owner
     * @return Issue
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param Organization $organization
     * @return Issue
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * @return User
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @param User $reporter
     * @return Issue
     */
    public function setReporter(User $reporter)
    {
        $this->reporter = $reporter;

        return $this;
    }

    /**
     * @return User
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @param User $assignee
     * @return Issue
     */
    public function setAssignee(User $assignee)
    {
        $this->assignee = $assignee;

        return $this;
    }

    /**
     * Add collaborators
     *
     * @param User $collaborators
     * @return Issue
     */
    public function pushCollaborator(User $collaborators)
    {
        $this->collaborators[] = $collaborators;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCollaborators()
    {
        return $this->collaborators;
    }

    /**
     * @param ArrayCollection $collaborators
     *
     * @return Issue
     */
    public function setCollaborators(ArrayCollection $collaborators)
    {
        $this->collaborators = $collaborators;

        return $this;
    }

    /**
     * @return Issue
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Issue $parent
     * @return Issue
     */
    public function setParent(Issue $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     *
     * @return Issue
     */
    public function setChildren(ArrayCollection $children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Issue
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return IssueType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Issue
     */
    public function setType(IssueType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return Issue
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Issue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return IssuePriority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param IssuePriority $priority
     * @return Issue
     */
    public function setPriority(IssuePriority $priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return IssueResolution
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @param IssueResolution $resolution
     * @return Issue
     */
    public function setResolution(IssueResolution $resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * @return WorkflowItem
     */
    public function getWorkflowItem()
    {
        return $this->workflowItem;
    }

    /**
     * @param WorkflowItem $workflowItem
     * @return Issue
     */
    public function setWorkflowItem(WorkflowItem $workflowItem)
    {
        $this->workflowItem = $workflowItem;

        return $this;
    }

    /**
     * @return WorkflowStep
     */
    public function getWorkflowStep()
    {
        return $this->workflowStep;
    }

    /**
     * @param WorkflowStep $workflowStep
     * @return Issue
     */
    public function setWorkflowStep(WorkflowStep $workflowStep)
    {
        $this->workflowStep = $workflowStep;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     * @return Issue
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Returns the unique taggable resource identifier
     *
     * @return int
     */
    public function getTaggableId()
    {
        return $this->getId();
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updatedAt;
    }

    /**
     * Fields that was contain in serialized object
     *
     * @return array
     */
    public function __sleep()
    {
        return [
            'id',
            'parent_id',
            'reporter_id',
            'assignee_id',
            'tags_id',
            'code',
            'status',
            'type',
            'summary',
            'description',
            'priority',
            'resolution',
            'created_at',
            'updated_at'
        ];
    }
}
