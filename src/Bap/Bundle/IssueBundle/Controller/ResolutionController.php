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
     * @Route("/resolution", name="bts_resolution_index")
     * @Acl(
     *      id="bts_resolution_view",
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
     * @Route("/resolution/create", name="bap_create_resolution")
     * @Acl(
     *      id="bap_create_resolution",
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
     * @Route("/resolution/update/{id}", name="bts_resolution_update", requirements={"id"="\d+"})
     * @Acl(
     *      id="bts_resolution_update",
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
        return $this->get('oro_form.model.update_handler')->handleUpdate(
            $entity,
            $this->get('academic_bts.form.resolution'),
            function (Resolution $entity) {
                return [
                    'route' => 'bts_resolution_update',
                    'parameters' => [
                        'id' => $entity->getId()
                    ],
                ];
            },
            function () {
                return [
                    'route' => 'bap_resolution',
                ];
            },
            $this->get('translator')->trans('academic.bts.controller.resolution.saved.message'),
            $this->get('academic_bts.form.handler.resolution')
        );
    }
}
