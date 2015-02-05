<?php
/**
 * User: ezi
 * Date: 2/5/15
 * Time: 4:01 PM
 */

namespace Bap\Bundle\IssueBundle\Common\Controller;

use Symfony\Component\Form\FormInterface;

interface StandardControllerInterface
{
    /**
     * @return FormInterface
     */
    function getForm();

    /**
     * @return FormHandlerInterface
     */
    function getFormHandler();

    /**
     * @return mixed
     */
    function getCurrentRouteName();

    /**
     * @return mixed
     */
    function getPreviousRouteName();

    /**
     * @return mixed
     */
    function getBaseEntity();

    /**
     * @return array
     */
    function getTranslationMessages();
}