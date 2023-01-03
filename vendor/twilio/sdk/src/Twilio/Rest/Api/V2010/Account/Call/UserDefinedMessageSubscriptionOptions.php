<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Call;

use Twilio\Options;
use Twilio\Values;

abstract class UserDefinedMessageSubscriptionOptions {
    /**
     * @param string $idempotencyKey A unique string value to identify API call.
     *                               This should be a unique string value per API
     *                               call and can be a randomly generated.
     * @return CreateUserDefinedMessageSubscriptionOptions Options builder
     */
    public static function create(string $idempotencyKey = Values::NONE): CreateUserDefinedMessageSubscriptionOptions {
        return new CreateUserDefinedMessageSubscriptionOptions($idempotencyKey);
    }
}

class CreateUserDefinedMessageSubscriptionOptions extends Options {
    /**
     * @param string $idempotencyKey A unique string value to identify API call.
     *                               This should be a unique string value per API
     *                               call and can be a randomly generated.
     */
    public function __construct(string $idempotencyKey = Values::NONE) {
        $this->options['idempotencyKey'] = $idempotencyKey;
    }

    /**
     * A unique string value to identify API call. This should be a unique string value per API call and can be a randomly generated.
     *
     * @param string $idempotencyKey A unique string value to identify API call.
     *                               This should be a unique string value per API
     *                               call and can be a randomly generated.
     * @return $this Fluent Builder
     */
    public function setIdempotencyKey(string $idempotencyKey): self {
        $this->options['idempotencyKey'] = $idempotencyKey;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Api.V2010.CreateUserDefinedMessageSubscriptionOptions ' . $options . ']';
    }
}