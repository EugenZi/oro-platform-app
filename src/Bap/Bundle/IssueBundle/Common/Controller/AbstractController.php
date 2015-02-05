<?php
/**
 * User: ezi
 * Date: 2/5/15
 * Time: 4:06 PM
 */

namespace Bap\Bundle\IssueBundle\Common\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

abstract class      AbstractController
         extends    Controller
         implements StandardControllerInterface
{
    use ControllerHelperTrait;

    /**
     * @param mixed $entity
     * @param array $params
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function validateAndStoreEntity($entity, array $params = [])
    {
        $returnData  = null;
        $messages    = $this->getTranslationMessages();

        if ($this->get('bap_issue.form.handler.issue')->process($entity)) {

            $successMessage = $this
                ->get('translator')
                ->trans($messages['save']['success']);

            $this->setFlashMessage('success', $successMessage);

            $returnData = $this
                ->get('oro_ui.router')
                ->redirectAfterSave(
                    $this->getRouteParams('bap_issues'),
                    $this->getRouteParams('bap_issue_view', $entity)
                );
        } else {
            $returnData = array_merge($params, [
                'entity' => $entity,
                'form'   => $this->get('bap_issue.form.issue')->createView(),
            ]);
        }

        return $returnData;
    }

    /**
     * @return array|RedirectResponse
     */
    protected function handleSave()
    {
        $messages   = $this->getTranslationMessages();
        $httpMethod = $this->get('request')->getMethod();
        $message    = $messages[strtolower($httpMethod)];

        return $this->storeEntity($message);
    }

    /**
     * @return string
     */
    public function getCurrentRouteName()
    {
        return $this
            ->container
            ->get('request')
            ->get('_route');
    }

    /**
     * @return string
     */
    public function getPreviousRouteName()
    {
        return $this
            ->get('request')
            ->get('headers')
            ->get('referrer');
    }

    private function storeEntity($message)
    {
        return $this
            ->get('oro_form.model.update_handler')
            ->handleUpdate(
                $this->getBaseEntity(),
                $this->getForm(),
                $this->getRouteParams(
                    $this->getCurrentRouteName(),
                    $this->getBaseEntity()
                ),
                $this->getRouteParams(
                    $this->getPreviousRouteName()
                ),
                $message,
                $this->getFormHandler()
            );
    }
}