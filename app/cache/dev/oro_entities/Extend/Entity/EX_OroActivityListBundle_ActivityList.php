<?php

namespace Extend\Entity;

abstract class EX_OroActivityListBundle_ActivityList implements \Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface
{
    protected $user_10c9f691;
    protected $issue_d62e41f3;

    /**
     * Checks if an entity of the given type can be associated with this entity
     *
     * @param string $targetClass The class name of the target entity
     * @return bool
     */
    public function supportActivityListTarget($targetClass)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getRealClass($targetClass);
        if ($className === 'Oro\Bundle\UserBundle\Entity\User') { return true; }
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return true; }
        return false;
    }

    public function setUser10c9f691($value)
    {
        $this->user_10c9f691 = $value; return $this;
    }

    public function setIssueD62e41f3($value)
    {
        $this->issue_d62e41f3 = $value; return $this;
    }

    public function removeUser10c9f691($value)
    {
        if ($this->user_10c9f691 && $this->user_10c9f691->contains($value)) {
            $this->user_10c9f691->removeElement($value);
        }
    }

    public function removeIssueD62e41f3($value)
    {
        if ($this->issue_d62e41f3 && $this->issue_d62e41f3->contains($value)) {
            $this->issue_d62e41f3->removeElement($value);
        }
    }

    /**
     * Removes the association of the given entity and this entity
     *
     * @param object $target Any configurable entity that can be associated with this type of entity
     * @return object This object
     */
    public function removeActivityListTarget($target)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        if ($className === 'Oro\Bundle\UserBundle\Entity\User') {
            if ($this->user_10c9f691->contains($target)) { $this->user_10c9f691->removeElement($target); }
            return $this;
        }
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') {
            if ($this->issue_d62e41f3->contains($target)) { $this->issue_d62e41f3->removeElement($target); }
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
    public function hasActivityListTarget($target)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        if ($className === 'Oro\Bundle\UserBundle\Entity\User') { return $this->user_10c9f691->contains($target); }
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return $this->issue_d62e41f3->contains($target); }
        return false;
    }

    public function getUser10c9f691()
    {
        return $this->user_10c9f691;
    }

    public function getIssueD62e41f3()
    {
        return $this->issue_d62e41f3;
    }

    /**
     * Gets entities of the given type associated with this entity
     *
     * @param string $targetClass The class name of the target entity
     * @return object[]
     */
    public function getActivityListTargets($targetClass)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getRealClass($targetClass);
        if ($className === 'Oro\Bundle\UserBundle\Entity\User') { return $this->user_10c9f691; }
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') { return $this->issue_d62e41f3; }
        throw new \RuntimeException(sprintf('The association with "%s" entity was not configured.', $className));
    }

    /**
     * Returns array with all associated entities
     *
     * @return array
     */
    public function getActivityListTargetEntities()
    {
        $associationEntities = [];
        $entities = $this->user_10c9f691->toArray();
        if (!empty($entities)) {
            $associationEntities = array_merge($associationEntities, $entities);
        }
        $entities = $this->issue_d62e41f3->toArray();
        if (!empty($entities)) {
            $associationEntities = array_merge($associationEntities, $entities);
        }
        return $associationEntities;
    }

    public function addUser10c9f691($value)
    {
        if (!$this->user_10c9f691->contains($value)) {
            $this->user_10c9f691->add($value);
        }
    }

    public function addIssueD62e41f3($value)
    {
        if (!$this->issue_d62e41f3->contains($value)) {
            $this->issue_d62e41f3->add($value);
        }
    }

    /**
     * Associates the given entity with this entity
     *
     * @param object $target Any configurable entity that can be associated with this type of entity
     * @return object This object
     */
    public function addActivityListTarget($target)
    {
        $className = \Doctrine\Common\Util\ClassUtils::getClass($target);
        if ($className === 'Oro\Bundle\UserBundle\Entity\User') {
            if (!$this->user_10c9f691->contains($target)) { $this->user_10c9f691->add($target); }
            return $this;
        }
        if ($className === 'Bap\Bundle\IssueBundle\Entity\Issue') {
            if (!$this->issue_d62e41f3->contains($target)) { $this->issue_d62e41f3->add($target); }
            return $this;
        }
        throw new \RuntimeException(sprintf('The association with "%s" entity was not configured.', $className));
    }

    public function __construct()
    {
        $this->user_10c9f691 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->issue_d62e41f3 = new \Doctrine\Common\Collections\ArrayCollection();
    }
}