<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\SecurityBundle\Annotation\Acl;

use Bap\Bundle\IssueBundle\Entity\IssueResolution as Resolution;

/**
 * Class ResolutionController
 * @package Bap\Bundle\IssueBundle\Controller
 */
class ResolutionController extends Controller
{
    /**
     * @Route("/resolution", name="bap_resolutions")
     *
     * @Acl(
     *      id="bap_issue_resolutions",
     *      type="entity",
     *      class="AcademicBtsBundle:Resolution",
     *      permission="VIEW"
     * )
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('academic_bts.resolution.entity.class'),
        ];
    }

    /**
     * @Route("/resolution/create", name="bap_issue_create_resolution")
     *
     * @Acl(
     *      id="bap_issue_create_resolution",
     *      type="entity",
     *      class="BapIssueBundle:Resolution",
     *      permission="CREATE"
     * )
     * @Template("BapIssueBundle:Resolution:update.html.twig")
     *
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Resolution());
    }

    /**
     * @param Resolution $resolution
     * @Route("/resolution/update/{id}", name="bap_issue_resolution_update", requirements={"id"="\d+"})
     *
     * @Acl(
     *      id="bap_issue_resolution_update",
     *      type="entity",
     *      class="AcademicBtsBundle:Resolution",
     *      permission="EDIT"
     * )
     * @Template()
     *
     * @return array
     */
    public function updateAction(Resolution $resolution)
    {
        return $this->update($resolution);
    }

    /**
     * @param Resolution $entity
     * @return array|RedirectResponse
     */
    protected function update(Resolution $entity)
    {
        return $this
            ->get('oro_form.model.update_handler')
            ->handleUpdate(
                $entity,
                $this->get('bap_issue.form.resolution'),
                $this->saveAndStayRouteCallback($entity),
                $this->saveAndCloseRouteCallback(),
                $this->get('translator')->trans('bap_issue.controller.resolution.saved.message'),
                $this->get('bap_issue.form.handler.resolution')
            );
    }

    /**
     * @param Resolution $entity
     * @return \Closure
     */
    private function saveAndStayRouteCallback(Resolution $entity)
    {
        return function () use ($entity) {
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
