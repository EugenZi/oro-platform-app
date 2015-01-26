<?php

namespace Extend\Entity;

abstract class EX_OroCalendarBundle_CalendarEvent implements \Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface, \Oro\Bundle\ActivityBundle\Model\ActivityInterface
{
    protected $issue_ed26a3d2;

    /**
     * Checks if an entity of the given type can be associated with this entity
     *
     * @param string $targetClass The class name of the target entity
     * @return bool
     */
    public function supportActivityTarget($targetClass)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getRealClass($targetClass);
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return true; }
        return false;
    }

    public function setIssueEd26a3d2($value)
    {
        $this->issue_ed26a3d2 = $value; return $this;
    }

    public function removeIssueEd26a3d2($value)
    {
        if ($this->issue_ed26a3d2 && $this->issue_ed26a3d2->contains($value)) {
            $this->issue_ed26a3d2->removeElement($value);
        }
    }

    /**
     * Removes the association of the given entity and this entity
     *
     * @param object $target Any configurable entity that can be associated with this type of entity
     * @return object This object
     */
    public function removeActivityTarget($target)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') {
            if ($this->issue_ed26a3d2->contains($target)) { $this->issue_ed26a3d2->removeElement($target); }
            return $this;
        }
        throw new \RuntimeException(sprintf('The association with "%s" entity was not configured.', $className));
    }

    /**
     * Checks is the given entity is associated with this entity
     *
     * @param object $target Any configurable entity that can be associated with this type of entity
     * @return bool
     */
    public function hasActivityTarget($target)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return $this->issue_ed26a3d2->contains($target); }
        return false;
    }

    public function getIssueEd26a3d2()
    {
        return $this->issue_ed26a3d2;
    }

    /**
     * Gets entities of the given type associated with this entity
     *
     * @param string $targetClass The class name of the target entity
     * @return object[]
     */
    public function getActivityTargets($targetClass)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getRealClass($targetClass);
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return $this->issue_ed26a3d2; }
        throw new \RuntimeException(sprintf('The association with "%s" entity was not configured.', $className));
    }

    /**
     * Returns array with all associated entities
     *
     * @return array
     */
    public function getActivityTargetEntities()
    {
        $associationEntities = [];
        $entities = $this->issue_ed26a3d2->toArray();
        if (!empty($entities)) {
            $associationEntities = array_merge($associationEntities, $entities);
        }
        return $associationEntities;
    }

    public function addIssueEd26a3d2($value)
    {
        if (!$this->issue_ed26a3d2->contains($value)) {
            $this->issue_ed26a3d2->add($value);
        }
    }

    /**
     * Associates the given entity with this entity
     *
     * @param object $target Any configurable entity that can be associated with this type of entity
     * @return object This object
     */
    public function addActivityTarget($target)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') {
            if (!$this->issue_ed26a3d2->contains($target)) { $this->issue_ed26a3d2->add($target); }
            return $this;
        }
        throw new \RuntimeException(sprintf('The association with "%s" entity was not configured.', $className));
    }

    public function __construct()
    {
        $this->issue_ed26a3d2 = new \Doctrine\Common\Collections\ArrayCollection();
    }
}