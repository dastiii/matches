<?php
/**
 * Matches controller
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Modules\Matches\Controllers\Admin;

use \Modules\Matches\Mappers\Opponent   as OpponentMapper;
use \Modules\Matches\Mappers\Team       as TeamMapper;
use \Modules\Matches\Mappers\Match      as MatchMapper;
use \Modules\Matches\Models\Match;
use \Modules\Matches\Models\Opponent;

defined('ACCESS') or die('no direct access');

class Index extends Base
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $data = ['name' => 'a', 'datetime' => '28.05.2014 13:31:21', 'password' => '12345', 'password_confirmation' => '123456'];

        $validation = new \Ilch\Validator;
        $validation->addRules([
            'name' => [
                'required',
                'maxLength' => 30,
                'minLength' => 5,
                'breakChain',
                'filters' => [
                    'before' => ['ucfirst' => [\Ilch\Validator::SELF]],
                    'after'  => [
                        'trim' => [\Ilch\Validator::SELF]
                    ]
                ]
            ],
            'datetime' => [
                'required',
                'datetime' => [
                    'format' => 'd.m.Y H:i:s',
                ],
            ],
            'password' => [
                'required',
                'minLength' => '6',
                'same' => [
                    'as' => 'password_confirmation'
                ],
                'filters' => [
                    'after' => ['crypt' => [\Ilch\Validator::SELF]]
                ],
                'breakChain'
            ],
        ]);



        dumpVar(function_exists('DateTime::createFromFormat'));

        if (class_exists('DateTime::createFromFormat')) {
            echo "Geht";
        }

        $validation->validate($data);

        dumpVar($validation);

        $filter = new \Ilch\Filters\StringToLower;
        echo $filter->filter('ICH BIN UPPERCASE');

        $this->getRequest()->setIsAjax(true);
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
                } catch (\Matches\Exceptions\InsertFailed $e) {
                    // TODO: Log
                    $this->addMessage($this->t("opponent_insert_failed"), "danger");
                    $this->redirect(array('action' => 'create'));
                }
            } else {
                try {
                    $opponent = $opponentMapper->find((int)$this->input('match.opponent.id'));
                } catch (\Matches\Exceptions\NotFound $e) {
                    // TODO: Log
                    $this->addMessage($this->t("opponent_not_found"), "danger");
                    $this->redirect(array('action' => 'create'));
                }
            }

            try {
                $teamMapper = new TeamMapper;
                $team = $teamMapper->find((int)$this->input('match.team'));
            } catch (\Matches\Exceptions\NotFound $e) {
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

            $match->setHomeTeam($team)
                  ->setGuestTeam($opponent)
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
            } catch (\Matches\Exceptions\InsertFailed $e) {
                // TODO: Log
                $this->addMessage($this->t("match_insert_failed"), "danger");
                $this->redirect(array('action' => 'create'));
            }
        } else {
            $this->redirect(array('action' => 'index'));
        }
    }
}
