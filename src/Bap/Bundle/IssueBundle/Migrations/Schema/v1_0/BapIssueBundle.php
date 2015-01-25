<?php
/**
 * User: ezi
 */

namespace Bap\Bundle\IssueBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssue;

/**
 * Class BapIssueBundle
 *
 * @package Bap\Bundle\IssueBundle\Migrations\Schema\v1_0
 */
class BapIssueBundle implements Migration
{

    /**
     * Modifies the given schema to apply necessary changes of a database
     * The given query bag can be used to apply additional SQL queries before and after schema changes
     *
     * @param Schema $schema
     * @param QueryBag $queries
     * @return void
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $issue = new BapIssue($schema);

        $issue->setup();
    }
}