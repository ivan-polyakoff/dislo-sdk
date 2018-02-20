<?php

namespace Ixolit\Dislo\WorkingObjects;

abstract class AbstractWorkingObject implements WorkingObject {

    /**
     * @param array $data
     * @param string $key
     * @param mixed $default
     * @param callable $convert
     * @return mixed
     */
    protected static function getValue($data, $key, $default = null, $convert = null) {

        if (isset($data[$key])) {
            if (is_callable($convert)) {
                return $convert($data[$key]);
            }
            else {
                return $data[$key];
            }
        };

        return $default;
    }

    /**
     * @param array $data
     * @param string $key
     * @param bool $default
     * @return bool
     */
    protected static function getValueAsBool($data, $key, $default = false) {
        return static::getValue($data, $key, $default, '\boolval');
    }

    /**
     * @param array $data
     * @param string $key
     * @param int $default
     * @return int
     */
    protected static function getValueAsInt($data, $key, $default = 0) {
        return static::getValue($data, $key, $default, '\intval');
    }

    /**
     * @param array $data
     * @param string $key
     * @param \DateTime $default
     * @return \DateTime
     */
    protected static function getValueAsDateTime($data, $key, \DateTime $default = null) {
        return static::getValue($data, $key, $default, function ($value) {
            return new \DateTime($value);
        });
    }
}