<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
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
        IssuePriority::BLOCKER  => 100,
        IssuePriority::BUG      => 90,
        IssuePriority::CRITICAL => 80,
        IssuePriority::MAJOR    => 70,
        IssuePriority::MINOR    => 60,
        IssuePriority::TRIVIAL  => 50
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $data = $this->issuePriorities;
        $it = new \ArrayIterator($data);

        while($it->valid()) {

            $issuePriority = new IssuePriority();

            $issuePriority->setName($it->key());
            $issuePriority->setValue($it->current());

            $manager->persist($issuePriority);
            $manager->flush();

            $it->next();
        }
    }
}