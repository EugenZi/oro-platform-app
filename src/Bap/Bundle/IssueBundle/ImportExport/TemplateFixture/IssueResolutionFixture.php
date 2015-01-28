<?php

namespace Academic\BtsBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

use Academic\BtsBundle\Entity\Resolution;

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
        return new Resolution();
    }

    /**
     * Gets the class name of the entity this fixture is worked with
     */
    public function getEntityClass()
    {
        return 'Academic\BtsBundle\Entity\Resolution';
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
     * @param Resolution $entity
     */
    public function fillEntityData($key, $entity)
    {
        switch ($key) {
            case 'Done':
                $entity->setTitle('Done');

                return;
        }

        parent::fillEntityData($key, $entity);
    }
}
