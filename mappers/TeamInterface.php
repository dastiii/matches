<?php

/**
 * Interface for the team mapper
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Matches\Mappers;

interface TeamInterface
{
    public function find($id);
    public function findByNameLike($name);
}
