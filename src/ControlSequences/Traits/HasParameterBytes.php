<?php

namespace Bramus\Ansi\ControlSequences\Traits;

use Bramus\Ansi\ControlSequences\Base as ControlSequencesBase;

trait HasParameterBytes
{
    /**
     * Parameter Byte: In a control sequence, a bit combination that may occur between the ControlFunction CSI and the Final Byte, or between CSI and an Intermediate Byte.
     * @var array
     */
    protected $parameterBytes = array();

    /**
     * Add a Parameter Byte
     * @param string $parameterByte The byte to add
     * @return ControlSequencesBase|HasParameterBytes   self, for chaining
     */
    public function addParameterByte($parameterByte)
    {
        $this->parameterBytes[] = (string)$parameterByte;

        return $this;
    }

    /**
     * Set the Parameter Byte
     * @param array $parameterBytes The byte to add
     * @return ControlSequencesBase|HasParameterBytes  self, for chaining
     */
    public function setParameterBytes($parameterBytes)
    {
        foreach ((array)$parameterBytes as $byte) {
            $this->addParameterByte($byte);
        }

        return $this;
    }

    /**
     * Get the Parameter Byte
     * @param bool $asString As a string, or as an array?
     * @return array|string
     */
    public function getParameterBytes($asString = true)
    {
        if ($asString === true) {
            return implode($this->parameterBytes);
        } else {
            return $this->parameterBytes;
        }
    }
}
