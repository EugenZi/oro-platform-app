<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bap\Bundle\IssueBundle\Entity\IssueType
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueTypeRepository")
 * @ORM\Table(
 *      name="bap_issue_type",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="BAP_ISSUE_TYPE_NAME_UNIQUE_INDEX",
 *              columns={"value"}
 *          )
 *      }
 * )
 */
class IssueType
{
    /**
     * Issue type table real name
     */
    const TABLE_NAME = 'bap_issue_type';

    /**
     * Issue type task
     */
    const TASK_TYPE = 'task';

    /**
     * Issue type story
     */
    const STORY_TYPE = 'story';

    /**
     * Issue type sub-task
     */
    const SUB_TASK_TYPE = 'sub_task';

    /**
     * Issue type bug
     */
    const BUG_TYPE = 'bug';

    /**
     * Issue type blocker
     */
    const BLOCKER_TYPE = 'blocker';

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
