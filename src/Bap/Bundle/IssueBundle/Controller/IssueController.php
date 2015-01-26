<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

use Bap\Bundle\IssueBundle\Entity\Issue;

/**
 * Class IssueController
 * @package Bap\Bundle\IssueBundle\Controller
 */
class IssueController extends Controller
{
    /**
     * @param Issue $issue
     * @Route("/issue/view/{id}", name="bts_issue_view", requirements={"id"="\d+"})
     * @Template()
     * @Acl(
     *      id="bts_issue_view",
     *      type="entity",
     *      class="AcademicBtsBundle:Issue",
     *      permission="VIEW"
     * )
     *
     * @return array
     */
    public function viewAction(Issue $issue)
    {
        return ['entity' => $issue];
    }

    /**
     * @Route("/issue", name="bts_issue_index")
     * @Template()
     * @AclAncestor("bts_issue_view")
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('academic_bts.issue.entity.class'),
        ];
    }

    /**
     * @Route("/issue/create", name="bts_issue_create")
     * @Template("AcademicBtsBundle:Issue:update.html.twig")
     * @Acl(
     *      id="bts_issue_create",
     *      type="entity",
     *      class="AcademicBtsBundle:Issue",
     *      permission="CREATE"
     * )
     *
     * @return array
     */
    public function createAction()
    {
        $issue = new Issue();
        $issue->setReporter($this->getUser());
        return $this->update($issue);
    }

    /**
     * @param User $user
     *
     * @Route("/issue/create_from_widget/{id}", name="bts_issue_create_widget", requirements={"id"="\d+"})
     * @Template("AcademicBtsBundle:Issue:update.html.twig")
     * @Acl(
     *      id="bts_issue_create_widget",
     *      type="entity",
     *      class="AcademicBtsBundle:Issue",
     *      permission="CREATE"
     * )
     *
     * @return array
     */
    public function createFromWidgetAction(User $user)
    {
        $entity = new Issue();
        $entity->setAssignee($user);
        $entity->setReporter($user);
        $responseData = array(
            'entity' => $entity,
            'saved' => false
        );

        if ($this->get('academic_bts.form.handler.issue')->process($entity)) {
            $responseData['saved'] = true;
        }
        $responseData['form'] = $this->get('academic_bts.form.issue')->createView();

        return $responseData;
    }

    /**
     * @param Issue $issue
     * @Route("/issue/update/{id}", name="bts_issue_update", requirements={"id"="\d+"})
     * @Acl(
     *      id="bts_issue_update",
     *      type="entity",
     *      class="AcademicBtsBundle:Issue",
     *      permission="EDIT"
     * )
     * @Template()
     *
     * @return array
     */
    public function updateAction(Issue $issue)
    {
        return $this->update($issue);
    }

    /**
     * @param Issue $issue
     *
     * @Route("/widget/info/{id}", name="bts_issue_info", requirements={"id"="\d+"})
     * @Template()
     * @Acl(
     *      id="bts_issue_view",
     *      type="entity",
     *      class="AcademicBtsBundle:Issue",
     *      permission="VIEW"
     * )
     *
     * @return array
     */
    public function infoAction(Issue $issue)
    {
        return ['entity' => $issue];
    }

    /**
     * @param Issue $parent
     *
     * @Route("/issue/subtask/{id}", name="bts_issue_add_subtask", requirements={"id"="\d+"})
     * @Template()
     * @Acl(
     *      id="bts_issue_add_sub_task",
     *      type="entity",
     *      class="AcademicBtsBundle:Issue",
     *      permission="EDIT"
     * )
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addSubTaskAction(Issue $parent)
    {
        if ($parent->getType() != Issue::TYPE_STORY) {
            throw new HttpException(
                400,
                $this->get('translator')
                    ->trans(
                        'academic.bts.controller.issue.adding_subtask.message',
                        ['%type%' => $parent->getType()]
                    )
            );
        }

        $subTask = new Issue();
        $subTask->setType(Issue::TYPE_SUB_TASK);
        $subTask->setParent($parent);
        $subTask->setReporter($this->getUser());

        return $this->update(
            $subTask,
            [
                'cancelPath' => $this->get('router')->generate('bts_issue_view', ['id' => $parent->getId()]),
            ]
        );
    }

    /**
     * @param Issue $issue
     *
     * @Route("/widget/collaborators/{id}", name="bts_issue_collaborators", requirements={"id"="\d+"})
     * @Template()
     *
     * @return array
     */
    public function collaboratorsAction(Issue $issue)
    {
        return ['entity' => $issue];
    }

    /**
     * @param User $user
     *
     * @Route("/widget/user_issues/{id}", name="bts_issue_user_issues", requirements={"id"="\d+"})
     * @Template()
     *
     * @return array
     */
    public function userIssuesAction(User $user)
    {
        return ['user' => $user];
    }

    /**
     * @param Issue $entity
     * @param array $params
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function update(Issue $entity, array $params = [])
    {
        if ($this->get('academic_bts.form.handler.issue')->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('academic.bts.controller.issue.saved.message')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                [
                    'route' => 'bts_issue_update',
                    'parameters' => array('id' => $entity->getId()),
                ],
                [
                    'route' => 'bts_issue_view',
                    'parameters' => array('id' => $entity->getId()),
                ]
            );
        }

        return array_merge($params, [
            'entity' => $entity,
            'form' => $this->get('academic_bts.form.issue')->createView(),
        ]);
    }
}
