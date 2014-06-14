<?php

/**
 * Test validation class
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

namespace Modules\Matches\Validators;

class Test extends \Ilch\Validators\Base
{
    /**
     * @var mixed The value to validate
     */
    protected $value;

    /**
     * @var integer Min length of the value
     */
    protected $min;

    /**
     * Prepares the validator
     *
     * @param mixed   $value       The value to validate
     * @param integer $min         Minimum
     */
    public function prepare($value, $min)
    {
        $this->value = $value;
        $this->min = $min;
    }

    /**
     * Executes the validation
     */
    public function execute()
    {
        $this->addError("Funktioniert soweit.");
    }
}
