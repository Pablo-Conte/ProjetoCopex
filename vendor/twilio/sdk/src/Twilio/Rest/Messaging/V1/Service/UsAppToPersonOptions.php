<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Messaging\V1\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class UsAppToPersonOptions {
    /**
     * @param string $messageFlow The message flow of the campaign
     * @param string $optInMessage Opt In Message
     * @param string $optOutMessage Opt Out Message
     * @param string $helpMessage Help Message
     * @param string[] $optInKeywords Opt In Keywords
     * @param string[] $optOutKeywords Opt Out Keywords
     * @param string[] $helpKeywords Help Keywords
     * @return CreateUsAppToPersonOptions Options builder
     */
    public static function create(string $messageFlow = Values::NONE, string $optInMessage = Values::NONE, string $optOutMessage = Values::NONE, string $helpMessage = Values::NONE, array $optInKeywords = Values::ARRAY_NONE, array $optOutKeywords = Values::ARRAY_NONE, array $helpKeywords = Values::ARRAY_NONE): CreateUsAppToPersonOptions {
        return new CreateUsAppToPersonOptions($messageFlow, $optInMessage, $optOutMessage, $helpMessage, $optInKeywords, $optOutKeywords, $helpKeywords);
    }
}

class CreateUsAppToPersonOptions extends Options {
    /**
     * @param string $messageFlow The message flow of the campaign
     * @param string $optInMessage Opt In Message
     * @param string $optOutMessage Opt Out Message
     * @param string $helpMessage Help Message
     * @param string[] $optInKeywords Opt In Keywords
     * @param string[] $optOutKeywords Opt Out Keywords
     * @param string[] $helpKeywords Help Keywords
     */
    public function __construct(string $messageFlow = Values::NONE, string $optInMessage = Values::NONE, string $optOutMessage = Values::NONE, string $helpMessage = Values::NONE, array $optInKeywords = Values::ARRAY_NONE, array $optOutKeywords = Values::ARRAY_NONE, array $helpKeywords = Values::ARRAY_NONE) {
        $this->options['messageFlow'] = $messageFlow;
        $this->options['optInMessage'] = $optInMessage;
        $this->options['optOutMessage'] = $optOutMessage;
        $this->options['helpMessage'] = $helpMessage;
        $this->options['optInKeywords'] = $optInKeywords;
        $this->options['optOutKeywords'] = $optOutKeywords;
        $this->options['helpKeywords'] = $helpKeywords;
    }

    /**
     * Description of how end users opt-in to the SMS campaign, therefore giving consent to receive messages.
     *
     * @param string $messageFlow The message flow of the campaign
     * @return $this Fluent Builder
     */
    public function setMessageFlow(string $messageFlow): self {
        $this->options['messageFlow'] = $messageFlow;
        return $this;
    }

    /**
     * The message that will be sent to the user when they opt in to the SMS campaign.
     *
     * @param string $optInMessage Opt In Message
     * @return $this Fluent Builder
     */
    public function setOptInMessage(string $optInMessage): self {
        $this->options['optInMessage'] = $optInMessage;
        return $this;
    }

    /**
     * The message that will be sent to the user when they opt out of the SMS campaign.
     *
     * @param string $optOutMessage Opt Out Message
     * @return $this Fluent Builder
     */
    public function setOptOutMessage(string $optOutMessage): self {
        $this->options['optOutMessage'] = $optOutMessage;
        return $this;
    }

    /**
     * The message that will be sent to the user when they request help for the SMS campaign.
     *
     * @param string $helpMessage Help Message
     * @return $this Fluent Builder
     */
    public function setHelpMessage(string $helpMessage): self {
        $this->options['helpMessage'] = $helpMessage;
        return $this;
    }

    /**
     * The keywords that will be used to opt in to the SMS campaign.
     *
     * @param string[] $optInKeywords Opt In Keywords
     * @return $this Fluent Builder
     */
    public function setOptInKeywords(array $optInKeywords): self {
        $this->options['optInKeywords'] = $optInKeywords;
        return $this;
    }

    /**
     * The keywords that will be used to opt out of the SMS campaign.
     *
     * @param string[] $optOutKeywords Opt Out Keywords
     * @return $this Fluent Builder
     */
    public function setOptOutKeywords(array $optOutKeywords): self {
        $this->options['optOutKeywords'] = $optOutKeywords;
        return $this;
    }

    /**
     * The keywords that will be used to request help for the SMS campaign.
     *
     * @param string[] $helpKeywords Help Keywords
     * @return $this Fluent Builder
     */
    public function setHelpKeywords(array $helpKeywords): self {
        $this->options['helpKeywords'] = $helpKeywords;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Messaging.V1.CreateUsAppToPersonOptions ' . $options . ']';
    }
}