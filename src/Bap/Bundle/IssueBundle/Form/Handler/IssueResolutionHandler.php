<?php

namespace Bap\Bundle\IssueBundle\Form\Handler;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;

class IssueResolutionHandler
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

    /**
     * Process form
     *
     * @param  IssueResolution $entity
     * @return bool True on successful processing, false otherwise
     */
    public function process(IssueResolution $entity)
    {
        $this->form->setData($entity);
        $returnData = false;

        if (in_array($this->request->getMethod(), ['POST', 'PUT'])) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->manager->persist($entity);
                $this->manager->flush();

                $returnData = true;
            }
        }

        return $returnData;
    }
}
