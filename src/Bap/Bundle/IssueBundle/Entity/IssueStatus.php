<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueType
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueTypeRepository")
 */
class IssueStatus
{
    /**
     * Issue table real name
     */
    const TABLE_NAME = 'bap_issue_status';

    /**
     * Default issue status
     */
    const OPEN = 'open';

    /**
     * Issue status after start development from it
     */
    const IN_PROGRESS = 'in_progress';

    /**
     * Issue status when work is done
     */
    const CLOSED = 'closed';

    /**
     * Issue status when developer think that he done the issue
     */
    const RESOLVED = 'resolved';

    /**
     * Issue status when developer not done the issue
     */
    const REOPENED = 'reopened';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`value`", type="string", length=32)
     */
    protected $name;

    /**
     * Base issue type constructor
     */
    public function __construct()
    {
        $this->issues = new ArrayCollection();
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
     * @param string $name
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Return fields used to serialization
     *
     * @return array
     */
    public function __sleep()
    {
        return ['id', 'value'];
    }
}