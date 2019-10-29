<?php

namespace Bramus\Ansi\ControlSequences\Traits;

use Bramus\Ansi\ControlSequences\Base as ControlSequencesBase;

trait HasIntermediateBytes
{
    /**
     * Intermediate Byte: In a control sequence, a bit combination that may occur between the ControlFunction CSI and the Final Byte, or between a Parameter Byte and the Final Byte.
     * @var array
     */
    protected $intermediateBytes = array();

    /**
     * Add a Intermediate Byte
     * @param string $intermediateByte The byte to add
     * @return ControlSequencesBase|HasIntermediateBytes   self, for chaining
     */
    public function addIntermediateByte($intermediateByte)
    {
        $this->intermediateBytes[] = (string)$intermediateByte;

        return $this;
    }

    /**
     * Set the Intermediate Byte
     * @param array $intermediateBytes The byte to add
     * @return ControlSequencesBase|HasIntermediateBytes  self, for chaining
     */
    public function setIntermediateBytes($intermediateBytes)
    {
        foreach ((array)$intermediateBytes as $byte) {
            $this->addIntermediateByte($byte);
        }

        return $this;
    }

    /**
     * Get the Intermediate Byte
     * @param bool $asString As a string, or as an array?
     * @return array|string
     */
    public function getIntermediateBytes($asString = true)
    {
        if ($asString === true) {
            return implode($this->intermediateBytes);
        } else {
            return $this->intermediateBytes;
        }
    }
}
