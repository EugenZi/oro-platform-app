<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\SecurityBundle\Annotation\Acl;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;
use Bap\Bundle\IssueBundle\Common\Controller\ControllerHelperTrait;

/**
 * Class ResolutionController
 * @package Bap\Bundle\IssueBundle\Controller
 */
class ResolutionController extends Controller
{
    use ControllerHelperTrait;

    /**
     * @Route("/resolution", name="bap_resolutions")
     *
     * @Acl(
     *      id="bap_issue_resolutions",
     *      type="entity",
     *      class="BapIssueBundle:IssueResolution",
     *      permission="VIEW"
     * )
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('bap_issue.entity.issue.resolution.class'),
        ];
    }

    /**
     * @Route("/resolution/create", name="bap_create_resolution")
     *
     * @Acl(
     *      id="bap_create_resolution",
     *      type="entity",
     *      class="BapIssueBundle:IssueResolution",
     *      permission="CREATE"
     * )
     * @Template("BapIssueBundle:Resolution:update.html.twig")
     *
     * @return array
     */
    public function createAction()
    {
        return $this->update(new IssueResolution());
    }

    /**
     * @param IssueResolution $resolution
     * @Route("/resolution/update/{id}", name="bap_update_resolution", requirements={"id"="\d+"})
     *
     * @Acl(
     *      id="bap_update_resolution",
     *      type="entity",
     *      class="BapIssueBundle:IssueResolution",
     *      permission="EDIT"
     * )
     * @Template()
     *
     * @return array
     */
    public function updateAction(IssueResolution $resolution)
    {
        return $this->update($resolution);
    }

    /**
     * @param IssueResolution $entity
     * @return array|RedirectResponse
     */
    protected function update(IssueResolution $entity)
    {
        return $this
            ->get('oro_form.model.update_handler')
            ->handleUpdate(
                $entity,
                $this->get('bap_issue.form.resolution'),
                $this->getRouteParams('bap_update_resolution', $entity),
                $this->getRouteParams('bap_resolutions'),
                $this->get('translator')->trans('bap_issue.controller.resolution.saved.message'),
                $this->get('bap_issue.form.handler.resolution')
            );
    }
}
