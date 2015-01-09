<?php

namespace Ezi\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

use Ezi\Bundle\IssueBundle\Entity\IssueTypeEntity;
use Ezi\Bundle\IssueBundle\Entity\IssuePriorityEntity;
use Ezi\Bundle\IssueBundle\Entity\IssueResolutionEntity;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="EZI_ISSUE_SUMMARY_IDX", columns={"summary"}),
 *         @ORM\Index(name="EZI_ISSUE_CODE_IDX", columns={"code"}),
 *         @ORM\Index(name="EZI_ISSUE_DESCRIPTION_IDX", columns={"descripton"}),
 *         @ORM\Index(name="EZI_ISSUE_STATUS_IDX", columns={"status"}),
 *         @ORM\Index(name="EZI_ISSUE_REPORTER_ID_IDX", columns={"reporter_id"}),
 *         @ORM\Index(name="EZI_ISSUE_ASSIGNEE_ID_IDX", columns={"assignee_id"}),
 *         @ORM\Index(name="EZI_ISSUE_RELATED_ISSUES_ID_IDX", columns={"related_issues_id"}),
 *         @ORM\Index(name="EZI_ISSUE_COLLABORATORS_ID_IDX", columns={"collaborators"}),
 *         @ORM\Index(name="EZI_ISSUE_ISSUE_PARENT_ID_IDX", columns={"parent_id"}),
 *         @ORM\Index(name="EZI_ISSUE_CHILDREN_ID_IDX", columns={"child_id"}),
 *         @ORM\Index(name="EZI_ISSUE_WORKFLOW_STEP_ID_IDX", columns={"workflow_step_id"}),
 *         @ORM\Index(name="EZI_ISSUE_NOTES_IDX", columns={"notes"})
 *     }
 * )
 */
class Issue
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripton;

    /**
     * @var IssueTypeEntity
     *
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="IssueTypeEntity", inversedBy="issues")
     */
    private $type;

    /**
     * @var IssuePriorityEntity
     *
     * @ORM\ManyToOne(targetEntity="IssuePriorityEntity", inversedBy="issues")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    private $priority;

    /**
     * @var IssueResolutionEntity
     * 
     * @ORM\JoinColumn(name="resolution_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="IssueResolutionEntity", inversedBy="issues")
     */
    private $resolution;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $tags;

    /**
     * @ORM\Column(type="integer", length=32, nullable=false)
     */
    private $reporter_id;

    /**
     * @ORM\Column(type="integer", length=32, nullable=false)
     */
    private $assignee_id;

    /**
     * @ORM\Column(type="integer", length=32, nullable=true)
     */
    private $related_issues_id;

    /**
     * @ORM\Column(type="integer", length=32, nullable=true)
     */
    private $collaborators;

    /**
     * @ORM\Column(type="integer", length=32, nullable=true)
     */
    private $parent_id;

    /**
     * @ORM\Column(type="integer", length=32, nullable=true)
     */
    private $child_id;

    /**
     * @ORM\Column(type="integer", length=32, nullable=false)
     */
    private $workflow_item_id;

    /**
     * @ORM\Column(type="integer", length=32, nullable=false)
     */
    private $workflow_step_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updated_at;
}