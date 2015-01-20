<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\BapIssueResolution
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueResolutionRepository")
 * @ORM\Table(name="bap_issue_resolution", uniqueConstraints={@ORM\UniqueConstraint(name="value_UNIQUE", columns={"`value`"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssueResolution", "extended"="IssueResolution"})
 */
class BaseIssueResolution
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`value`", type="string", length=45)
     */
    protected $value;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="issueResolution")
     * @ORM\JoinColumn(name="`value`", referencedColumnName="resolution")
     */
    protected $issues;

    public function __construct()
    {
        $this->bapIssues = new ArrayCollection();
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
     * Set the value of value.
     *
     * @param string $value
     * @return \Bap\Bundle\IssueBundle\Entity\IssueResolution
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add BapIssue entity to collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueResolution
     */
    public function addBapIssue(Issue $issue)
    {
        $this->issues[] = $issue;

        return $this;
    }

    /**
     * Remove Issue entity from collection (one to many).
     *
     * @param \Bap\Bundle\IssueBundle\Entity\Issue $issue
     * @return \Bap\Bundle\IssueBundle\Entity\IssueResolution
     */
    public function removeIssue(Issue $issue)
    {
        $this->issues->removeElement($issue);

        return $this;
    }

    /**
     * Get BapIssue entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBapIssues()
    {
        return $this->issues;
    }

    public function __sleep()
    {
        return array('id', 'value');
    }
}