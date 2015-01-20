<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueRelation
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueRelationRepository")
 * @ORM\Table(name="bap_issue_relations", indexes={@ORM\Index(name="index2", columns={"issue_id"}), @ORM\Index(name="index3", columns={"related_issue_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssueRelation", "extended"="IssueRelation"})
 */
abstract class BaseIssueRelation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $issue_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $related_issue_id;

    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="issueRelationRelatedByIssueIds")
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    protected $issueRelatedByIssueId;

    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="issueRelationRelatedByRelatedIssueIds")
     * @ORM\JoinColumn(name="related_issue_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    protected $issueRelatedByRelatedIssueId;
}