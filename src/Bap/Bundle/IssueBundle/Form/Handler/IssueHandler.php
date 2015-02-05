<?php

namespace Bap\Bundle\IssueBundle\Form\Handler;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

use Oro\Bundle\TagBundle\Entity\TagManager;

use Bap\Bundle\IssueBundle\Common\Form\TaggedFormHandlerInterface;
use Bap\Bundle\IssueBundle\Entity\Issue;

/**
 * Class IssueHandler
 * @package Bap\Bundle\IssueBundle\Form\Handler
 */
class IssueHandler implements TaggedFormHandlerInterface
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var TagManager
     */
    protected $tagManager;

    /**
     * @param FormInterface $form
     * @param Request       $request
     * @param ObjectManager $manager
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $manager)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    public function getEntity()
    {

    }
    /**
     * Process form
     *
     * @param  Issue $entity
     * @return bool True on successful processing, false otherwise
     */
    public function process(Issue $entity)
    {
        $this->form->setData($entity);

        if (in_array($this->request->getMethod(), ['POST', 'PUT'])) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->manager->persist($entity);
                $this->manager->flush();

                $this->tagManager->saveTagging($entity);

                return true;
            }
        }

        return false;
    }

    /**
     * Setter for tag manager
     *
     * @param TagManager $tagManager
     */
    public function setTagManager(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }
}
