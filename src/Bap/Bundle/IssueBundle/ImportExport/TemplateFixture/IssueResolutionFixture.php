<?php

namespace Bap\Bundle\IssueBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;

class ResolutionFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
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
        return new IssueResolution();
    }

    /**
     * Gets the class name of the entity this fixture is worked with
     */
    public function getEntityClass()
    {
        return 'Bap\Bundle\IssueBundle\Entity\IssueResolution';
    }

    /**
     * Get fixtures for template data.
     *
     * @return \Iterator
     */
    public function getData()
    {
        return $this->getEntityData('Done');
    }

    /**
     * @param string $key
     * @param IssueResolution $entity
     */
    public function fillEntityData($key, $entity)
    {
        switch ($key) {
            case 'Done':
                $entity->setValue('Done');

                return;
        }

        parent::fillEntityData($key, $entity);
    }
}
