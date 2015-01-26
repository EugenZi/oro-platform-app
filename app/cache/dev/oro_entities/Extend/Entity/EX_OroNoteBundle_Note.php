<?php

namespace Extend\Entity;

abstract class EX_OroNoteBundle_Note implements \Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface
{
    protected $issue_ea626112;

    /**
     * Checks if this entity can be associated with the given target entity type
     *
     * @param string $targetClass The class name of the target entity
     * @return bool
     */
    public function supportTarget($targetClass)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getRealClass($targetClass);
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return true; }
        return false;
    }

    /**
     * Sets the entity this entity is associated with
     *
     * @param object $target Any configurable entity that can be associated with this type of entity
     * @return object This object
     */
    public function setTarget($target)
    {
        if (null === $target) { $this->resetTargets(); return $this; }
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        // This entity can be associated with only one another entity
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { $this->resetTargets(); $this->issue_ea626112 = $target; return $this; }
        throw new \RuntimeException(sprintf('The association with "%s" entity was not configured.', $className));
    }

    public function setIssueEa626112($value)
    {
        $this->issue_ea626112 = $value; return $this;
    }

    /**
     * Returns array with all associated entities
     *
     * @return array
     */
    public function getTargetEntities()
    {
        $associationEntities = [];
        $entity = $this->issue_ea626112;
        if ($entity) {
            $associationEntities[] = $entity;
        }
        return $associationEntities;
    }

    /**
     * Gets the entity this entity is associated with
     *
     * @return object|null Any configurable entity
     */
    public function getTarget()
    {
        if (null !== $this->issue_ea626112) { return $this->issue_ea626112; }
        return null;
    }

    public function getIssueEa626112()
    {
        return $this->issue_ea626112;
    }

    public function __construct()
    {
    }

    private function resetTargets()
    {
        $this->issue_ea626112 = null;
    }
}