<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Bap\Bundle\IssueBundle\Entity\IssueType;
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
     * @Route("/issue/view/{id}", name="bap_issue", requirements={"id"="\d+"})
     * @Template()
     * @Acl(
     *      id="bap_issue_view",
     *      type="entity",
     *      class="BapIssueBundle:Issue",
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
     * @Route("/issue", name="bap_issues")
     * @Template()
     * @AclAncestor("bap_issue_view")
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('bap_issue.entity.issue.class'),
        ];
    }

    /**
     * @Route("/issue/create", name="bap_create_issue")
     * @Template("BapIssueBundle:Issue:update.html.twig")
     * @Acl(
     *      id="bap_create_issue",
     *      type="entity",
     *      class="BapIssueBundle:Issue",
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
     * @Route("/issue/create_from_widget/{id}", name="bap_create_issue_widget", requirements={"id"="\d+"})
     * @Template("BapIssueBundle:Issue:update.html.twig")
     * @Acl(
     *      id="bap_create_issue_widget",
     *      type="entity",
     *      class="BapIssueBundle:Issue",
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

        $responseData = [
            'entity' => $entity,
            'saved' => false
        ];

        if ($this->get('bap_issue.form.handler.issue')->process($entity)) {
            $responseData['saved'] = true;
        }

        $responseData['form'] = $this->get('bap_issue.form.issue')->createView();

        return $responseData;
    }

    /**
     * @param Issue $issue
     * @Route("/issue/update/{id}", name="bap_update_issue", requirements={"id"="\d+"})
     * @Acl(
     *      id="bap_update_issue",
     *      type="entity",
     *      class="BapIssueBundle:Issue",
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
     * @Route("/widget/info/{id}", name="bap_issue", requirements={"id"="\d+"})
     * @Acl(
     *      id="bap_issue_view",
     *      type="entity",
     *      class="BapIssueBundle:Issue",
     *      permission="VIEW"
     * )
     *
     * @Template("BapIssueBundle:Issue/widget:info.html.twig")
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
     * @Route("/issue/subtask/{id}", name="bap_add_issue_sub_task", requirements={"id"="\d+"})
     * @Template()
     * @Acl(
     *      id="bap_add_issue_sub_task",
     *      type="entity",
     *      class="BapIssueBundle:Issue",
     *      permission="EDIT"
     * )
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addSubTaskAction(Issue $parent)
    {
        if ($parent->getType() != IssueType::STORY_TYPE) {
            throw new HttpException(
                400,
                $this->get('translator')
                    ->trans(
                        'bap_issue.controller.issue.adding_subtask.message',
                        ['%type%' => $parent->getType()]
                    )
            );
        }

        $subTask = new Issue();

        $subTask->setType(IssueType::SUB_TASK_TYPE);
        $subTask->setParent($parent);
        $subTask->setReporter($this->getUser());

        return $this->update(
            $subTask,
            [
                'cancelPath' => $this
                    ->get('router')
                    ->generate(
                        'bap_issue',
                        ['id' => $parent->getId()]
                    ),
            ]
        );
    }

    /**
     * @param Issue $issue
     *
     * @Route("/widget/collaborators/{id}", name="bap_issue_collaborators", requirements={"id"="\d+"})
     * @Template("BapIssueBundle:Issue/widget:collaborators.html.twig")
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
     * @Route("/widget/user_issues/{id}", name="bap_issue_user_issues", requirements={"id"="\d+"})
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
        if ($this->get('bap_issue.form.handler.issue')->process($entity)) {

            $this
                ->get('session')
                ->getFlashBag()
                ->add(
                    'success',
                    $this
                        ->get('translator')
                        ->trans('bap_issue.controller.issue.saved.message')
                );

            return $this
                ->get('oro_ui.router')
                ->redirectAfterSave(
                    [
                        'route' => 'bap_update_issue',
                        'parameters' => [
                            'id' => $entity->getId()
                        ],
                    ],
                    [
                        'route' => 'bap_issue_view',
                        'parameters' => ['id' => $entity->getId()],
                    ]
                );
        }

        return array_merge($params, [
            'entity' => $entity,
            'form'   => $this->get('bap_issue.form.issue')->createView(),
        ]);
    }
}
