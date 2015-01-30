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

use Doctrine\DBAL\LockMode;

/**
 * Class IssuesDataLoad
 * @package Bap\Bundle\IssueBundle\Migration\Data\Demo\ORM
 */
class IssuesDataLoad extends AbstractFixture
{
    const COUNT_ITEMS      = 10;

    const SUMMARY_TEXT     = 'Training course on ORO platform stage ';

    const DESCRIPTION_TEXT = 'Training to develop on ORO platform for new team members day';

    const ENTITY_NS        = 'Bap\Bundle\IssueBundle\Entity';
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
            $issue      = new Issue();
            $type       = $this->getIssueType();
            $priority   = $this->getIssuePriority();
            $resolution = $this->getIssueResolution();

            $issue
                ->setOwner($user)
                ->setOrganization($organization)
                ->setReporter($user)
                ->setAssignee($user)
                ->setCode('BAP-10' . $iteration)
                ->setType($type)
                ->setSummary(self::SUMMARY_TEXT . $iteration)
                ->setDescription(self::DESCRIPTION_TEXT . $iteration)
                ->setPriority($priority)
                ->setResolution($resolution)
                ->pushCollaborator($user);

            $this->objectManager->persist($issue);
        }

        $this->objectManager->flush();
    }

//    private function loadObjectManager()
//    {
//        if (!$this->) {
//            $this->entityManager = $this->entityManager->create(
//                $this->entityManager->getConnection(),
//                $this->entityManager->getConfiguration()
//            );
//        }
//    }

    /**
     * @return IssuePriority|null
     */
    private function getIssuePriority()
    {
        $priority = $this
            ->objectManager
            ->getRepository(self::ENTITY_NS . '\IssuePriority')
            ->findAll();

        return $this->getRandomItem($priority);
    }

    /**
     * @return IssueType|null
     */
    private function getIssueType()
    {
        $types = $this
            ->objectManager
            ->getRepository(self::ENTITY_NS . 'IssueType')
            ->findAll();

        return $this->getRandomItem($types);
    }

    /**
     * @param array $collection
     * @return mixed|null
     */
    private function getRandomItem(array $collection)
    {
        $iterator = new \ArrayIterator($collection);

        return $iterator->offsetGet(
            rand(0, $iterator->count() - 1)
        );
    }

    /**
     * @return \Bap\Bundle\IssueBundle\Entity\IssueResolution
     */
    protected function getIssueResolution()
    {
        $resolution = $this
            ->objectManager
            ->getRepository(self::ENTITY_NS . 'IssueResolution')
            ->findAll();

        return $this->getRandomItem($resolution);
    }

    /**
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    protected function getUser()
    {
        return $this
            ->objectManager
            ->getRepository('Oro\Bundle\UserBundle\Entity\User')
            ->findOneBy(['enabled' => 1]);
    }
}

