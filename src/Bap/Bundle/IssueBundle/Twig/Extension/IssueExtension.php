<?php

namespace Bap\Bundle\IssueBundle\Twig\Extension;

use Bap\Bundle\IssueBundle\Twig\Helper\IssueHelper;

/**
 * Class IssueExtension
 * @package Bap\Bundle\IssueBundle\Twig\Extension
 */
class IssueExtension extends \Twig_Extension
{
    /**
     * Twig extension name
     */
    const EXTENSION_NAME = 'bap_issue_extension';

    /**
     * Twig helper name that provides to Twig_SimpleFunction constructor
     */
    const HELPER_NAME    = 'get_issue_type_title';

    /**
     * Method name that contains extension logic
     */
    const CALLED_METHOD  = 'getIssueTypeTitle';

    /**
     * @var IssueHelper
     */
    protected $issueHelper;

    /**
     * @param IssueHelper $issueHelper
     */
    public function __construct(IssueHelper $issueHelper)
    {
        $this->issueHelper = $issueHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                self::HELPER_NAME,
                [
                    $this,
                    self::CALLED_METHOD
                ]
            ),
        ];
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getIssueTypeTitle($type)
    {
        return $this->issueHelper->getTypeValue($type);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return self::EXTENSION_NAME;
    }
}
