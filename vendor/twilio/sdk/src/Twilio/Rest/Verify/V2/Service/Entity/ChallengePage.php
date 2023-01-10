<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Verify\V2\Service\Entity;

use Twilio\Http\Response;
use Twilio\Page;
use Twilio\Version;

class ChallengePage extends Page {
    /**
     * @param Version $version Version that contains the resource
     * @param Response $response Response from the API
     * @param array $solution The context solution
     */
    public function __construct(Version $version, Response $response, array $solution) {
        parent::__construct($version, $response);

        // Path Solution
        $this->solution = $solution;
    }

    /**
     * @param array $payload Payload response from the API
     * @return ChallengeInstance \Twilio\Rest\Verify\V2\Service\Entity\ChallengeInstance
     */
    public function buildInstance(array $payload): ChallengeInstance {
        return new ChallengeInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['identity']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Verify.V2.ChallengePage]';
    }
}