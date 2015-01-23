<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.5-dev (doctrine2-annotation) on 2015-01-15 07:55:10.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Ezi\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ezi\Bundle\IssueBundle\Entity\EziIssue
 *
 * @ORM\Entity(repositoryClass="EntityRepository\EziIssueRepository")
 * @ORM\Table(name="ezi_issue", indexes={@ORM\Index(name="index2", columns={"summary"}), @ORM\Index(name="index3", columns={"code"}), @ORM\Index(name="index4", columns={"`status`"}), @ORM\Index(name="index5", columns={"description"}), @ORM\Index(name="index6", columns={"tags"}), @ORM\Index(name="index7", columns={"notes"}), @ORM\Index(name="index8", columns={"priority"}), @ORM\Index(name="index9", columns={"resolution"}), @ORM\Index(name="index10", columns={"reporter_id"}), @ORM\Index(name="index11", columns={"assignee_id"}), @ORM\Index(name="index12", columns={"collaborators"}), @ORM\Index(name="index13", columns={"parent_id"}), @ORM\Index(name="index15", columns={"related_issues_id"}), @ORM\Index(name="index16", columns={"workflow_item_id"}), @ORM\Index(name="index17", columns={"workflow_step_id"}), @ORM\Index(name="fk_ezi_issue_2_idx", columns={"`type`"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseEziIssue", "extended"="EziIssue"})
 */
class BaseEziIssue
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $code;

    /**
     * @ORM\Column(name="`status`", type="string", length=32)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $tags;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $notes;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $priority;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $resolution;

    /**
     * @ORM\Column(type="integer")
     */
    protected $reporter_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $assignee_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $collaborators;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $parent_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $related_issues_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $workflow_item_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $workflow_step_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\Column(name="`type`", type="string", length=32)
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="EziIssueCollaborator", mappedBy="eziIssue")
     * @ORM\JoinColumn(name="id", referencedColumnName="issue_id")
     */
    protected $eziIssueCollaborators;

    /**
     * @ORM\OneToMany(targetEntity="EziIssueRelation", mappedBy="eziIssueRelatedByLinkedIssueId")
     * @ORM\JoinColumn(name="id", referencedColumnName="linked_issue_id")
     */
    protected $eziIssueRelationRelatedByLinkedIssueIds;

    /**
     * @ORM\OneToMany(targetEntity="EziIssueRelation", mappedBy="eziIssueRelatedByIssueId")
     * @ORM\JoinColumn(name="id", referencedColumnName="issue_id")
     */
    protected $eziIssueRelationRelatedByIssueIds;

    /**
     * @ORM\ManyToOne(targetEntity="EziIssuePriority", inversedBy="eziIssues")
     * @ORM\JoinColumn(name="priority", referencedColumnName="`name`")
     */
    protected $eziIssuePriority;

    /**
     * @ORM\ManyToOne(targetEntity="EziIssueResolution", inversedBy="eziIssues")
     * @ORM\JoinColumn(name="resolution", referencedColumnName="`name`")
     */
    protected $eziIssueResolution;

    /**
     * @ORM\ManyToOne(targetEntity="EziIssueType", inversedBy="eziIssues")
     * @ORM\JoinColumn(name="`type`", referencedColumnName="`name`")
     */
    protected $eziIssueType;

    public function __construct()
    {
        $this->eziIssueCollaborators = new ArrayCollection();
        $this->eziIssueRelationRelatedByLinkedIssueIds = new ArrayCollection();
        $this->eziIssueRelationRelatedByIssueIds = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set the value of summary.
     *
     * @param string $summary
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of code.
     *
     * @param string $code
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of description.
     *
     * @param string $description
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of tags.
     *
     * @param string $tags
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get the value of tags.
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of notes.
     *
     * @param string $notes
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get the value of notes.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set the value of priority.
     *
     * @param string $priority
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of reporter_id.
     *
     * @param integer $reporter_id
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of collaborators.
     *
     * @param integer $collaborators
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setCollaborators($collaborators)
    {
        $this->collaborators = $collaborators;

        return $this;
    }

    /**
     * Get the value of collaborators.
     *
     * @return integer
     */
    public function getCollaborators()
    {
        return $this->collaborators;
    }

    /**
     * Set the value of parent_id.
     *
     * @param integer $parent_id
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of related_issues_id.
     *
     * @param integer $related_issues_id
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setRelatedIssuesId($related_issues_id)
    {
        $this->related_issues_id = $related_issues_id;

        return $this;
    }

    /**
     * Get the value of related_issues_id.
     *
     * @return integer
     */
    public function getRelatedIssuesId()
    {
        return $this->related_issues_id;
    }

    /**
     * Set the value of workflow_item_id.
     *
     * @param integer $workflow_item_id
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setWorkflowItemId($workflow_item_id)
    {
        $this->workflow_item_id = $workflow_item_id;

        return $this;
    }

    /**
     * Get the value of workflow_item_id.
     *
     * @return integer
     */
    public function getWorkflowItemId()
    {
        return $this->workflow_item_id;
    }

    /**
     * Set the value of workflow_step_id.
     *
     * @param integer $workflow_step_id
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setWorkflowStepId($workflow_step_id)
    {
        $this->workflow_step_id = $workflow_step_id;

        return $this;
    }

    /**
     * Get the value of workflow_step_id.
     *
     * @return integer
     */
    public function getWorkflowStepId()
    {
        return $this->workflow_step_id;
    }

    /**
     * Set the value of created_at.
     *
     * @param datetime $created_at
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Set the value of type.
     *
     * @param string $type
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
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
     * Add EziIssueCollaborator entity to collection (one to many).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueCollaborator $eziIssueCollaborator
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function addEziIssueCollaborator(EziIssueCollaborator $eziIssueCollaborator)
    {
        $this->eziIssueCollaborators[] = $eziIssueCollaborator;

        return $this;
    }

    /**
     * Remove EziIssueCollaborator entity from collection (one to many).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueCollaborator $eziIssueCollaborator
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function removeEziIssueCollaborator(EziIssueCollaborator $eziIssueCollaborator)
    {
        $this->eziIssueCollaborators->removeElement($eziIssueCollaborator);

        return $this;
    }

    /**
     * Get EziIssueCollaborator entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEziIssueCollaborators()
    {
        return $this->eziIssueCollaborators;
    }

    /**
     * Add EziIssueRelation entity related by `linked_issue_id` to collection (one to many).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueRelation $eziIssueRelation
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function addEziIssueRelationRelatedByLinkedIssueId(EziIssueRelation $eziIssueRelation)
    {
        $this->eziIssueRelationRelatedByLinkedIssueIds[] = $eziIssueRelation;

        return $this;
    }

    /**
     * Remove EziIssueRelation entity related by `linked_issue_id` from collection (one to many).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueRelation $eziIssueRelation
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function removeEziIssueRelationRelatedByLinkedIssueId(EziIssueRelation $eziIssueRelation)
    {
        $this->eziIssueRelationRelatedByLinkedIssueIds->removeElement($eziIssueRelation);

        return $this;
    }

    /**
     * Get EziIssueRelation entity related by `linked_issue_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEziIssueRelationRelatedByLinkedIssueIds()
    {
        return $this->eziIssueRelationRelatedByLinkedIssueIds;
    }

    /**
     * Add EziIssueRelation entity related by `issue_id` to collection (one to many).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueRelation $eziIssueRelation
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function addEziIssueRelationRelatedByIssueId(EziIssueRelation $eziIssueRelation)
    {
        $this->eziIssueRelationRelatedByIssueIds[] = $eziIssueRelation;

        return $this;
    }

    /**
     * Remove EziIssueRelation entity related by `issue_id` from collection (one to many).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueRelation $eziIssueRelation
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function removeEziIssueRelationRelatedByIssueId(EziIssueRelation $eziIssueRelation)
    {
        $this->eziIssueRelationRelatedByIssueIds->removeElement($eziIssueRelation);

        return $this;
    }

    /**
     * Get EziIssueRelation entity related by `issue_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEziIssueRelationRelatedByIssueIds()
    {
        return $this->eziIssueRelationRelatedByIssueIds;
    }

    /**
     * Set EziIssuePriority entity (many to one).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssuePriority $eziIssuePriority
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setEziIssuePriority(EziIssuePriority $eziIssuePriority = null)
    {
        $this->eziIssuePriority = $eziIssuePriority;

        return $this;
    }

    /**
     * Get EziIssuePriority entity (many to one).
     *
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssuePriority
     */
    public function getEziIssuePriority()
    {
        return $this->eziIssuePriority;
    }

    /**
     * Set EziIssueResolution entity (many to one).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueResolution $eziIssueResolution
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setEziIssueResolution(EziIssueResolution $eziIssueResolution = null)
    {
        $this->eziIssueResolution = $eziIssueResolution;

        return $this;
    }

    /**
     * Get EziIssueResolution entity (many to one).
     *
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssueResolution
     */
    public function getEziIssueResolution()
    {
        return $this->eziIssueResolution;
    }

    /**
     * Set EziIssueType entity (many to one).
     *
     * @param \Ezi\Bundle\IssueBundle\Entity\EziIssueType $eziIssueType
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssue
     */
    public function setEziIssueType(EziIssueType $eziIssueType = null)
    {
        $this->eziIssueType = $eziIssueType;

        return $this;
    }

    /**
     * Get EziIssueType entity (many to one).
     *
     * @return \Ezi\Bundle\IssueBundle\Entity\EziIssueType
     */
    public function getEziIssueType()
    {
        return $this->eziIssueType;
    }

    public function __sleep()
    {
        return array('id', 'summary', 'code', 'status', 'description', 'tags', 'notes', 'priority', 'resolution', 'reporter_id', 'assignee_id', 'collaborators', 'parent_id', 'related_issues_id', 'workflow_item_id', 'workflow_step_id', 'created_at', 'updated_at', 'type');
    }
}