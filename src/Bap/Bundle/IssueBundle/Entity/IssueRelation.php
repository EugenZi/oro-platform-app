<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueRelation
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueRelationRepository")
 * @ORM\Table(
 *      name="bap_issue_relations",
 *      indexes={
 *          @ORM\Index(
 *              name="index2",
 *              columns={"issue_id"}
 *          ),
 *          @ORM\Index(
 *              name="index3",
 *              columns={"related_issue_id"}
 *          )
 *      }
 * )
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueRelationRepository")
 */
class IssueRelation
{
    /**
     * Table name that contained many to many issue relations
     */
    const TABLE_NAME = 'bap_issue_to_issue_relation';

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
     * Set the value of issue_id.
     *
     * @param integer $issue_id
     * @return \Bap\Bundle\IssueBundle\Entity\IssueRelation
     */
    public function setIssueId($issue_id)
    {
        $this->issue_id = $issue_id;

        return $this;
    }

    /**
     * Get the value of issue_id.
     *
     * @return integer
     */
    public function getIssueId()
    {
        return $this->issue_id;
    }

    /**
     * Set the value of related_issue_id.
     *
     * @param integer $related_issue_id
     * @return \Bap\Bundle\IssueBundle\Entity\IssueRelation
     */
    public function setRelatedIssueId($related_issue_id)
    {
        $this->related_issue_id = $related_issue_id;

        return $this;
    }

    /**
     * Get the value of related_issue_id.
     *
     * @return integer
     */
    public function getRelatedIssueId()
    {
        return $this->related_issue_id;
    }

    /**
     * Set Issue entity related by `issue_id` (many to one).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueRelation
     */
    public function setIssueRelatedByIssueId(Issue $issue = null)
    {
        $this->issueRelatedByIssueId = $issue;

        return $this;
    }

    /**
     * Get Issue entity related by `issue_id` (many to one).
     *
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function getIssueRelatedByIssueId()
    {
        return $this->issueRelatedByIssueId;
    }

    /**
     * Set Issue entity related by `related_issue_id` (many to one).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueRelation
     */
    public function setIssueRelatedByRelatedIssueId(Issue $issue = null)
    {
        $this->issueRelatedByRelatedIssueId = $issue;

        return $this;
    }

    /**
     * Get Issue entity related by `related_issue_id` (many to one).
     *
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function getIssueRelatedByRelatedIssueId()
    {
        return $this->issueRelatedByRelatedIssueId;
    }

    public function __sleep()
    {
        return ['id', 'issue_id', 'related_issue_id'];
    }
}