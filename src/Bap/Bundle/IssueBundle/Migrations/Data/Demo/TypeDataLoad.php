<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;

use Bap\Bundle\IssueBundle\Entity\IssueType;

/**
 * Class TypeDataLoad
 * @package Bap\Bundle\IssueBundle\Migration\Data\Demo
 */
class TypeDataLoad extends AbstractFixture
{

    private $issueTypes = [
        [
            'name' => IssueType::STORY_TYPE
        ],
        [
            'name' => IssueType::TASK_TYPE
        ],
        [
            'name' => IssueType::SUB_TASK_TYPE
        ],
        [
            'name' => IssueType::BUG_TYPE
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        array_map(function ($value) use ($manager) {

            $issueType = new IssueType();

            $issueType->setName($value['name']);
            $manager->persist($issueType);
            $manager->flush();

        }, $this->issueTypes);
    }
}