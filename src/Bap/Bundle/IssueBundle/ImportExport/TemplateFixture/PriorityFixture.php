<?php

namespace Academic\BtsBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

use Academic\BtsBundle\Entity\Priority;

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
        return new Priority();
    }

    /**
     * Gets the class name of the entity this fixture is worked with
     */
    public function getEntityClass()
    {
        return 'Academic\BtsBundle\Entity\Priority';
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
     * @param Priority $entity
     */
    public function fillEntityData($key, $entity)
    {
        switch ($key) {
            case 'Normal':
                $entity->setTitle('Normal')
                    ->setWeight(20);

                return;
        }

        parent::fillEntityData($key, $entity);
    }
}
