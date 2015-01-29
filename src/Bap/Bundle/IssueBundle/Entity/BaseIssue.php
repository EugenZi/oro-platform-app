<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\WorkflowBundle\Entity\WorkflowItem;
use Oro\Bundle\WorkflowBundle\Entity\WorkflowStep;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Bap\Bundle\IssueBundle\Entity\Issue
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueRepository")
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
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssue", "extended"="Issue"})
 * @ORM\HasLifecycleCallbacks
 *
 * @Config(
 *      routeName="bap_issue_index",
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
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 *
 * @package Bap\IssueBundle\Entity
 */
abstract class BaseIssue
{
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
     *              "order"=20
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
     * @ORM\Column(type="string", length=15)
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
     * @var IssueType
     *
     * @ORM\ManyToOne(targetEntity="IssueType")
     * @ORM\JoinColumn(
     *      name="type_id",
     *      referencedColumnName="id"
     * )
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
    protected $type;

    /**
     * @var string $summary
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $summary;

    /**
     * @var string $description
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var IssuePriority
     *
     * @ORM\ManyToOne(targetEntity="IssuePriority")
     * @ORM\JoinColumn(
     *      name="priority_id",
     *      referencedColumnName="id",
     *      nullable=true,
     *      onDelete="SET NULL"
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
     *      referencedColumnName="id",
     *      nullable=true,
     *      onDelete="SET NULL"
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
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
}
