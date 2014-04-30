<?php

/**
 * Default team mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Mappers;

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

        if ($select !== null) {
            $team = new \Matches\Models\Team;
            $team
                ->setId($select['id'])
                ->setName($select['name'])
                ->setShortName($select['short_name'])
                ->setLogo($select['logo']);

            return $team;
        }

        return null;
    }

    /**
     * Retrieve all teams whose name is like $name
     *
     * @param string $name The name to look for
     *
     * @return array An array of teams
     */
    public function findByNameLike($name)
    {
        $sql = "SELECT `id`, `name` FROM [prefix]_{$this->db_table} WHERE `name` LIKE '%{$this->db()->escape($name)}%' ORDER BY `name`";
        $teamsArray = $this->db()->queryArray($sql);

        if (empty($teamsArray)) {
            return array();
        }

        $teams = array();

        foreach ($teamsArray as $row) {
            $team = new \Matches\Models\Team;
            $team
                ->setId($row['id'])
                ->setName($row['name']);
            $teams[] = $team;
        }

        return $teams;
    }

    /**
     * Finds all teams
     *
     * @return array Empty array or array with \Matches\Models\Team instances
     */
    public function findAll()
    {
        $select = $this->db()->selectArray(array('id', 'name', 'short_name', 'logo'))
            ->from($this->db_table);

        $dbCriteria = $this->default_criteria;

        if ($dbCriteria['where']) {
            $select->where($dbCriteria['where']);
        }

        if ($dbCriteria['order']) {
            $select->order($dbCriteria['order']);
        }

        if ($dbCriteria['limit']) {
            $select->limit($dbCriteria['limit']);
        }

        $rows = $select->execute();
        $teams = array();

        foreach ($rows as $row) {
            $team = new \Matches\Models\Team;
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
