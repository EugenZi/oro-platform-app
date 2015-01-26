<?php

namespace OroEntityProxy\OroEmailBundle;

use Oro\Bundle\EmailBundle\Entity\EmailAddress;
use Oro\Bundle\EmailBundle\Entity\EmailOwnerInterface;

class EmailAddressProxy extends EmailAddress
{
    /**
     * @var EmailOwnerInterface
     */
    private $owner1;

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        if ($this->owner1 !== null) {
            return $this->owner1;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(EmailOwnerInterface $owner = null)
    {
        if ($owner !== null && is_a($owner, 'Oro\Bundle\UserBundle\Entity\User')) {
            $this->owner1 = $owner;
        } else {
            $this->owner1 = null;
        }
        $this->setHasOwner($owner !== null);

        return $this;
    }

    /**
     * Pre persist event listener
     */
    public function beforeSave()
    {
        $date = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->setCreated($date);
        $this->setUpdated($date);
    }

    /**
     * Pre update event listener
     */
    public function beforeUpdate()
    {
        $this->setUpdated(new \DateTime('now', new \DateTimeZone('UTC')));
    }
}
