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
use Bap\Bundle\IssueBundle\Migration\Data\ORM\PriorityDataLoad;

class IssuesDataLoad extends AbstractFixture
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $this->objectManager = $manager;
        $storyRange          = range(1, 10);

        foreach ($storyRange as $key => $value) {

            $story    = new Issue();

            $story
                ->setCode('BAP-10' . $key)
                ->setSummary('Training course on ORO platform stage ' . $key)
                ->setDescription('Training to develop on ORO platform for new team members day' . $key)
                ->setPriority($this->getRandomPriority())
                ->setReporter($this->getRandomUser())
                ->setAssignee($this->getRandomUser())
                ->setOwner($this->getRandomUser())
                ->setOrganization($this->getRandomUser()->getOrganization())
                ->setType($this->getRandomType())
                ->pushCollaborator($this->getRandomUser());

            $manager->persist($story);
            $manager->flush();
        }

    }

    private function getRandomPriority()
    {
        $priority = $this
            ->getPriorityRepository()
            ->findAll();

        return $this->getRandomItem($priority);
    }

    private function getRandomType()
    {
        $types = $this
            ->getTypeRepository()
            ->findAll();

        return $this->getRandomItem($types);
    }

    private function getRandomUser()
    {
        $user = $this
            ->getUserRepository()
            ->findOneBy(['enabled' => 1]);

        $companyUsers = $user->getUsers();

        return $this->getRandomItem($companyUsers);
    }

    private function getRandomItem(ArrayCollection $collection)
    {
        $count = $collection->count();
        $rand  = rand(0, $count);

        return $collection->get($rand);
    }

    protected function getPriorityRepository()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssuePriority');
    }

    protected function getOrganizationRepository()
    {
        return $this
            ->objectManager
            ->getRepository('OroUserBundle:User');
    }

    protected function getResolutionRepository()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueResolution');
    }

    protected function getTypeRepository()
    {
        return $this
            ->objectManager
            ->getRepository('BapIssueBundle:IssueType');
    }

    protected function getUserRepository()
    {
        return $this
            ->objectManager
            ->getRepository('OroOrganizationBundle:Organization');
    }
}