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
use FOS\RestBundle\Controller\Annotations\QueryParam;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Oro\Bundle\SoapBundle\Form\Handler\ApiFormHandler;

use Bap\Bundle\IssueBundle\Entity\Issue;

/**
 * @RouteResource("issue")
 * @NamePrefix("bts_api_")
 */
class IssueController extends RestController implements ClassResourceInterface
{
    /**
     * Get the list of users
     *
     * @QueryParam(
     *      name="page",
     *      requirements="\d+",
     *      nullable=true,
     *      description="Page number, starting from 1. Defaults to 1."
     * )
     * @QueryParam(
     *      name="limit",
     *      requirements="\d+",
     *      nullable=true,
     *      description="Number of items per page. defaults to 10."
     * )
     *
     * @ApiDoc(
     *      description="Get the list of issues",
     *      resource=true,
     *      filters={
     *          {"name"="page", "dataType"="integer"},
     *          {"name"="limit", "dataType"="integer"}
     *      }
     * )
     * @AclAncestor("bts_user_view")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgetAction()
    {
        $page = intval($this->get('request')->get('page', 1));
        $limit = intval($this->get('request')->get('limit', self::ITEMS_PER_PAGE));

        return $this->handleGetListRequest($page, $limit);
    }

    /**
     * Get user data
     *
     * @param int $id User id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @ApiDoc(
     *      description="Get issue data",
     *      resource=true,
     *      requirements={
     *          {"name"="id", "dataType"="integer"},
     *      }
     * )
     * @AclAncestor("bap_issue_view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * Create new user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @ApiDoc(
     *      description="Create new issue",
     *      resource=true
     * )
     * @AclAncestor("bap_create_issue")
     */
    public function postAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * Update existing user
     *
     * @param int $id User id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @ApiDoc(
     *      description="Update existing issue",
     *      resource=true,
     *      requirements={
     *          {"name"="id", "dataType"="integer"},
     *      }
     * )
     * @AclAncestor("bap_update_issue")
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Issue",
     *      resource=true
     * )
     * @Acl(
     *      id="bts_issue_delete",
     *      type="entity",
     *      permission="DELETE",
     *      class="AcademicBtsBundle:Issue"
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
        return $this->get('bap.issue.manager.api');
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->get('bap.form.issue.api');
    }

    /**
     * @return ApiFormHandler
     */
    public function getFormHandler()
    {
        return $this->get('bap.form.handler.issue.api');
    }
}
