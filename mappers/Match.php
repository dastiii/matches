<?php

/**
 * Default match mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Modules\Matches\Mappers;

use \Modules\Matches\Exceptions\UpdateFailed;
use \Modules\Matches\Exceptions\InsertFailed;

defined('ACCESS') or die('no direct access');

class Match extends \Ilch\Mapper
{
    /**
     * @var string The MySQL Table this mapper mainly uses
     */

    protected $db_table = "matches";
    /**
     * Saves or updates a match to the database
     *
     * @param \Matches\Models\Match $opponent
     *
     * @return \Matches\Models\Match
     */
    public function save($match)
    {
        if ($match->getId() === 0) {
            return $this->insert($match);
        } else {
            return $this->update($match);
        }
    }

    /**
     * Inserts a new match to the database
     *
     * @param \Matches\Models\Match $match
     *
     * @throws \Matches\Exceptions\Match\InsertFailed
     *
     * @return \Matches\Models\Match
     */
    protected function insert($match)
    {
        $insert = $this->db()->insert();
        $matchId = $insert->into($this->db_table)
            ->values([
                'home_team'     => $match->getHomeTeam()->getId(),
                'guest_team'    => $match->getGuestTeam()->getId(),
                'guest_lineup'  => $match->getGuestLineup(),
                'game'          => $match->getGame(),
                'competition'   => $match->getCompetition(),
                'matchday'      => $match->getMatchday(),
                'datetime'      => $match->getDatetime(),
                'home_points'   => $match->getHomePoints(),
                'guest_points'  => $match->getGuestPoints(),
                'report'        => $match->getReport(),
                'settings'      => serialize($match->getSettings()),
                'status'        => $match->getStatus(),
            ])->execute();

        if (!$matchId) {
            throw new InsertFailed("Match konnte nicht erstellt werden.");
        }

        $match->setId($matchId);

        return $match;
    }

    /**
     * Updates opponentData to the database
     *
     * @param \Matches\Models\Match $match
     *
     * @throws \Matches\Exceptions\Match\UpdateFailed
     *
     * @return \Matches\Models\Match
     */
    protected function update($match)
    {
        throw new UpdateFailed("Gegner konnte nicht erstellt werden.");
    }
}
