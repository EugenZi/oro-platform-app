<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:01 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Table;

use Bap\Bundle\IssueBundle\Entity\IssueType;

/**
 * Class BapIssueType
 * @package Bap\Bundle\IssueBundle\Migrations\Issue
 */
class BapIssueType extends AbstractMigration
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return IssueType::TABLE_NAME;
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);

        return $table;
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addIndexKeys(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'BAP_ISSUE_TYPE_NAME_UNIQUE_INDEX');

        return $table;
    }
}