<?php

namespace Bap\Bundle\IssueBundle\Grid\Formatter;

use Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface;
use Oro\Bundle\DataGridBundle\Extension\Formatter\Property\AbstractProperty;

use Bap\Bundle\IssueBundle\Twig\Helper\IssueHelper;

/**
 * Class IssueTypeProperty
 * @package Bap\Bundle\IssueBundle\Grid\Formatter
 */
class IssueTypeProperty extends AbstractProperty
{
    /**
     * @var IssueHelper
     */
    protected $issueHelper;

    /**
     * @param IssueHelper $issuerHelper
     */
    public function __construct(IssueHelper $issuerHelper)
    {
        $this->issueHelper = $issuerHelper;
    }

    /**
     * @param ResultRecordInterface $record
     *
     * @return mixed
     */
    protected function getRawValue(ResultRecordInterface $record)
    {
        return $this->issueHelper->getTypeValue(
            $record->getValue(
                $this->getOr(self::DATA_NAME_KEY, $this->get(self::NAME_KEY))
            )
        );
    }
}
