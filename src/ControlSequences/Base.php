<?php
/**
 * ANSI Control Sequence
 *
 * A string of bit combinations starting with the control
 * function CONTROL SEQUENCE INTRODUCER (CSI), and used for
 * the coded representation of control functions with
 * or without parameters.
 */

namespace Bramus\Ansi\ControlSequences;

use Bramus\Ansi\ControlFunctions\Base as ControlFunction;
use Bramus\Ansi\ControlSequences\Traits\HasFinalByte;

class Base
{
    use HasFinalByte;

    /**
     * A ControlFunction that acts as the Control Sequence Introducer (CSI)
     * @var ControlFunction
     */
    protected $controlSequenceIntroducer;

    /**
     * ANSI Control Sequence
     * @param ControlFunction $controlSequenceIntroducer A ControlFunction that acts as the Control Sequence Introducer (CSI)
     */
    public function __construct($controlSequenceIntroducer)
    {
        // Store datamembers
        $this->setControlSequenceIntroducer($controlSequenceIntroducer);
    }

    /**
     * Set the control sequence introducer
     * @param ControlFunction $controlSequenceIntroducer A ControlFunction that acts as the Control Sequence Introducer (CSI)
     * @return Base self, for chaining
     */
    public function setControlSequenceIntroducer($controlSequenceIntroducer)
    {
        // Make sure it's a ControlFunction instance
        if (is_string($controlSequenceIntroducer)) {
            $controlSequenceIntroducer = new ControlFunction($controlSequenceIntroducer);
        }

        // @TODO: Check Validity
        $this->controlSequenceIntroducer = $controlSequenceIntroducer;

        return $this;
    }

    /**
     * Gets the CSI
     * @return string The CSI
     */
    public function getControlSequenceIntroducer()
    {
        return $this->controlSequenceIntroducer;
    }

    /**
     * Build and return the ANSI Code
     * @return string The ANSI Code
     */
    public function get()
    {
        // Append CSI
        $toReturn = $this->controlSequenceIntroducer->get() . '[';

        // Append Parameter Byte (if any)
        if (isset($this->parameterBytes) && count((array)$this->parameterBytes) > 0) {
            $toReturn .= implode(';', $this->parameterBytes);
        }

        // Append Intermediate Bytes (if any)
        if (isset($this->intermediateBytes) && count((array)$this->intermediateBytes) > 0) {
            $toReturn .= implode(';', $this->intermediateBytes); // @TODO: Verify that ';' is the glue for intermediate bytes
        }

        // Append Final Byte (if any)
        if (isset($this->finalByte)) {
            $toReturn .= $this->getFinalByte();
        }

        return $toReturn;
    }

    /**
     * Return the ANSI Code upon __toString
     * @return string The ANSI Code
     */
    public function __toString()
    {
        return $this->get();
    }

    /**
     * Echo the ANSI Code
     */
    public function e()
    {
        echo $this->get();
    }
}

// EOF
