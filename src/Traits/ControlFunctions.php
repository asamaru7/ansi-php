<?php

namespace Bramus\Ansi\Traits;

use Bramus\Ansi\Ansi;
use Bramus\Ansi\ControlFunctions\Backspace;
use Bramus\Ansi\ControlFunctions\Bell;
use Bramus\Ansi\ControlFunctions\CarriageReturn;
use Bramus\Ansi\ControlFunctions\LineFeed;
use Bramus\Ansi\ControlFunctions\Tab;
use Bramus\Ansi\Writers\WriterInterface;

/**
 * Trait containing the Control Function Shorthands
 * @property WriterInterface $writer
 */
trait ControlFunctions
{
    /**
     * Add a Bell Control Character to the buffer / echo it on screen
     * @return Ansi|ControlFunctions self, for chaining
     */
    public function bell()
    {
        // Write character onto writer
        $this->writer->write(new Bell());

        // Afford chaining
        return $this;
    }

    /**
     * Add a Backspace Control Character to the buffer / echo it on screen
     * @return Ansi|ControlFunctions self, for chaining
     */
    public function backspace()
    {
        // Write character onto writer
        $this->writer->write(new Backspace());

        // Afford chaining
        return $this;
    }

    /**
     * Add a Tab Control Character to the buffer / echo it on screen
     * @return Ansi|ControlFunctions self, for chaining
     */
    public function tab()
    {
        // Write character onto writer
        $this->writer->write(new Tab());

        // Afford chaining
        return $this;
    }

    /**
     * Add a Line Feed Control Character to the buffer / echo it on screen
     * @return Ansi|ControlFunctions self, for chaining
     */
    public function lf()
    {
        // Write character onto writer
        $this->writer->write(new LineFeed());

        // Afford chaining
        return $this;
    }

    /**
     * Add a Carriage Return Control Character to the buffer / echo it on screen
     * @return Ansi|ControlFunctions self, for chaining
     */
    public function cr()
    {
        // Write character onto writer
        $this->writer->write(new CarriageReturn());

        // Afford chaining
        return $this;
    }
}
