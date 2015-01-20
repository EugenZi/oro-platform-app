<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
use Oro\Bundle\ActivityBundle\Model\ExtendActivity;
use Oro\Bundle\TagBundle\Entity\Taggable;

/**
 * Bap\Bundle\IssueBundle\Entity\Issue
 *
 * @ORM\Entity(repositoryClass="Bap\Bundle\IssueBundle\Entity\Repository\IssueRepository")
 */
class Issue extends BaseIssue implements ActivityInterface, Taggable
{
    use ExtendActivity;

    const TABLE_NAME = 'bap_issue';

    public function __construct()
    {
        $this->issueCollaborators = new ArrayCollection();
        $this->issueCollabortators = new ArrayCollection();
        $this->issueRelationRelatedByIssueIds = new ArrayCollection();
        $this->issueRelationRelatedByRelatedIssueIds = new ArrayCollection();
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
     * Set the value of parent_id.
     *
     * @param integer $parent_id
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * Get the value of parent_id.
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set the value of reporter_id.
     *
     * @param integer $reporter_id
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setReporterId($reporter_id)
    {
        $this->reporter_id = $reporter_id;

        return $this;
    }

    /**
     * Get the value of reporter_id.
     *
     * @return integer
     */
    public function getReporterId()
    {
        return $this->reporter_id;
    }

    /**
     * Set the value of assignee_id.
     *
     * @param integer $assignee_id
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setAssigneeId($assignee_id)
    {
        $this->assignee_id = $assignee_id;

        return $this;
    }

    /**
     * Get the value of assignee_id.
     *
     * @return integer
     */
    public function getAssigneeId()
    {
        return $this->assignee_id;
    }

    /**
     * Set the value of tags_id.
     *
     * @param integer $tags_id
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setTagsId($tags_id)
    {
        $this->tags_id = $tags_id;

        return $this;
    }

    /**
     * Get the value of tags_id.
     *
     * @return integer
     */
    public function getTagsId()
    {
        return $this->tags_id;
    }

    /**
     * Set the value of code.
     *
     * @param string $code
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of status.
     *
     * @param string $status
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of type.
     *
     * @param string $type
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of summary.
     *
     * @param string $summary
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get the value of summary.
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set the value of description.
     *
     * @param string $description
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of priority.
     *
     * @param string $priority
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get the value of priority.
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set the value of resolution.
     *
     * @param string $resolution
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * Get the value of resolution.
     *
     * @return string
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set the value of created_at.
     *
     * @param datetime $created_at
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of created_at.
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of updated_at.
     *
     * @param datetime $updated_at
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of updated_at.
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add IssueCollaborator entity to collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueCollaborator $issueCollaborator
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function addIssueCollaborator(IssueCollaborator $issueCollaborator)
    {
        $this->issueCollaborators[] = $issueCollaborator;

        return $this;
    }

    /**
     * Remove IssueCollaborator entity from collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueCollaborator $issueCollaborator
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function removeIssueCollaborator(IssueCollaborator $issueCollaborator)
    {
        $this->issueCollaborators->removeElement($issueCollaborator);

        return $this;
    }

    /**
     * Get IssueCollaborator entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssueCollaborators()
    {
        return $this->issueCollaborators;
    }

    /**
     * Get IssueCollabortator entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssueCollabortators()
    {
        return $this->issueCollabortators;
    }

    /**
     * Add IssueRelation entity related by `issue_id` to collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueRelation $issueRelation
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function addIssueRelationRelatedByIssueId(IssueRelation $issueRelation)
    {
        $this->issueRelationRelatedByIssueIds[] = $issueRelation;

        return $this;
    }

    /**
     * Remove IssueRelation entity related by `issue_id` from collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueRelation $issueRelation
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function removeIssueRelationRelatedByIssueId(IssueRelation $issueRelation)
    {
        $this->issueRelationRelatedByIssueIds->removeElement($issueRelation);

        return $this;
    }

    /**
     * Get IssueRelation entity related by `issue_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssueRelationRelatedByIssueIds()
    {
        return $this->issueRelationRelatedByIssueIds;
    }

    /**
     * Add IssueRelation entity related by `related_issue_id` to collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueRelation $issueRelation
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function addIssueRelationRelatedByRelatedIssueId(IssueRelation $issueRelation)
    {
        $this->issueRelationRelatedByRelatedIssueIds[] = $issueRelation;

        return $this;
    }

    /**
     * Remove IssueRelation entity related by `related_issue_id` from collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueRelation $issueRelation
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function removeIssueRelationRelatedByRelatedIssueId(IssueRelation $issueRelation)
    {
        $this->issueRelationRelatedByRelatedIssueIds->removeElement($issueRelation);

        return $this;
    }

    /**
     * Get IssueRelation entity related by `related_issue_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssueRelationRelatedByRelatedIssueIds()
    {
        return $this->issueRelationRelatedByRelatedIssueIds;
    }

    /**
     * Set IssueType entity (many to one).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueType $issueType
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setIssueType(IssueType $issueType = null)
    {
        $this->issueType = $issueType;

        return $this;
    }

    /**
     * Get IssueType entity (many to one).
     *
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
     */
    public function getIssueType()
    {
        return $this->issueType;
    }

    /**
     * Set IssuePriority entity (many to one).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssuePriority $issuePriority
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setIssuePriority(IssuePriority $issuePriority = null)
    {
        $this->issuePriority = $issuePriority;

        return $this;
    }

    /**
     * Get IssuePriority entity (many to one).
     *
     * @return \Bap\Bundle\IssueBundle\Entity\IssuePriority
     */
    public function getIssuePriority()
    {
        return $this->issuePriority;
    }

    /**
     * Set IssueResolution entity (many to one).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\IssueResolution $issueResolution
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function setIssueRelsolution(IssueResolution $issueResolution = null)
    {
        $this->issueResolution = $issueResolution;

        return $this;
    }

    /**
     * Get IssueResolution entity (many to one).
     *
     * @return \Bap\Bundle\IssueBundle\Entity\IssueResolution
     */
    public function getIssueRelsolution()
    {
        return $this->issueResolution;
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

    /**
     * Returns the collection of tags for this Taggable entity
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTags()
    {
        // TODO: Implement getTags() method.
    }

    /**
     * Set tag collection
     *
     * @param $tags
     * @return $this
     */
    public function setTags($tags)
    {
        // TODO: Implement setTags() method.
    }

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