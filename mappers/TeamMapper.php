<?php

/**
 * Default team mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Mappers;

use Matches\Models\Team;

class TeamMapper extends \Ilch\Mapper
{
    protected $db_table = "teams_";

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
            $team = new Team;
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
}
