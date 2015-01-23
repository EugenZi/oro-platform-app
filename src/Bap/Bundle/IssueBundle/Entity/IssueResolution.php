<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueResolution
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueResolutionRepository")
 */
class IssueResolution extends BaseIssueResolution
{
    /**
     * Issue resolution real name in database
     */
    const TABLE_NAME = 'bap_issue_resolution';

    /**
     * Issue resolution entity constructor
     */
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
     * @return array
     */
    public function __sleep()
    {
        return ['id', 'value'];
    }
}