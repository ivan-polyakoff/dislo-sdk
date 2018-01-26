<?php

namespace Ixolit\Dislo\Response;


use Ixolit\Dislo\WorkingObjects\SubscriptionObject;

/**
 * Class SubscriptionCloseResponseObject
 *
 * @package Ixolit\Dislo\Response
 */
final class SubscriptionCloseResponseObject {

    /**
     * @var SubscriptionObject
     */
    private $subscription;

    /**
     * @param SubscriptionObject $subscription
     */
    public function __construct(SubscriptionObject $subscription) {
        $this->subscription = $subscription;
    }

    /**
     * @return SubscriptionObject
     */
    public function getSubscription() {
        return $this->subscription;
    }

    /**
     * @param array $response
     *
     * @return SubscriptionCloseResponseObject
     */
    public static function fromResponse($response) {
        return new self(SubscriptionObject::fromResponse($response['subscription']));
    }

}