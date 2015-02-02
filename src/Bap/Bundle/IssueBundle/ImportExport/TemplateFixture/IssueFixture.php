<?php

namespace Bap\Bundle\IssueBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

use Bap\Bundle\IssueBundle\Entity\Issue;
use Proxies\__CG__\Bap\Bundle\IssueBundle\Entity\IssueType;

class IssueFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    protected function createEntity($key)
    {
        return new Issue();
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return 'Academic\BtsBundle\Entity\Issue';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->getEntityData('Code example');
    }

    /**
     * @param string $key
     * @param Issue $entity
     */
    public function fillEntityData($key, $entity)
    {
        $manager          = $this->templateManager;
        $userRepo         = $manager->getEntityRepository('Oro\Bundle\UserBundle\Entity\User');
        $organizationRepo = $manager->getEntityRepository('Oro\Bundle\OrganizationBundle\Entity\Organization');
        $priorityRepo     = $manager->getEntityRepository('Bap\Bundle\IssueBundle\Entity\IssuePriority');
        $resolutionRepo   = $manager->getEntityRepository('Bap\Bundle\IssueBundle\Entity\IssueResolution');

        switch ($key) {
            case 'Code example':
                $entity->setCode('CODE 1')
                    ->setSummary('Summary example')
                    ->setDescription('Description example')
                    ->setOwner($userRepo->getEntity('John Doo'))
                    ->setAssignee($userRepo->getEntity('John Doo'))
                    ->setReporter($userRepo->getEntity('John Doo'))
                    ->setOrganization($organizationRepo->getEntity('default'))
                    ->setPriority($priorityRepo->getEntity('Normal'))
                    ->setResolution($resolutionRepo->getEntity('Done'))
                    ->setType(IssueType::TASK_TYPE);

                return;
        }

        parent::fillEntityData($key, $entity);
    }
}
