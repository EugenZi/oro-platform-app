<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\SecurityBundle\Annotation\Acl;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;
use Bap\Bundle\IssueBundle\Common\Controller\RouteParametersTrait;

/**
 * Class PriorityController
 * @package Bap\Bundle\IssueBundle\Controller
 */
class PriorityController extends Controller
{
    use RouteParametersTrait;

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
        $issuePriorityEntity = $this
            ->container
            ->getParameter('bap_issue.entity.issue.priority.class');

        return [
            'entity_class' => $issuePriorityEntity
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
        $message = $this
            ->get('translator')
            ->trans('bap_issue.controller.priority.saved.message');

        return $this
            ->get('oro_form.model.update_handler')
            ->handleUpdate(
                $entity,
                $this->get('bap_issue.form.priority'),
                $this->getRouteParams('bap_update_priority', $entity),
                $this->getRouteParams('bap_priorities'),
                $message,
                $this->get('bap_issue.form.handler.priority')
            );
    }
}
