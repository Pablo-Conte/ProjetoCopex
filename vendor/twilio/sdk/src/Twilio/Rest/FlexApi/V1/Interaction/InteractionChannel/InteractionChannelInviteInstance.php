<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\FlexApi\V1\Interaction\InteractionChannel;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $sid
 * @property string $interactionSid
 * @property string $channelSid
 * @property array $routing
 * @property string $url
 */
class InteractionChannelInviteInstance extends InstanceResource {
    /**
     * Initialize the InteractionChannelInviteInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $interactionSid The Interaction SID for this Channel
     * @param string $channelSid The Channel SID for this Invite
     */
    public function __construct(Version $version, array $payload, string $interactionSid, string $channelSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'interactionSid' => Values::array_get($payload, 'interaction_sid'),
            'channelSid' => Values::array_get($payload, 'channel_sid'),
            'routing' => Values::array_get($payload, 'routing'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['interactionSid' => $interactionSid, 'channelSid' => $channelSid, ];
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.FlexApi.V1.InteractionChannelInviteInstance]';
    }
}