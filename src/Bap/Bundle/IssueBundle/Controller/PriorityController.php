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
     * @Route("/priority", name="bap_priorities")
     * @Acl(
     *      id="bap_priorities",
     *      type="entity",
     *      class="BapIssueBundle:IssuePriority",
     *      permission="VIEW"
     * )
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('bap_issue.priority.entity.class'),
        ];
    }

    /**
     * @Route("/priority/create", name="bap_create_priority")
     * @Acl(
     *      id="bap_create_priority",
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
     * @Route("/priority/update/{id}", name="bap_update_priority", requirements={"id"="\d+"})
     * @Acl(
     *      id="bap_update_priority",
     *      type="entity",
     *      class="BupIssueBundle:IssuePriority",
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
        return $this
            ->get('oro_form.model.update_handler')
            ->handleUpdate(
                $entity,
                $this->get('bap_issue.form.priority'),
                $this->saveAndStayRouteCallback($entity),
                $this->saveAndCloseRouteCallback(),
                $this->get('translator')->trans('bap_issue.controller.priority.saved.message'),
                $this->get('bap_issue.form.handler.priority')
            );
    }

    /**
     * @param IssuePriority $entity
     * @return \Closure
     */
    private function saveAndStayRouteCallback(IssuePriority $entity)
    {
        function () use ($entity) {
            return [
                'route' => 'bap_update_issue_priority',
                'parameters' => [
                    'id' => $entity->getId()
                ]
            ];

        };
    }

    /**
     * @return \Closure
     */
    private function saveAndCloseRouteCallback()
    {
        return function () {
            return [
                'route' => 'bap_issue_priority',
            ];
        };
    }
}
