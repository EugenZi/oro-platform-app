<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Bap\Bundle\IssueBundle\Entity\IssueType;

/**
 * Class TypeDataLoad
 * @package Bap\Bundle\IssueBundle\Migration\Data\Demo
 */
class TypeDataLoad extends AbstractFixture
{

    private $issueTypes = [
        IssueType::STORY_TYPE,
        IssueType::TASK_TYPE,
        IssueType::SUB_TASK_TYPE,
        IssueType::BUG_TYPE
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $data = $this->issueTypes;
        $it = new \ArrayIterator($data);

        while($it->valid()) {

            $issueType = new IssueType();

            $issueType->setName($it->current());
            $manager->persist($issueType);
            $manager->flush();

            $it->next();
        }
    }
}