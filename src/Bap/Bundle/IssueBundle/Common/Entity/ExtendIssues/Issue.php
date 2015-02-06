<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 2/6/15
 * Time: 6:59 AM
 */

namespace Bap\Bundle\IssueBundle\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
use Oro\Bundle\ActivityBundle\Model\ExtendActivity;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationInterface;
use Oro\Bundle\TagBundle\Entity\Taggable;

use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;

use Oro\Bundle\WorkflowBundle\Entity\WorkflowItem;
use Oro\Bundle\WorkflowBundle\Entity\WorkflowStep;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Bap\Bundle\IssueBundle\Entity\Issue
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 *
 * @ORM\Entity(repositoryClass="Bap\Bundle\IssueBundle\Entity\Repository\IssueRepository")
 * @ORM\Table(
 *      name="bap_issue",
 *      indexes={
 *          @ORM\Index(name="BAP_ISSUE_SUMMARY_INDEX", columns={"summary"}),
 *          @ORM\Index(name="BAP_ISSUE_CODE_INDEX", columns={"code"}),
 *          @ORM\Index(name="BAP_ISSUE_DESCRIPTION_INDEX", columns={"description"}),
 *          @ORM\Index(name="BAP_ISSUE_STATUS_INDEX", columns={"type_id"}),
 *          @ORM\Index(name="BAP_ISSUE_ASSIGNEE_ID_INDEX", columns={"priority_id"}),
 *          @ORM\Index(name="BAP_ISSUE_COLLABORATORS_ID_INDEX", columns={"reporter_id"}),
 *          @ORM\Index(name="BAP_ISSUE_ISSUE_PARENT_ID_INDEX", columns={"parent_id"}),
 *          @ORM\Index(name="BAP_ISSUE_CHILDREN_ID_INDEX", columns={"resolution_id"}),
 *          @ORM\Index(name="BAP_ISSUE_WORKFLOW_STEP_ID_INDEX", columns={"assignee_id"}),
 *      }
 * )
 *
 * @ORM\HasLifecycleCallbacks()
 *
 * @Config(
 *      routeName="bap_issues",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-envelope"
 *          },
 *          "dataaudit"={
 *              "auditable"=true
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "permissions"="All",
 *              "group_name"=""
 *          },
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="user_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "workflow"={
 *              "active_workflow"="issue"
 *          }
 *      }
 * )
 *
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({
 *      "issue"    = "Issue",
 *      "story"    = "Story",
 *      "subTask"  = "SubTask",
 *      "task"     = "Task",
 *      "bug"      = "Bug",
 *      "blocker"  = "Blocker",
 * })
 *
 * @package Bap\Bundle\IssueBundle\Common\Entity
 */
class Issue implements ActivityInterface, Taggable, IssueEntityInterface
{
    use ExtendActivity;

    /**
     * Issue table real name
     */
    const TABLE_NAME        = 'bap_issue';

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
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=10
     *          }
     *      }
     * )
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(
     *      name="owner_id",
     *      referencedColumnName="id",
     *      onDelete="SET NULL"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=10
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $owner;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(
     *      targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization",
     *      inversedBy="businessUnits"
     * )
     * @ORM\JoinColumn(
     *      name="organization_id",
     *      referencedColumnName="id",
     *      onDelete="SET NULL"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=30
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $organization;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(
     *      name="reporter_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=100,
     *              "short"=true
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $reporter;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(
     *      name="assignee_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=10,
     *              "short"=true
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $assignee;

    /**
     * @var ArrayCollection $collaborators
     *
     * @ORM\ManyToMany(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinTable(name="bap_issue_collaborator")
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    protected $collaborators;

    /**
     * @var Issue $parent
     *
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="children")
     * @ORM\JoinColumn(
     *      name="parent_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $parent;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity="Issue",
     *      mappedBy="parent",
     *      cascade={"remove"},
     *      orphanRemoval=true
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    protected $children;

    /**
     * @var string $code
     *
     * @ORM\Column(type="string", length=16)
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=40
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=70,
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $type = self::ISSUE;

    /**
     * @var string $summary
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=50
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $summary;

    /**
     * @var string $description
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=60
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $description;

    /**
     * @var IssuePriority
     *
     * @ORM\ManyToOne(targetEntity="IssuePriority")
     * @ORM\JoinColumn(
     *      name="priority_id",
     *      referencedColumnName="id",
     *      nullable=false
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=90,
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $priority;

    /**
     * @var IssueResolution
     *
     * @ORM\ManyToOne(targetEntity="IssueResolution")
     * @ORM\JoinColumn(
     *      name="resolution_id",
     *      referencedColumnName="id"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=80,
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $resolution;

    /**
     * @var WorkflowItem
     *
     * @ORM\OneToOne(targetEntity="Oro\Bundle\WorkflowBundle\Entity\WorkflowItem")
     * @ORM\JoinColumn(
     *      name="workflow_item_id",
     *      referencedColumnName="id",
     *      onDelete="SET NULL"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    protected $workflowItem;

    /**
     * @var WorkflowStep
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\WorkflowBundle\Entity\WorkflowStep")
     * @ORM\JoinColumn(
     *      name="workflow_step_id",
     *      referencedColumnName="id",
     *      onDelete="SET NULL"
     * )
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    protected $workflowStep;

    /**
     * @var ArrayCollection
     */
    protected $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     *
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     *
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

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
     * @return AbstractIssue
     */
    public function setOwner(User $owner = null)
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
     * @param OrganizationInterface $organization
     * @return AbstractIssue
     */
    public function setOrganization(OrganizationInterface $organization = null)
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
     * @return AbstractIssue
     */
    public function setReporter(User $reporter = null)
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
     * @return AbstractIssue
     */
    public function setAssignee(User $assignee = null)
    {
        $this->assignee = $assignee;

        return $this;
    }

    /**
     * Add collaborators
     *
     * @param User $collaborators
     * @return AbstractIssue
     */
    public function pushCollaborator(User $collaborators = null)
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
     * @return AbstractIssue
     */
    public function setCollaborators(ArrayCollection $collaborators = null)
    {
        $this->collaborators = $collaborators;

        return $this;
    }

    /**
     * @return AbstractIssue
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param AbstractIssue $parent
     * @return AbstractIssue
     */
    public function setParent(AbstractIssue $parent = null)
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
     * @return AbstractIssue
     */
    public function setChildren(ArrayCollection $children = null)
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
     * @return AbstractIssue
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * @return AbstractIssue
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
     * @return AbstractIssue
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
     * @return AbstractIssue
     */
    public function setPriority(IssuePriority $priority = null)
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
     * @return AbstractIssue
     */
    public function setResolution(IssueResolution $resolution = null)
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
     * @return AbstractIssue
     */
    public function setWorkflowItem(WorkflowItem $workflowItem = null)
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
     * @return AbstractIssue
     */
    public function setWorkflowStep(WorkflowStep $workflowStep = null)
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
     * @return AbstractIssue
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
     * @return string
     */
    public function getType()
    {
        // TODO: Implement getType() method.
    }
}
