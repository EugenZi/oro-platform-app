<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;

/**
 * Class ResolutionDataLoad
 * @package Bap\Bundle\IssueBundle\Migration\Data\Demo
 */
class ResolutionDataLoad extends AbstractFixture
{
    /**
     * @var array
     */
    protected $issueResolutions = [
        [
            'value' => 'Unresolved',
        ],
        [
            'value' => 'In progress'
        ],
        [
            'value' => 'Resolved'
        ],
        [
            'value' => 'Closed'
        ],
        [
            'value' => 'Reopened'
        ]

    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        array_map(function ($value) use ($manager) {

            $issueResolution = new IssueResolution();

            $issueResolution->setValue($value['value']);
            $manager->persist($issueResolution);
            $manager->flush();

        }, $this->issueResolutions);
    }
}