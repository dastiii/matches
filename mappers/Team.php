<?php

/**
 * Default team mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace dastiii\Matches\Mappers;

use \dastiii\Matches\Models\Match;

class Team extends \Ilch\Mapper
{
    /**
     * Retrieves the desired team
     *
     * @param integer $id The id of the team you wish to find
     *
     * @return object|null The team object or null if no team with $id was found
     */
    public function find($id)
    {
        // TODO: Find a single team
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
        // TODO: Search for teams like $name for autocomplete.
    }
}
