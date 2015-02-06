<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 2/6/15
 * Time: 6:54 AM
 */

namespace Bap\Bundle\IssueBundle\Common\Entity;


interface IssueEntityInterface
{

    /**
     * Issue type task
     */
    const ISSUE    = 'issue';

    /**
     * Issue type task
     */
    const TASK     = 'task';

    /**
     * Issue type story
     */
    const STORY    = 'story';

    /**
     * Issue type sub-task
     */
    const SUB_TASK = 'subTask';

    /**
     * Issue type bug
     */
    const BUG      = 'bug';

    /**
     * Issue type blocker
     */
    const BLOCKER  = 'blocker';

    /**
     * @return string
     */
    public function getType();
}