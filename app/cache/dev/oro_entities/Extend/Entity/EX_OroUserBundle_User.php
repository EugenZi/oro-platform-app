<?php

namespace Extend\Entity;

abstract class EX_OroUserBundle_User implements \Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface
{
    protected $avatar;

    public function setAvatar($value)
    {
        $this->avatar = $value; return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function __construct()
    {
    }
}