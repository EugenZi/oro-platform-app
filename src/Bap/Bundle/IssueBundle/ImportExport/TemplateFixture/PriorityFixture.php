<?php

namespace Bap\Bundle\IssueBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;

class PriorityFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
{
    /**
     * Creates a new instance of the entity
     *
     * @param string $key
     *
     * @return object
     */
    protected function createEntity($key)
    {
        return new IssuePriority();
    }

    /**
     * Gets the class name of the entity this fixture is worked with
     */
    public function getEntityClass()
    {
        return 'Bap\Bundle\IssueBundle\Entity\IssuePriority';
    }

    /**
     * Get fixtures for template data.
     *
     * @return \Iterator
     */
    public function getData()
    {
        return $this->getEntityData('Normal');
    }

    /**
     * @param string $key
     * @param IssuePriority $entity
     */
    public function fillEntityData($key, $entity)
    {
        switch ($key) {
            case 'Normal':
                $entity
                    ->setName('Normal')
                    ->setValue(20);

                return;
        }

        parent::fillEntityData($key, $entity);
    }
}
