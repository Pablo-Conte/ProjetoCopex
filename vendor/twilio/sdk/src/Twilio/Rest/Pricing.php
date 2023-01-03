<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Pricing\V1;
use Twilio\Rest\Pricing\V2;

/**
 * @property \Twilio\Rest\Pricing\V1 $v1
 * @property \Twilio\Rest\Pricing\V2 $v2
 * @property \Twilio\Rest\Pricing\V1\MessagingList $messaging
 * @property \Twilio\Rest\Pricing\V1\PhoneNumberList $phoneNumbers
 * @property \Twilio\Rest\Pricing\V2\VoiceList $voice
 * @property \Twilio\Rest\Pricing\V2\CountryList $countries
 * @property \Twilio\Rest\Pricing\V2\NumberList $numbers
 * @method \Twilio\Rest\Pricing\V2\CountryContext countries(string $isoCountry)
 * @method \Twilio\Rest\Pricing\V2\NumberContext numbers(string $destinationNumber)
 */
class Pricing extends Domain {
    protected $_v1;
    protected $_v2;

    /**
     * Construct the Pricing Domain
     *
     * @param Client $client Client to communicate with Twilio
     */
    public function __construct(Client $client) {
        parent::__construct($client);

        $this->baseUrl = 'https://pricing.twilio.com';
    }

    /**
     * @return V1 Version v1 of pricing
     */
    protected function getV1(): V1 {
        if (!$this->_v1) {
            $this->_v1 = new V1($this);
        }
        return $this->_v1;
    }

    /**
     * @return V2 Version v2 of pricing
     */
    protected function getV2(): V2 {
        if (!$this->_v2) {
            $this->_v2 = new V2($this);
        }
        return $this->_v2;
    }

    /**
     * Magic getter to lazy load version
     *
     * @param string $name Version to return
     * @return \Twilio\Version The requested version
     * @throws TwilioException For unknown versions
     */
    public function __get(string $name) {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown version ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) {
        $method = 'context' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return \call_user_func_array([$this, $method], $arguments);
        }

        throw new TwilioException('Unknown context ' . $name);
    }

    protected function getMessaging(): \Twilio\Rest\Pricing\V1\MessagingList {
        return $this->v1->messaging;
    }

    protected function getPhoneNumbers(): \Twilio\Rest\Pricing\V1\PhoneNumberList {
        return $this->v1->phoneNumbers;
    }

    protected function getVoice(): \Twilio\Rest\Pricing\V2\VoiceList {
        return $this->v2->voice;
    }

    protected function getCountries(): \Twilio\Rest\Pricing\V2\CountryList {
        return $this->v2->countries;
    }

    /**
     * @param string $isoCountry The ISO country code of the pricing information to
     *                           fetch
     */
    protected function contextCountries(string $isoCountry): \Twilio\Rest\Pricing\V2\CountryContext {
        return $this->v2->countries($isoCountry);
    }

    protected function getNumbers(): \Twilio\Rest\Pricing\V2\NumberList {
        return $this->v2->numbers;
    }

    /**
     * @param string $destinationNumber The destination number for which to fetch
     *                                  pricing information
     */
    protected function contextNumbers(string $destinationNumber): \Twilio\Rest\Pricing\V2\NumberContext {
        return $this->v2->numbers($destinationNumber);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Pricing]';
    }
}