<?php
/**
 * Matches controller
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Controllers\Admin;

use \Matches\Mappers\Opponent as OpponentMapper;
use \Matches\Mappers\Team as TeamMapper;

defined('ACCESS') or die('no direct access');

class Create extends Base
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $opponents = new OpponentMapper;
        $teams = new TeamMapper;

        $this->getView()->set('opponents', $opponents->findAll());
        $this->getView()->set('teams', $teams->findAll());
    }

    public function teammembersAction()
    {
        if ($this->getRequest()->isAjax()) {
            $options = array("Hans", "Wurst", "Peter", "xXKarlXx", "eugen");
            $returnStr = '';
            foreach ($options as $option) {
                $returnStr .= "<option value=\"{$option}\">{$option}</option>";
            }
            echo $returnStr;
        } else {
            $this->redirect(array('action' => 'index'));
        }
    }
}
