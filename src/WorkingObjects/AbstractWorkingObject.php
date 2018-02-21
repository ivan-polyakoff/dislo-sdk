<?php

namespace Ixolit\Dislo\WorkingObjects;

abstract class AbstractWorkingObject implements WorkingObject {

    /** @var WorkingObjectCustomInterface */
    private $custom;

    protected function newCustom() {

        $class = str_replace('\\WorkingObjects\\', '\\WorkingObjectsCustom\\', get_class($this)) . 'Custom';
        if (class_exists($class)) {
            $custom = new $class;
            if ($custom instanceof WorkingObjectCustomInterface) {
                $custom->setWorkingObject($this);
                $this->custom = $custom;
            }
        }
    }

    /**
     * @return WorkingObjectCustomInterface
     */
    public function getCustom() {
        return $this->custom;
    }

    /**
     * @param array $data
     * @param string $key
     * @param mixed $default
     * @param callable $convert
     * @return mixed
     */
    protected static function getValueIsSet($data, $key, $default = null, $convert = null) {

        if (isset($data[$key])) {

            if (is_callable($convert)) {
                return $convert($data[$key]);
            }

            return $data[$key];
        }

        return $default;
    }

    /**
     * @param array $data
     * @param string $key
     * @param mixed $default
     * @param callable $convert
     * @return mixed
     */
    protected static function getValueNotEmpty($data, $key, $default = null, $convert = null) {

        if (!empty($data[$key])) {

            if (is_callable($convert)) {
                return $convert($data[$key]);
            }

            return $data[$key];
        }

        return $default;
    }

    /**
     * @param array $data
     * @param string $key
     * @param bool $default
     * @return bool
     */
    protected static function getValueAsBool($data, $key, $default = false) {
        return static::getValueIsSet($data, $key, $default, '\\boolval');
    }

    /**
     * @param array $data
     * @param string $key
     * @param int $default
     * @return int
     */
    protected static function getValueAsInt($data, $key, $default = 0) {
        return static::getValueIsSet($data, $key, $default, '\\intval');
    }

    /**
     * @param array $data
     * @param string $key
     * @param \DateTime $default
     * @return \DateTime
     */
    protected static function getValueAsDateTime($data, $key, \DateTime $default = null) {
        return static::getValueNotEmpty($data, $key, $default, function ($value) {
            return new \DateTime($value);
        });
    }
}