<?php
/**
 * Matches controller
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Controllers\Admin;

use \Matches\Mappers\Opponent   as OpponentMapper;
use \Matches\Mappers\Team       as TeamMapper;
use \Matches\Mappers\Match      as MatchMapper;
use \Matches\Models\Match;
use \Matches\Models\Opponent;

defined('ACCESS') or die('no direct access');

class Index extends Base
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {

    }

    public function createAction()
    {
        $opponents = new OpponentMapper;
        $teams = new TeamMapper;

        $this->getView()->set('opponents', $opponents->findAll());
        $this->getView()->set('teams', $teams->findAll());
    }

    public function saveAction()
    {
        if ($this->getRequest()->isPost()) {

            $opponentMapper = new OpponentMapper;

            if ((int)$this->input('match.opponent.method') === 0) {
                $opponent = new Opponent;
                $opponent->setName($this->input('match.opponent.name'));
                $opponent->setShortName($this->input('match.opponent.short_name'));

                try {
                    $opponent = $opponentMapper->save($opponent);
                } catch (\Matches\Exceptions\Opponent\InsertFailed $e) {
                    // TODO: Log
                    $this->addMessage($this->t("opponent_insert_failed"), "danger");
                    $this->redirect(array('action' => 'create'));
                }
            } else {
                try {
                    $opponent = $opponentMapper->find((int)$this->input('match.opponent.id'));
                } catch (\Matches\Exceptions\Opponent\NotFound $e) {
                    // TODO: Log
                    $this->addMessage($this->t("opponent_not_found"), "danger");
                    $this->redirect(array('action' => 'create'));
                }
            }

            try {
                $teamMapper = new TeamMapper;
                $team = $teamMapper->find((int)$this->input('match.team'));
            } catch (\Matches\Exceptions\Team\NotFound $e) {
                // TODO: Log
                // Make it compatible to the coming teams module
                $this->addMessage($this->t("team_not_found"), "danger");
                $this->redirect(array('action' => 'create'));
            }

            $match = new Match;

            $settings = array(
                'hide_guest_lineup' => (bool) $this->input('match.settings.hide_guest_lineup'),
                'hide_competition'  => (bool) $this->input('match.settings.hide_competition'),
                'hide_matchday'     => (bool) $this->input('match.settings.hide_matchday'),
                'hide_report'       => (bool) $this->input('match.settings.hide_report'),
            );

            $match->setHomeTeam($team->getId())
                  ->setGuestTeam($opponent->getId())
                  ->setGuestLineup($this->input('match.guest_lineup'))
                  ->setGame($this->input('match.game'))
                  ->setCompetition($this->input('match.competition'))
                  ->setMatchday($this->input('match.matchday'))
                  ->setDatetime(new \Ilch\Date($this->input('match.datetime')))
                  ->setHomePoints($this->input('match.points_home'))
                  ->setGuestPoints($this->input('match.points_guest'))
                  ->setReport($this->input('match.report'))
                  ->setSettings($settings)
                  ->setStatus(Match::NOT_PLAYED);

            $matchMapper = new MatchMapper;

            try {
                $matchMapper->save($match);

                $this->addMessage("match_saved");
                $this->redirect(array('action' => 'index'));
            } catch (\Matches\Exceptions\Match\InsertFailed $e) {
                // TODO: Log
                $this->addMessage($this->t("match_insert_failed"), "danger");
                $this->redirect(array('action' => 'create'));
            }
        } else {
            $this->redirect(array('action' => 'index'));
        }
    }
}
