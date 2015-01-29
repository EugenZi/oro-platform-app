<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\Demo\ORM;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;
use Bap\Bundle\IssueBundle\Entity\IssueType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

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

        while (--$iteration) {
            $issue = new Issue();

            $issue
                ->setCode('BAP-10' . $iteration)
                ->setSummary(self::SUMMARY_TEXT . $iteration)
                ->setDescription(self::DESCRIPTION_TEXT . $iteration)
                ->setPriority($this->getRandomPriority())
                ->setReporter($this->getRandomUser())
                ->setAssignee($this->getRandomUser())
                ->setOwner($this->getRandomUser())
                ->setOrganization(
                    $this->getRandomUser()->getOrganization()
                )
                ->setType($this->getRandomType())
                ->pushCollaborator($this->getRandomUser());

            $manager->persist($issue);
            $manager->flush();
        }

    }

    /**
     * @return IssuePriority|null
     */
    private function getRandomPriority()
    {
        $priority = $this
            ->getPriorityRepository()
            ->findAll();

        return $this->getRandomItem($priority);
    }

    /**
     * @return IssueType|null
     */
    private function getRandomType()
    {
        $types = $this
            ->getTypeRepository()
            ->findAll();

        return $this->getRandomItem($types);
    }

    /**
     * @return User|null
     */
    private function getRandomUser()
    {
        $user = $this
            ->getUserRepository()
            ->findOneBy(['enabled' => 1]);

        $companyUsers = $user->getUsers();

        return $this->getRandomItem($companyUsers);
    }

    /**
     * @param array $collection
     * @return mixed|null
     */
    private function getRandomItem(array $collection)
    {
        $it    = new \ArrayIterator($collection);

        return $it->offsetGet(
            rand(0, $it->count() - 1)
        );
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getPriorityRepository()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssuePriority');
    }

    /**
     * @return \Oro\Bundle\UserBundle\Entity\Repository\UserRepository
     */
    protected function getOrganizationRepository()
    {
        return $this
            ->objectManager
            ->getRepository('OroUserBundle:User');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getResolutionRepository()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueResolution');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getTypeRepository()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueType');
    }

    /**
     * @return \Oro\Bundle\OrganizationBundle\Entity\Repository\OrganizationRepository
     */
    protected function getUserRepository()
    {
        return $this
            ->objectManager
            ->getRepository('OroOrganizationBundle:Organization');
    }
}
