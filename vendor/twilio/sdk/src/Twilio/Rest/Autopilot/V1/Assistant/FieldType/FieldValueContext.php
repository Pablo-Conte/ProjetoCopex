<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant\FieldType;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class FieldValueContext extends InstanceContext {
    /**
     * Initialize the FieldValueContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the FieldType associated with the resource to
     *                             fetch
     * @param string $fieldTypeSid The SID of the Field Type associated with  the
     *                             Field Value to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $assistantSid, $fieldTypeSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, 'fieldTypeSid' => $fieldTypeSid, 'sid' => $sid, ];

        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/FieldTypes/' . \rawurlencode($fieldTypeSid) . '/FieldValues/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch the FieldValueInstance
     *
     * @return FieldValueInstance Fetched FieldValueInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): FieldValueInstance {
        $payload = $this->version->fetch('GET', $this->uri);

        return new FieldValueInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid'],
            $this->solution['fieldTypeSid'],
            $this->solution['sid']
        );
    }

    /**
     * Delete the FieldValueInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->version->delete('DELETE', $this->uri);
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
        return '[Twilio.Autopilot.V1.FieldValueContext ' . \implode(' ', $context) . ']';
    }
}