<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Verify\V2\Service;

use Twilio\Options;
use Twilio\Values;

abstract class AccessTokenOptions {
    /**
     * @param string $factorFriendlyName The factor friendly name
     * @param int $ttl How long, in seconds, the access token is valid.
     * @return CreateAccessTokenOptions Options builder
     */
    public static function create(string $factorFriendlyName = Values::NONE, int $ttl = Values::NONE): CreateAccessTokenOptions {
        return new CreateAccessTokenOptions($factorFriendlyName, $ttl);
    }
}

class CreateAccessTokenOptions extends Options {
    /**
     * @param string $factorFriendlyName The factor friendly name
     * @param int $ttl How long, in seconds, the access token is valid.
     */
    public function __construct(string $factorFriendlyName = Values::NONE, int $ttl = Values::NONE) {
        $this->options['factorFriendlyName'] = $factorFriendlyName;
        $this->options['ttl'] = $ttl;
    }

    /**
     * The friendly name of the factor that is going to be created with this access token
     *
     * @param string $factorFriendlyName The factor friendly name
     * @return $this Fluent Builder
     */
    public function setFactorFriendlyName(string $factorFriendlyName): self {
        $this->options['factorFriendlyName'] = $factorFriendlyName;
        return $this;
    }

    /**
     * How long, in seconds, the access token is valid. Can be an integer between 60 and 300. Default is 60.
     *
     * @param int $ttl How long, in seconds, the access token is valid.
     * @return $this Fluent Builder
     */
    public function setTtl(int $ttl): self {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Verify.V2.CreateAccessTokenOptions ' . $options . ']';
    }
}