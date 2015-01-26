<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\SecurityBundle\Annotation\Acl;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;

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
     *      class="AcademicBtsBundle:IssuePriority",
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
     * @Route("/priority/create", name="bap_create_priority")
     * @Acl(
     *      id="bts_priority_create",
     *      type="entity",
     *      class="BapIssueBundle:IssuePriority",
     *      permission="CREATE"
     * )
     * @Template("BapIssueBundle:Priority:update.html.twig")
     *
     * @return array
     */
    public function createAction()
    {
        return $this->update(new IssuePriority());
    }

    /**
     * @param IssuePriority $priority
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
    public function updateAction(IssuePriority $priority)
    {
        return $this->update($priority);
    }

    /**
     * @param IssuePriority $entity
     * @return array|RedirectResponse
     */
    protected function update(IssuePriority $entity)
    {
        return $this->get('oro_form.model.update_handler')->handleUpdate(
            $entity,
            $this->get('academic_bts.form.priority'),
            function (IssuePriority $entity) {
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
