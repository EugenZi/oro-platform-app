<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\BapIssueResolution
 *
 * @ORM\Entity()
 * @ORM\Table(
 *      name="bap_issue_resolution",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="BAP_ISSUE_RESOLUTION_VALUE_UNIQUE_INDEX", columns={"value"})
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
     * @ORM\Column(name="value", type="string", length=45)
     */
    protected $value;

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
     * @return IssueResolution
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
     * @return string
     */
    public function __toString()
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