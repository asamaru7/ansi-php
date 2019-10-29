<?php
/**
 * ED - ERASE DISPLAY (ERASE IN PAGE)
 *
 * ED causes some or all character positions of the active page
 * (the page which contains the active presentation position in the
 * presentation component) to be put into the erased state, depending
 * on the parameter values
 */

namespace Bramus\Ansi\ControlSequences\EscapeSequences;

use Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte;
use Bramus\Ansi\ControlSequences\Traits\HasParameterBytes;

class ED extends Base
{
    // This EscapeSequence has ParameterByte(s)
    use HasParameterBytes;

    /**
     * ED - ERASE DISPLAY (ERASE IN PAGE)
     * @param mixed $parameterBytes The Parameter Bytes
     */
    public function __construct($parameterBytes)
    {
        // Store the parameter bytes
        $this->setParameterBytes($parameterBytes);

        // Call Parent Constructor (which will store finalByte)
        parent::__construct(
            FinalByte::ED
        );
    }
}
