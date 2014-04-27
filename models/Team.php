<?php

namespace dastiii\Matches\Models;

defined('ACCESS') or die('no direct access');

/**
 * Default team model
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */
class Team extends \Ilch\Model implements TeamInterface
{
    /**
     * The id of the team.
     *
     * @var integer
     */
    protected $id;

    /**
     * The name of the team
     *
     * @var string
     */
    protected $name;

    /**
     * The abbreviated name of the team
     *
     * @var string
     */
    protected $short_name;

    /**
     * The logos filepath
     *
     * @var string
     */
    protected $logo;

    /**
     * Sets the id of the team
     *
     * @param integer $id The id of the team
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets the id of the team
     *
     * @return integer The id of the team
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the name of the team
     *
     * @param string $name The name of the team
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the name of the team
     *
     * @return string The name of the team
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the abbreviated version of the teams name
     *
     * @param $short_name string The abbreviated version of the teams name
     *
     * @return $this
     */
    public function setShortName($short_name)
    {
        $this->short_name = $short_name;
        return $this;
    }

    /**
     * Gets the abbreviated version of the teams name
     *
     * @return string The abbreviated version of the teams name
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * Sets the filepath to the teams logo
     *
     * @param string $logo_file The filepath to the teams logo
     *
     * @return $this
     */
    public function setLogo($logo_file)
    {
        $this->logo = $logo_file;
        return $this;
    }

    /**
     * Gets the filepath to the teams logo
     *
     * @return string The filepath to the teams logo
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
