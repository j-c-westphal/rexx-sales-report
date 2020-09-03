<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Rexx\CompareVersions\Version as RexxVersion;

class RexxVersionTest extends TestCase
{
    private $rexxVersion = null;

    private function getRexxVersionInstance(string $version) {
        if ($this->rexxVersion === null) {
            $this->rexxVersion = new RexxVersion($version);
        } else {
            $this->rexxVersion->setVersion($version);
        }

        return $this->rexxVersion;
    }

    public function test_is_valid_to_true()
    {
        $this->assertTrue($this->getRexxVersionInstance('0.0.1')->isValid());
    }

    public function test_is_valid_to_false()
    {
        $this->assertFalse($this->getRexxVersionInstance('not-a-version-number')->isValid());
    }

    public function test_is_higher_to_true()
    {
        $this->assertTrue($this->getRexxVersionInstance('1.0.17+61')->isHigher());
    }

    public function test_is_higher_to_false()
    {
        $this->assertFalse($this->getRexxVersionInstance('1.0.17+60')->isHigher());
    }

    public function test_is_equal_to_true()
    {
        $this->assertTrue($this->getRexxVersionInstance('1.0.17+60')->isEqual());
    }

    public function test_is_equal_to_false()
    {
        $this->assertFalse($this->getRexxVersionInstance('1.0.17')->isEqual());
    }

    public function test_is_lower_to_true()
    {
        $this->assertTrue($this->getRexxVersionInstance('1.0.17+59')->isLower());
    }

    public function test_is_lower_to_false()
    {
        $this->assertFalse($this->getRexxVersionInstance('1.0.17+60')->isLower());
    }
}
