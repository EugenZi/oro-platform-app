<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueCollabortator
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueCollabortatorRepository")
 * @ORM\Table(name="bap_issue_collabortators", indexes={@ORM\Index(name="index2", columns={"issue_id"}), @ORM\Index(name="index3", columns={"user_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssueCollabortator", "extended"="IssueCollabortator"})
 */
class BaseIssueCollabortator
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $issue_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="issueCollabortators")
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $issue;

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
     * @return \Bap\Bundle\IssueBundle\Entity\IssueCollabortator
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
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Bap\Bundle\IssueBundle\Entity\IssueCollabortator
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of user_id.
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set Issue entity (many to one).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueCollabortator
     */
    public function setIssue(Issue $issue = null)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get Issue entity (many to one).
     *
     * @return \Bap\Bundle\IssueBundle\Entity\Issue
     */
    public function getIssue()
    {
        return $this->issue;
    }

    public function __sleep()
    {
        return array('id', 'issue_id', 'user_id');
    }
}