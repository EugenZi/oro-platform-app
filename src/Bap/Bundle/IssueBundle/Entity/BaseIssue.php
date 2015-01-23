<?php

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * Bap\Bundle\IssueBundle\Entity\Issue
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueRepository")
 * @ORM\Table(
 *      name="bap_issue",
 *      indexes={
 *          @ORM\Index(name="BAP_ISSUE_SUMMARY_IDX", columns={"summary"}),
 *          @ORM\Index(name="BAP_ISSUE_CODE_IDX", columns={"code"}),
 *          @ORM\Index(name="BAP_ISSUE_DESCRIPTION_IDX", columns={"description"}),
 *          @ORM\Index(name="BAP_ISSUE_STATUS_IDX", columns={"`type`"}),
 *          @ORM\Index(name="BAP_ISSUE_ASSIGNEE_ID_IDX", columns={"priority"}),
 *          @ORM\Index(name="BAP_ISSUE_RELATED_ISSUES_ID_IDX", columns={"`status`"}),
 *          @ORM\Index(name="BAP_ISSUE_RELATED_ISSUES_ID_IDX", columns={"tags_id"}),
 *          @ORM\Index(name="BAP_ISSUE_COLLABORATORS_ID_IDX", columns={"reporter_id"}),
 *          @ORM\Index(name="BAP_ISSUE_ISSUE_PARENT_ID_IDX", columns={"parent_id"}),
 *          @ORM\Index(name="BAP_ISSUE_CHILDREN_ID_IDX", columns={"resolution_id"}),
 *          @ORM\Index(name="BAP_ISSUE_WORKFLOW_STEP_ID_IDX", columns={"assignee_id"})
 *          @ORM\Index(name="BAP_ISSUE_WORKFLOW_STEP_ID_IDX", columns={"notes"})
 *      }
 * )
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      routeName="bts_issue_index",
 *      defaultValues={
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="user_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "dataaudit"={
 *              "auditable"=true
 *          },
 *          "entity"={
 *              "icon"="icon-envelope"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "permissions"="All",
 *              "group_name"=""
 *          },
 *          "workflow"={
 *              "active_workflow"="issue_flow"
 *          }
 *      }
 * )
 *
 * @package Bap\IssueBundle\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssue", "extended"="Issue"})
 */
abstract class BaseIssue
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="SET NULL")
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
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization", inversedBy="businessUnits")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
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
     * @ORM\Column(type="string", length=15)
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
     * @ORM\Column(name="`status`", type="string", length=32)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=15)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=70
     *          },
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var IssuePriority
     * @ORM\ManyToOne(targetEntity="IssuePriority")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id", nullable=false)
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
     * @ORM\ManyToOne(targetEntity="IssueResolution")
     * @ORM\JoinColumn(name="resolution_id", referencedColumnName="id")
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
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="IssueCollaborator", mappedBy="issue")
     * @ORM\JoinColumn(name="id", referencedColumnName="issue_id")
     */
    protected $collaborators;

    /**
     * @ORM\OneToMany(targetEntity="IssueRelation", mappedBy="issueRelatedByRelatedIssueId")
     * @ORM\JoinColumn(name="id", referencedColumnName="related_issue_id", onDelete="CASCADE")
     */
    protected $relations;

    /**
     * @ORM\ManyToOne(targetEntity="IssuePriority", inversedBy="issues")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="`id`")
     */
    protected $issuePriority;

    /**
     * @ORM\ManyToOne(targetEntity="IssueResolution", inversedBy="issues")
     * @ORM\JoinColumn(name="issue_resolution_id", referencedColumnName="`id`")
     */
    protected $issueResolution;
}