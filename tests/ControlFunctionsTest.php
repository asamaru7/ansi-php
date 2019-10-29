<?php

use Bramus\Ansi\Ansi;
use Bramus\Ansi\ControlFunctions\Backspace;
use Bramus\Ansi\ControlFunctions\Base;
use Bramus\Ansi\ControlFunctions\Bell;
use Bramus\Ansi\ControlFunctions\CarriageReturn;
use Bramus\Ansi\ControlFunctions\Enums\C0;
use Bramus\Ansi\ControlFunctions\Escape;
use Bramus\Ansi\ControlFunctions\LineFeed;
use Bramus\Ansi\ControlFunctions\Tab;
use Bramus\Ansi\Writers\BufferWriter;

/**
 * Test the Control Functions
 */
class ControlFunctionsTest extends PHPUnit\Framework\TestCase
{

    public function testUsingGet()
    {
        // Base
        $this->assertEquals((new Base(C0::BS))->get(), C0::BS);

        // Helper Classes
        $this->assertEquals((new Backspace())->get(), C0::BS);
        $this->assertEquals((new Backspace())->get(), C0::BACKSPACE);
        $this->assertEquals((new Bell())->get(), C0::BEL);
        $this->assertEquals((new Bell())->get(), C0::BELL);
        $this->assertEquals((new CarriageReturn())->get(), C0::CR);
        $this->assertEquals((new Escape())->get(), C0::ESC);
        $this->assertEquals((new LineFeed())->get(), C0::LF);
        $this->assertEquals((new Tab())->get(), C0::TAB);
    }

    public function testUsingToString()
    {
        // Base
        $this->assertEquals(new Base(C0::BS), C0::BS);

        // Helper Classes
        $this->assertEquals(new Backspace(), C0::BS);
        $this->assertEquals(new Backspace(), C0::BACKSPACE);
        $this->assertEquals(new Bell(), C0::BEL);
        $this->assertEquals(new Bell(), C0::BELL);
        $this->assertEquals(new CarriageReturn(), C0::CR);
        $this->assertEquals(new Escape(), C0::ESC);
        $this->assertEquals(new LineFeed(), C0::LF);
        $this->assertEquals(new Tab(), C0::TAB);
    }

    public function testAnsiShorthands()
    {
        $a = new Ansi(new BufferWriter());

        $this->assertEquals($a->backspace()->flush(), C0::BS);
        $this->assertEquals($a->backspace()->flush(), C0::BACKSPACE);
        $this->assertEquals($a->bell()->flush(), C0::BEL);
        $this->assertEquals($a->bell()->flush(), C0::BELL);
        $this->assertEquals($a->cr()->flush(), C0::CR);
        $this->assertEquals($a->lf()->flush(), C0::LF);
        $this->assertEquals($a->tab()->flush(), C0::TAB);
    }

    public function testAnsiShorthandsChaining()
    {
        $a = new Ansi(new BufferWriter());

        // @note: we are going a round trip (bell is tested twice)
        // to make sure the test before it is also working correctly
        $this->assertEquals(
            $a->bell()->backspace()->cr()->lf()->tab()->bell()->get(),
            C0::BELL . C0::BS . C0::CR . C0::LF . C0::TAB . C0::BEL
        );
    }
}

// EOF
