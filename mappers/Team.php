<?php

/**
 * Default team mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Modules\Matches\Mappers;

use \Modules\Matches\Exceptions\InsertFailed;
use \Modules\Matches\Exceptions\UpdateFailed;
use \Modules\Matches\Exceptions\NotFound;

use \Modules\Matches\Models\Team as Model;

defined('ACCESS') or die('no direct access');

class Team extends \Ilch\Mapper
{
    /**
     * @var string The MySQL Table this mapper mainly uses
     */
    protected $db_table = "teams_";

    /**
     * @var array Default criteria for opponents (default scope)
     */
    protected $default_criteria = array(
        'where' => '',
        'order' => array('name' => 'ASC'),
        'limit' => '',
    );

    /**
     * Retrieves the desired team
     *
     * @param integer $id The id of the team you wish to find
     *
     * @return object|null The team object or null if no team with $id was found
     */
    public function find($id)
    {
        $select = $this->db()->selectRow(array('id', 'name', 'short_name', 'logo'))
            ->from($this->db_table)
            ->where(array('id' => $id))
            ->limit(1)
            ->execute();

        $select = $this->db()->select();
        $result = $select->fields(['id', 'name', 'short_name', 'logo'])
            ->from($this->db_table)
            ->where(['id' => $id])
            ->limit(1)
            ->execute();

        if ($result->getNumRows() === 1) {
            $team = new Model;
            $team
                ->setId($select['id'])
                ->setName($select['name'])
                ->setShortName($select['short_name'])
                ->setLogo($select['logo']);

            return $team;
        } else {
            throw new NotFound("Team not found");
        }

        return null;
    }

    /**
     * Finds all teams
     *
     * @return array Empty array or array with \Matches\Models\Team instances
     */
    public function findAll()
    {
        $select = $this->db()->select();
        $result = $select->fields(['id', 'name', 'short_name', 'logo'])
            ->from($this->db_table);

        $dbCriteria = $this->default_criteria;

        if ($dbCriteria['where']) {
            $result->where($dbCriteria['where']);
        }

        if ($dbCriteria['order']) {
            $result->order($dbCriteria['order']);
        }

        if ($dbCriteria['limit']) {
            $result->limit($dbCriteria['limit']);
        }

        $result = $result->execute();
        $teams = array();

        while ($row = $result->fetchAssoc()) {
            $team = new Model;
            $team
                ->setId($row['id'])
                ->setName($row['name'])
                ->setShortName($row['short_name'])
                ->setLogo($row['logo']);
            $teams[] = $team;
        }

        return $teams;
    }
}
