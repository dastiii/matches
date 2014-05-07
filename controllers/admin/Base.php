<?php
/**
 * Matches base controller
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Controllers\Admin;

defined('ACCESS') or die('no direct access');

class Base extends \Ilch\Controller\Admin
{
    public function init()
    {
        $this->getLayout()->addMenu(
            'Matches',
            array
            (
                array
                (
                    'name' => 'Verwalten',
                    'active' => $this->getRequest()->getActionName() == 'index' ? true : false,
                    'icon' => 'fa fa-th-list',
                    'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'index'))
                ),
                array
                (
                    'name' => 'Match erstellen',
                    'active' => $this->getRequest()->getActionName() == 'new' ? true : false,
                    'icon' => 'fa fa-plus',
                    'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'new'))
                ),
            )
        );
    }
}
