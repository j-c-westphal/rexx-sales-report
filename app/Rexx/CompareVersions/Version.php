<?php

namespace App\Rexx\CompareVersions;

use phpDocumentor\Reflection\Types\Boolean;

class Version
{
    private $version;

    const THRESHOLD = '1.0.17+60';

    /**
     * Version constructor.
     *
     * @param string $version
     */
    public function __construct(string $version)
    {
        $this->version = $version;

        if (!defined('VERSION_IS_LOWER')) define('VERSION_IS_LOWER', -1);
        if (!defined('VERSION_IS_EQUAL')) define('VERSION_IS_EQUAL', 0);
        if (!defined('VERSION_IS_HIGHER')) define('VERSION_IS_HIGHER', 1);
    }

    /**
     * Returns true, if version is a valid version
     *
     * @return bool
     */
    public function isValid()
    {
        // Comparing against 0.0.1 will always return somewhat greater or equal to 0, otherwise it is no valid version
        return is_string($this->version) && version_compare($this->version, '0.0.1') >= 0;
    }

    /**
     * Returns true, if version is lower than threshold
     *
     * @return bool
     */
    public function isLower()
    {
        return $this->isValid() && VERSION_IS_LOWER === version_compare($this->version, self::THRESHOLD);
    }

    /**
     * Returns true, if version is equal to threshold
     *
     * @return bool
     */
    public function isEqual()
    {
        return $this->isValid() && VERSION_IS_EQUAL === version_compare($this->version, self::THRESHOLD);
    }

    /**
     * Returns true, if version is higher than threshold
     *
     * @return bool
     */
    public function isHigher()
    {
        return $this->isValid() && VERSION_IS_HIGHER === version_compare($this->version, self::THRESHOLD);
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }
}
