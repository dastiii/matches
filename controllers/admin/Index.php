<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Matches\Controllers\Admin;

defined('ACCESS') or die('no direct access');

class Index extends \Ilch\Controller\Admin
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
                    'active' => true,
                    'icon' => 'fa fa-th-list',
                    'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'index'))
                ),
            )
        );
    }

    public function indexAction()
    {

    }
}
