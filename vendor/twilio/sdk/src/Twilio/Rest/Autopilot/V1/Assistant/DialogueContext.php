<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class DialogueContext extends InstanceContext {
    /**
     * Initialize the DialogueContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the resource to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $assistantSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, 'sid' => $sid, ];

        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/Dialogues/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch the DialogueInstance
     *
     * @return DialogueInstance Fetched DialogueInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DialogueInstance {
        $payload = $this->version->fetch('GET', $this->uri);

        return new DialogueInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid'],
            $this->solution['sid']
        );
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
        return '[Twilio.Autopilot.V1.DialogueContext ' . \implode(' ', $context) . ']';
    }
}