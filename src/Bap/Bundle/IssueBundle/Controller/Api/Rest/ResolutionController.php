<?php

namespace Bap\Bundle\IssueBundle\Controller\Api\Rest;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Oro\Bundle\SoapBundle\Form\Handler\ApiFormHandler;

use Bap\Bundle\IssueBundle\Entity\Resolution;

/**
 * @RouteResource("resolution")
 * @NamePrefix("bap_api_")
 */
class ResolutionController extends RestController implements ClassResourceInterface
{
    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Resolution",
     *      resource=true
     * )
     * @Acl(
     *      id="bap_resolution_delete",
     *      type="entity",
     *      permission="DELETE",
     *      class="BapIssueBundle:Resolution"
     * )
     * @return Response
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * @return ObjectManager
     */
    protected function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Get entity Manager
     *
     * @return ApiEntityManager
     */
    public function getManager()
    {
        return $this->get('bap_issue.form.resolution');
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->get('bap_issue.form.resolution.api');
    }

    /**
     * @return ApiFormHandler
     */
    public function getFormHandler()
    {
        return $this->get('bap_issue.form.handler.resolution.api');
    }
}
