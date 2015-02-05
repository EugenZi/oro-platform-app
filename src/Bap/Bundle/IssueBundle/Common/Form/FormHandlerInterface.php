<?php
/**
 * User: ezi
 * Date: 2/5/15
 * Time: 7:41 PM
 */

namespace Bap\Bundle\IssueBundle\Common\Form;


interface FormHandlerInterface
{
    /**
     * @return boolean
     */
    public function process();

    /**
     * @return mixed
     */
    public function getTargetEntity();
}