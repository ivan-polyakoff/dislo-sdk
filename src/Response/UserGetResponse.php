<?php

namespace Ixolit\Dislo\Response;

use Ixolit\Dislo\WorkingObjects\User;

/**
 * Class UserGetResponse
 *
 * @package Ixolit\Dislo\Response
 */
class UserGetResponse {

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @param User $user
	 */
	public function __construct(User $user) {
		$this->user = $user;
	}

	/**
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}

    /**
     * @param array $response
     *
     * @return UserGetResponse
     */
	public static function fromResponse($response) {
		return new UserGetResponse(User::fromResponse($response['user']));
	}
}