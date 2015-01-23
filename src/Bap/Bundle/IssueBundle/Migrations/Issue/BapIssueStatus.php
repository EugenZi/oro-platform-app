<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:02 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;
use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;

/**
 * Class BapIssueStatus
 * @package Bap\Bundle\IssueBundle\Migrations\Issue
 */
class BapIssueStatus extends AbstractMigration
{

    protected function getTableName()
    {
        return IssuePriority::TABLE_NAME;
    }

    protected function addColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);

        return $table;
    }

    protected function addIndexKeys(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'BAP_ISSUE_STATUS_NAME_FIELD_IDX');

        return $table;
    }
}