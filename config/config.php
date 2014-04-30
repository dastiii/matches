<?php

/**
 * Matches module config
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Config;

defined('ACCESS') or die('no direct access');

class Config extends \Ilch\Config\Install
{
    public $config = array
    (
        'key' => 'matches',
        'author' => 'Tobias Schwarz',
        'icon_small' => 'matches.png',
        'languages' => array
        (
            'de_DE' => array
            (
                'name' => 'Matches',
                'description' => 'Hier können Matches, Gegner und auch Herausforderungen (FightUs) verwaltet werden.',
            ),
            'en_EN' => array
            (
                'name' => 'Matches',
                'description' => 'This is where you can manage your matches, opponents and accept or decline challenges (FightUs) by others.',
            ),
        )
    );

    public function install()
    {
        $this->db()->queryMulti($this->getInstallSql());
    }

    public function uninstall()
    {
        $this->db()->queryMulti('');
    }

    public function getInstallSql()
    {
        return 'CREATE TABLE `ilch_matches_opponents` (
                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL,
                  `short_name` varchar(25) NOT NULL,
                  `logo` varchar(255) NOT NULL,
                  `url` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
    }
}
