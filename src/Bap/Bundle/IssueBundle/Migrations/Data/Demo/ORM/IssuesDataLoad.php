<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\Demo\ORM;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;
use Bap\Bundle\IssueBundle\Entity\IssueType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;

use Bap\Bundle\IssueBundle\Entity\Issue;

/**
 * Class IssuesDataLoad
 * @package Bap\Bundle\IssueBundle\Migration\Data\Demo\ORM
 */
class IssuesDataLoad extends AbstractFixture
{
    const COUNT_ITEMS      = 10;

    const SUMMARY_TEXT     = 'Training course on ORO platform stage ';

    const DESCRIPTION_TEXT = 'Training to develop on ORO platform for new team members day';

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->objectManager = $manager;
        
        $iteration           = self::COUNT_ITEMS;
        $user                = $this->getUser();
        $organization        = $user->getOrganization();

        while (--$iteration) {
            $issue = new Issue();

            $issue
                ->setCode('BAP-10' . $iteration)
                ->setSummary(self::SUMMARY_TEXT . $iteration)
                ->setDescription(self::DESCRIPTION_TEXT . $iteration)
                ->setPriority($this->getRandomPriority())
                ->setReporter($user)
                ->setAssignee($user)
                ->setOwner($user)
                ->setOrganization($organization)
                ->setType($this->getRandomType())
                ->pushCollaborator($user);

            $manager->persist($issue);
        }
        $manager->flush();
    }

    /**
     * @return IssuePriority|null
     */
    private function getRandomPriority()
    {
        $priority = $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssuePriority')
            ->findAll();

        return $this->getRandomItem($priority);
    }

    /**
     * @return IssueType|null
     */
    private function getRandomType()
    {
        $types = $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueType')
            ->findAll();

        return $this->getRandomItem($types);
    }

    /**
     * @param array $collection
     * @return mixed|null
     */
    private function getRandomItem(array $collection)
    {
        $it = new \ArrayIterator($collection);

        return $it->offsetGet(
            rand(0, $it->count() - 1)
        );
    }

    /**
     * @return \Bap\Bundle\IssueBundle\Entity\IssueResolution
     */
    protected function getIssueResolution()
    {
        $resolution = $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueResolution')
            ->findAll();

        return $this->getRandomItem($resolution);
    }

    /**
     * @return \Bap\Bundle\IssueBundle\Entity\IssueType
     */
    protected function getIssueType()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueType')
            ->findAll();
    }

    /**
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    protected function getUser()
    {
        return $this
            ->objectManager
            ->getRepository('OroUserBundle:User')
            ->findOneBy(['enabled' => 1]);
    }
}

