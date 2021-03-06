<?php

namespace Ixolit\Dislo\Redirector\Base;

/**
 * Interface RedirectorRequestInterface
 * @package Ixolit\Dislo\Redirector\Base
 */
interface RedirectorRequestInterface
{

    /**
     * @return string
     */
    public function getScheme();

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return string
     */
    public function getPath();


    /**
     * @return RequestParameter[]
     */
    public function getRequestParameters();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return Cookie[]
     */
    public function getCookies();

    /**
     * @return string
     */
    public function getQuery();

    /**
     * @return Header[]
     */
    public function getHeaders();

    /**
     * @return SessionVariable[]
     */
    public function getSessionVariables();

    /**
     * @return string
     */
    public function getIpBasedCountryCode();

}