<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:03 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;

use Doctrine\DBAL\Schema\Table;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;
use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;

class BapIssueResolution extends AbstractMigration
{
    /**
     * @param Table $table
     * @return Table
     */
    protected function addColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);

        return $this;
    }

    /**
     * @param Table $table
     * @return Table
     */
    protected function addIndexKeys(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'BAP_ISSUE_RESOLUTION_NAME_UNIQUE_INDEX');

        return $this;
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return IssueResolution::TABLE_NAME;
    }
}