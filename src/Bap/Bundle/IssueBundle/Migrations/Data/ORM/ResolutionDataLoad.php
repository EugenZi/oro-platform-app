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
        'Unresolved',
        'In progress',
        'Resolved',
        'Closed',
        'Reopened'
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = $this->issueResolutions;
        $it = new \ArrayIterator($data);

        while($it->valid()) {

            $issueResolution = new IssueResolution();

            $issueResolution->setValue($it->current());
            $manager->persist($issueResolution);
            $manager->flush();

            $it->next();
        }
    }
}