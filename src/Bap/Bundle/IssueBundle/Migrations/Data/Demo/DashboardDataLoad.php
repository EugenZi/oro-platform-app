<?php

namespace Bap\Bundle\IssueBundle\Migration\Data\Demo;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Oro\Bundle\DashboardBundle\Migrations\Data\ORM\AbstractDashboardFixture;

/**
 * Class DashboardDataLoad
 * @package ap\Bundle\IssueBundle\Migration\Data\Demo
 */
class DashboardDataLoad extends AbstractDashboardFixture implements DependentFixtureInterface
{
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return ['Oro\Bundle\DashboardBundle\Migrations\Data\ORM\LoadDashboardData'];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $dashboard = $this->findAdminDashboardModel($manager, 'main');

        if ($dashboard) {
            $dashboard->addWidget($this->createWidgetModel('my_issues'));
            $dashboard->addWidget($this->createWidgetModel('issue_chart'));

            $manager->flush();
        }
    }
}