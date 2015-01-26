<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\BapIssueResolution
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueResolutionRepository")
 * @ORM\Table(
 *      name="bap_issue_resolution",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="BAP_ISSUE_RESOLUTION_NAME_UNIQUE_INDEX", columns={"value"})
 *      }
 * )
 */
class IssueResolution
{
    /**
     * Issue resolution real name in database
     */
    const TABLE_NAME = 'bap_issue_resolution';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`value`", type="string", length=45)
     */
    protected $name;

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
     * @param string $name
     * @return IssueResolution
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
     * @return array
     */
    public function __sleep()
    {
        return ['id', 'value'];
    }
}