<?php

/**
 * Team interface
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace dastiii\Matches\Models;

interface TeamInterface
{
    public function getId();
    public function getName();
    public function getLogo();
}
