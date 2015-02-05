<?php

namespace Bap\Bundle\IssueBundle\Common\Helper;

use Oro\Bundle\TranslationBundle\Translation\Translator;

use Bap\Bundle\IssueBundle\Entity\IssueType;

/**
 * Class IssueHelper
 * @package Bap\Bundle\IssueBundle\Twig\Helper
 */
class IssueHelper
{
    /**
     * Not available issue type
     */
    const TYPE_NOT_AVAILABLE = 'N/A';

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return \ArrayObject
     */
    public function getTypesList()
    {
        return new \ArrayObject([
            IssueType::STORY_TYPE    => $this->translator->trans('bap_issue.issue.type.story'),
            IssueType::TASK_TYPE     => $this->translator->trans('bap_issue.issue.type.task'),
            IssueType::BUG_TYPE      => $this->translator->trans('bap_issue.issue.type.bug'),
            IssueType::SUB_TASK_TYPE => $this->translator->trans('bap_issue.issue.type.sub_task'),
        ], \ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * @param $type
     * @return string
     */
    public function getTypeValue($type)
    {
        $types      = $this->getTypesList();
        $issueType  = self::TYPE_NOT_AVAILABLE;

        if ($types->offsetExists($type)) {
            $issueType = $types->offsetGet($type);
        }

        return $issueType;
    }
}
