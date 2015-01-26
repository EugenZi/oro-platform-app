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
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
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
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;
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
     */
    public function setReporter(User $reporter)
    {
        $this->reporter = $reporter;
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
     */
    public function setAssignee(User $assignee)
    {
        $this->assignee = $assignee;
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
     */
    public function setCollaborators($collaborators)
    {
        $this->collaborators = $collaborators;
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
     */
    public function setParent(Issue $parent)
    {
        $this->parent = $parent;
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
     */
    public function setChildren($children)
    {
        $this->children = $children;
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
     */
    public function setCode($code)
    {
        $this->code = $code;
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
     */
    public function setType(IssueType $type)
    {
        $this->type = $type;
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
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     */
    public function setPriority(IssuePriority $priority)
    {
        $this->priority = $priority;
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
     */
    public function setResolution(IssueResolution $resolution)
    {
        $this->resolution = $resolution;
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
     */
    public function setWorkflowItem(WorkflowItem $workflowItem)
    {
        $this->workflowItem = $workflowItem;
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
     */
    public function setWorkflowStep(WorkflowStep $workflowStep)
    {
        $this->workflowStep = $workflowStep;
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

    /**
     * Checks if an entity of the given type can be associated with this activity entity
     *
     * @param string $targetClass The class name of the target entity
     *
     * @return bool
     */
    public function supportActivityTarget($targetClass)
    {
        // TODO: Implement supportActivityTarget() method.
    }

    /**
     * Gets entities of the given type associated with this activity entity
     *
     * @param string $targetClass The class name of the target entity
     *
     * @return object[]
     */
    public function getActivityTargets($targetClass)
    {
        // TODO: Implement getActivityTargets() method.
    }

    /**
     * Checks is the given entity is associated with this activity entity
     *
     * @param object $target Any configurable entity that can be associated with this activity
     *
     * @return bool
     */
    public function hasActivityTarget($target)
    {
        // TODO: Implement hasActivityTarget() method.
    }

    /**
     * Associates the given entity with this activity entity
     *
     * @param object $target Any configurable entity that can be associated with this activity
     *
     * @return self This object
     */
    public function addActivityTarget($target)
    {
        // TODO: Implement addActivityTarget() method.
    }

    /**
     * Removes the association of the given entity with this activity entity
     *
     * @param object $target Any configurable entity that can be associated with this activity
     *
     * @return self This object
     */
    public function removeActivityTarget($target)
    {
        // TODO: Implement removeActivityTarget() method.
    }

    /**
     * Returns the unique taggable resource identifier
     *
     * @return string
     */
    public function getTaggableId()
    {
        // TODO: Implement getTaggableId() method.
    }
}
