<?php

/**
 * Default opponent mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Mappers;

class Opponent extends \Ilch\Mapper
{
    /**
     * @var string The MySQL Table this mapper mainly uses
     */
    protected $db_table = "matches_opponents";

    /**
     * @var array Default criteria for opponents (default scope)
     */
    protected $default_criteria = array(
        'where' => '',
        'order' => array('name' => 'ASC'),
        'limit' => '',
    );

    /**
     * Finds the desired opponent
     *
     * @param integer $id The id of the opponent you wish to find
     *
     * @return object|null The opponent object or null if no opponent with $id was found
     */
    public function find($id)
    {
        $select = $this->db()->selectRow(array('id', 'name', 'short_name', 'logo'))
            ->from($this->db_table)
            ->where(array('id' => $id))
            ->limit(1)
            ->execute();

        if ($select !== null) {
            $opponent = new \Matches\Models\Opponent;
            $opponent
                ->setId($select['id'])
                ->setName($select['name'])
                ->setShortName($select['short_name'])
                ->setLogo($select['logo'])
                ->setUrl($select['url']);

            return $opponent;
        }

        return null;
    }

    /**
     * Finds all opponents
     *
     * @param array|null $criteria Find teams matching this criteria
     *                             NOTE: Limit gets overriden if you pass in a Pagination instance
     * @param \Ilch\Pagination|null $pagination Pagination instance
     *
     * @return array Empty array or array with \Matches\Models\Opponent instances
     */
    public function findAll($criteria = null, $pagination = null)
    {
        $select = $this->db()->selectArray(array('id', 'name', 'short_name', 'logo', 'url'))
            ->from($this->db_table);

        $dbCriteria = $this->default_criteria;

        if ($criteria !== null && is_array($criteria)) {
            $dbCriteria = array_merge($dbCriteria, $criteria);
        }

        if ($dbCriteria['where']) {
            $select->where($dbCriteria['where']);
        }

        if ($dbCriteria['order']) {
            $select->order($dbCriteria['order']);
        }

        if ($dbCriteria['limit']) {
            $select->limit($dbCriteria['limit']);
        }

        if ($pagination !== null) {
            $select->limit($pagination->getLimit());
            $pagination->setRows($select->getCount());
        }

        $rows = $select->execute();
        $opponents = array();

        foreach ($rows as $row) {
            $opponent = new \Matches\Models\Opponent;
            $opponent
                ->setId($row['id'])
                ->setName($row['name'])
                ->setShortName($row['short_name'])
                ->setLogo($row['logo'])
                ->setUrl($row['url']);
            $opponents[] = $opponent;
        }

        return $opponents;
    }
}
