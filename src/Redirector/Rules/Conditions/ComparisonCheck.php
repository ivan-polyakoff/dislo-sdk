<?php

namespace Ixolit\Dislo\Redirector\Rules\Conditions;

use Ixolit\Dislo\Exceptions\RedirectorException;

/**
 * Class ComparisonCheck
 * @package Ixolit\Dislo\Redirector\Rules\Conditions
 */
abstract class ComparisonCheck extends Condition {

    /**
     * @var string
     */
    protected $comparator;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string[]
     */
    protected function getPossibleComparatorOperators() {
        return [
            'starts_with',
            'ends_with',
            'includes',
            '=',
            '!=',
            'regex'
        ];
    }

    /**
     * @param array $parameters
     * @throws RedirectorException
     */
    protected function validateParameters($parameters) {
        //validation
        if (empty($parameters['value'])) {
            throw new RedirectorException(__METHOD__.': Missing parameter "value"');
        }
        if (empty($parameters['comparator'])) {
            throw new RedirectorException(__METHOD__.': Missing parameter "comparator"');
        }
        if (!in_array($parameters['comparator'], $this->getPossibleComparatorOperators())) {
            throw new RedirectorException(__METHOD__.': Invalid value of parameter "comparator": '.$parameters['comparator']);
        }
    }

    /**
     * @param array $parameters
     * @return $this
     * @throws RedirectorException
     */
    public function setParameters($parameters)
    {
        $this->validateParameters($parameters);

        $this->comparator = $parameters['comparator'];
        $this->value = $parameters['value'];

        return $this;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param string $comparator
     * @return bool
     * @throws RedirectorException
     */
    public function compare($haystack, $needle, $comparator) {

        if ($comparator === 'starts_with') {
            return (bool) preg_match('|^'.$needle.'|i', $haystack);
        }

        if ($comparator === 'ends_with') {
            return (bool) preg_match('|'.$needle.'$|i', $haystack);
        }

        if ($comparator === 'includes') {
            return (bool) preg_match('|'.$needle.'|i', $haystack);
        }

        if ($comparator === '=') {
            return $haystack === $needle;
        }

        if ($comparator === '!=') {
            return $haystack != $needle;
        }

        if ($comparator === 'regex') {
            return (bool) preg_match($needle, $haystack);
        }

        throw new RedirectorException(__METHOD__.': Invalid Comparator: '.$comparator);
    }


}