<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Values;
use Twilio\Version;

class EndUserTypeContext extends InstanceContext {
    /**
     * Initialize the EndUserTypeContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The unique string that identifies the End-User Type
     *                    resource
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sid' => $sid, ];

        $this->uri = '/RegulatoryCompliance/EndUserTypes/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch the EndUserTypeInstance
     *
     * @return EndUserTypeInstance Fetched EndUserTypeInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): EndUserTypeInstance {
        $payload = $this->version->fetch('GET', $this->uri);

        return new EndUserTypeInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Numbers.V2.EndUserTypeContext ' . \implode(' ', $context) . ']';
    }
}