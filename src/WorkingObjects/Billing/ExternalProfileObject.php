<?php

namespace Ixolit\Dislo\WorkingObjects\Billing;


use Ixolit\Dislo\WorkingObjects\AbstractWorkingObject;

/**
 * Class ExternalProfileObject
 *
 * @package Ixolit\Dislo\WorkingObjects
 */
final class ExternalProfileObject extends AbstractWorkingObject {

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $subscriptionId;

    /**
     * @var array
     */
    private $extraData;

    /**
     * @var string
     */
    private $externalId;

    /**
     * @param int    $userId
     * @param int    $subscriptionId
     * @param array  $extraData
     * @param string $externalId
     */
    public function __construct($userId, $subscriptionId, $extraData, $externalId) {
        $this->userId         = $userId;
        $this->subscriptionId = $subscriptionId;
        $this->extraData      = $extraData;
        $this->externalId     = $externalId;
    }


    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getSubscriptionId() {
        return $this->subscriptionId;
    }

    /**
     * @return array
     */
    public function getExtraData() {
        return $this->extraData;
    }

    /**
     * @return string
     */
    public function getExternalId() {
        return $this->externalId;
    }


    /**
     * @param array $response
     *
     * @return ExternalProfileObject
     */
    public static function fromResponse($response) {
        return new self(
            static::getValueIsSet($response, 'userId'),
            static::getValueIsSet($response, 'subscriptionId'),
            static::getValueIsSet($response, 'extraData'),
            static::getValueIsSet($response, 'externalId')
        );
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            '_type'          => 'ExternalProfile',
            'userId'         => $this->userId,
            'subscriptionId' => $this->subscriptionId,
            'extraData'      => $this->extraData,
            'externalId'     => $this->externalId,
        ];
    }

}