<?php

namespace dastiii\Matches\Models;

defined('ACCESS') or die('no direct access');

/**
 * Match model
 *
 * This is the default match model of the matches module. It represents a
 * whole match and can contain all of its information - if previously set.
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */
class Match extends \Ilch\Model
{
    /**
     * Status Code for unplayed matches
     */
    const NOT_PLAYED = 1;

    /**
     * Status Code for played matches
     */
    const PLAYED = 2;

    /**
     * Status Code for canceled matches
     * Use this if you do not know if the match
     * gets ever played. Alternatively: Remove the
     * match entirely.
     */
    const CANCELED = -1;

    /**
     * Status Code for rescheduled matches
     */
    const RESCHEDULED = 0;

    /**
     * @var integer The id of the match.
     */
    protected $id;

    /**
     * @var \DateTime The \DateTime object of the match
     */
    protected $datetime;

    /**
     * @var object The instance of the home team
     */
    protected $home_team;

    /**
     * @var object The instance of the guest team
     */
    protected $guest_team;

    /**
     * @var string The competitions name
     */
    protected $competition;

    /**
     * @var string The matchday
     */
    protected $matchday;

    /**
     * @var array An array of players
     */
    protected $home_lineup;

    /**
     * @var array An array of players
     */
    protected $guest_lineup;

    /**
     * @var array Match rounds
     */
    protected $rounds;

    /**
     * @var integer Home team points
     */
    protected $home_points;

    /**
     * @var integer Guest team points
     */
    protected $guest_points;

    /**
     * @var string Game
     */
    protected $game;

    /**
     * @var string Report
     */
    protected $report;

    /**
     * @var integer match status
     */
    protected $status;

    /**
     * @var string json_encoded string with inconstant additional information (Information you do not need for every match)
     */
    protected $additional_fields;

    /**
     * Sets the matches id
     *
     * @param integer $id The id of the match
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets the matches id
     *
     * @return integer The id of the match
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the datetime of the match
     *
     * @param \DateTime $datetime The datetime object of the match
     *
     * @return $this
     */
    public function setDatetime(\DateTime $datetime)
    {
        $this->datetime = $datetime;
        return $this;
    }

    /**
     * Gets the datetime of the match
     *
     * @param string $format The desired output format of the datetime
     *
     * @return \DateTime The matches datetime object
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Sets the home team
     *
     * @param object $instance A team model implementing \dastiii\Matches\Models\TeamInterface
     *
     * @return $this
     */
    public function setHomeTeam($instance)
    {
        $this->home_team = $instance;
        return $this;
    }

    /**
     * Gets the home teams instance
     *
     * @return HomeTeam The home teams instance
     */
    public function getHomeTeam()
    {
        return $this->home_team;
    }

    /**
     * Sets the guest teams instance
     *
     * @param object $instance A team model implementing \dastiii\Matches\Models\TeamInterface
     *
     * @return $this
     */
    public function setGuestTeam($instance)
    {
        $this->guest_team = $instance;
        return $this;
    }

    /**
     * Gets the guest teams instance
     *
     * @return GuestTeam The guest teams instance
     */
    public function getGuestTeam()
    {
        return $this->guest_team;
    }

    /**
     * Sets the competitions name
     *
     * @param string $name The competitions name
     *
     * @return $this
     */
    public function setCompetition($name)
    {
        $this->competition = $name;
        return $this;
    }

    /**
     * Gets the competitions name
     *
     * @return string The competitions name
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Sets the matchday
     *
     * @param string $matchday The matchday
     *
     * @return $this
     */
    public function setMatchday($matchday)
    {
        $this->matchday = $matchday;
        return $this;
    }

    /**
     * Gets the matchday
     *
     * @return string The matchday
     */
    public function getMatchday()
    {
        return $this->matchday;
    }

    /**
     * Sets the home lineupp
     *
     * @param array $lineup An array of players
     *
     * @return $this
     */
    public function setHomeLineup($lineup)
    {
        $this->home_lineup = $lineup;
        return $this;
    }

    /**
     * Gets the home lineup
     *
     * @return array An array of players
     */
    public function getHomeLineup()
    {
        return $this->home_lineup;
    }

    /**
     * Sets the guest lineup
     *
     * @param array $lineup An array of players
     *
     * @return $this
     */
    public function setGuestLineup($lineup)
    {
        $this->guest_lineup = $lineup;
        return $this;
    }

    /**
     * Gets the guest lineup
     *
     * @return array An array of players
     */
    public function getGuestLineup()
    {
        return $this->guest_lineup;
    }

    /**
     * Sets match rounds
     *
     * @param array $rounds An array of rounds
     *
     * @return $this
     */
    public function setRounds($rounds)
    {
        $this->rounds = $rounds;
        return $this;
    }

    /**
     * Gets match rounds
     *
     * @return array An array of rounds
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Sets the home teams points
     *
     * @param integer $points The amount of points
     *
     * @return $this
     */
    public function setHomePoints($points)
    {
        $this->home_points = $points;
        return $this;
    }

    /**
     * Gets the home teams points
     *
     * @return integer The amount of points
     */
    public function getHomePoints()
    {
        return $this->home_points;
    }

    /**
     * Sets the guest teams points
     *
     * @param integer $points The amount of points
     *
     * @return $this
     */
    public function setGuestPoints($points)
    {
        $this->guest_points = $points;
        return $this;
    }

    /**
     * Gets the guest teams points
     *
     * @return integer The amount of points
     */
    public function getGuestPoints()
    {
        return $this->guest_points;
    }

    /**
     * Sets the matches game
     *
     * @param string $game Game
     *
     * @return $this
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * Gets the matches game
     *
     * @return string Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Sets the match report
     *
     * @param string $report A match report
     *
     * @return $this
     */
    public function setReport($report)
    {
        $this->report = $report;
        return $this;
    }

    /**
     * Gets the match report
     *
     * @return string The match report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Sets the match status
     *
     * @param integer $status_code The status code
     *
     * @return $this
     */
    public function setStatus($status_code)
    {
        $this->status = $status_code;
        return $this;
    }

    /**
     * Gets the match status
     *
     * @return integer The matches status code
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the additional fields
     *
     * @param array $fields An array with additional fields
     *
     * @return $this
     */
    public function setAdditionalFields($fields)
    {
        $this->additional_fields = $fields;
        return $this;
    }

    /**
     * Gets the additional fields
     *
     * @return array An array of additional fields
     */
    public function getAdditionalFields()
    {
        return $this->additional_fields;
    }
}
