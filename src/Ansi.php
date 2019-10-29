<?php

namespace Bramus\Ansi;

use Bramus\Ansi\Writers\WriterInterface;
use RuntimeException;
use Throwable;

/**
 * ANSI Wrapper Class to work with \Bramus\Ansi more easily
 */
class Ansi
{
    /**
     * Traits to use
     */
    use Traits\ControlFunctions;
    use Traits\EscapeSequences\SGR;
    use Traits\EscapeSequences\ED;
    use Traits\EscapeSequences\EL;

    /**
     * The writer to write the data to
     * @var WriterInterface
     */
    protected $writer;

    /**
     * ANSI Wrapper Class to work with \Bramus\Ansi more easily
     * @param WriterInterface $writer writer to use
     */
    public function __construct($writer = null)
    {
        // Enforce having a writer
        if (!$writer) {
            $writer = new Writers\StreamWriter();
        }

        // Set the writer
        $this->setWriter($writer);
    }

    /**
     * Sets the writer
     * @param WriterInterface $writer The writer to use
     */
    public function setWriter(Writers\WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * Gets the writer
     * @return WriterInterface $writer The writer used
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Write a piece of text onto the writer
     * @param string $text The text to write
     * @return Ansi   self, for chaining
     */
    public function text($text)
    {
        // Write the text to the writer
        $this->writer->write($text);

        // Afford chaining
        return $this;
    }

    /**
     * Flush the contents of the writer
     * @param boolean $resetAfterwards Reset the writer contents after flushing?
     * @return string The writer contents
     */
    public function flush($resetAfterwards = true)
    {
        if ($this->writer instanceof Writers\FlushableInterface) {
            return $this->writer->flush($resetAfterwards);
        } else {
            throw new RuntimeException('Flushing a non FlushableInterface is not possible');
        }
    }

    /**
     * @param bool $resetAfterwards
     * @return string
     */
    public function get($resetAfterwards = true)
    {
        return $this->flush($resetAfterwards);
    }

    /**
     * Echo the contents of the writer
     * @param boolean $resetAfterwards Reset the writer contents after flushing?
     * @return Ansi self, for chaining
     * @throws Throwable
     */
    public function e($resetAfterwards = true)
    {
        // Get the contents and echo them
        echo $this->flush($resetAfterwards);

        // Afford chaining
        return $this;
    }
}
