<?php

namespace ap\Bundle\IssueBundle\Migration\Data\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;

/**
 * Class PriorityDataLoad
 * @package ap\Bundle\IssueBundle\Migration\Data\Demo
 */
class PriorityDataLoad extends AbstractFixture
{

    /**
     * @var array
     */
    private $issuePriorities = [
        IssuePriority::BLOCKER  => 90,
        IssuePriority::BUG      => 80,
        IssuePriority::CRITICAL => 70,
        IssuePriority::MAJOR    => 60,
        IssuePriority::TRIVIAL  => 50
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        array_map(function ($value, $key) use ($manager) {

            $issuePriority = new IssuePriority();

            $issuePriority->setName($key);
            $issuePriority->setValue($value);

            $manager->persist($issuePriority);
            $manager->flush();

        }, $this->issuePriorities);
    }
}