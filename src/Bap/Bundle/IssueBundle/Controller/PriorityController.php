<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\SecurityBundle\Annotation\Acl;

use Bap\Bundle\IssueBundle\Entity\Priority;

/**
 * Class PriorityController
 * @package Bap\Bundle\IssueBundle\Controller
 */
class PriorityController extends Controller
{
    /**
     * @Route("/priority", name="bts_priority_index")
     * @Acl(
     *      id="bts_priority_view",
     *      type="entity",
     *      class="AcademicBtsBundle:Priority",
     *      permission="VIEW"
     * )
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('academic_bts.priority.entity.class'),
        ];
    }

    /**
     * @Route("/priority/create", name="bts_priority_create")
     * @Acl(
     *      id="bts_priority_create",
     *      type="entity",
     *      class="AcademicBtsBundle:Priority",
     *      permission="CREATE"
     * )
     * @Template("AcademicBtsBundle:Priority:update.html.twig")
     *
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Priority());
    }

    /**
     * @param Priority $priority
     * @Route("/priority/update/{id}", name="bts_priority_update", requirements={"id"="\d+"})
     * @Acl(
     *      id="bts_priority_update",
     *      type="entity",
     *      class="AcademicBtsBundle:Priority",
     *      permission="EDIT"
     * )
     * @Template()
     *
     * @return array
     */
    public function updateAction(Priority $priority)
    {
        return $this->update($priority);
    }

    /**
     * @param Priority $entity
     * @return array|RedirectResponse
     */
    protected function update(Priority $entity)
    {
        return $this->get('oro_form.model.update_handler')->handleUpdate(
            $entity,
            $this->get('academic_bts.form.priority'),
            function (Priority $entity) {
                return [
                    'route' => 'bts_priority_update',
                    'parameters' => array('id' => $entity->getId()),
                ];
            },
            function () {
                return [
                    'route' => 'bts_priority_index',
                ];
            },
            $this->get('translator')->trans('academic.bts.controller.priority.saved.message'),
            $this->get('academic_bts.form.handler.priority')
        );
    }
}
