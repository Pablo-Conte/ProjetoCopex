<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Lookups\V2;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class PhoneNumberContext extends InstanceContext {
    /**
     * Initialize the PhoneNumberContext
     *
     * @param Version $version Version that contains the resource
     * @param string $phoneNumber Phone number to lookup
     */
    public function __construct(Version $version, $phoneNumber) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['phoneNumber' => $phoneNumber, ];

        $this->uri = '/PhoneNumbers/' . \rawurlencode($phoneNumber) . '';
    }

    /**
     * Fetch the PhoneNumberInstance
     *
     * @param array|Options $options Optional Arguments
     * @return PhoneNumberInstance Fetched PhoneNumberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(array $options = []): PhoneNumberInstance {
        $options = new Values($options);

        $params = Values::of([
            'Fields' => $options['fields'],
            'CountryCode' => $options['countryCode'],
            'FirstName' => $options['firstName'],
            'LastName' => $options['lastName'],
            'AddressLine1' => $options['addressLine1'],
            'AddressLine2' => $options['addressLine2'],
            'City' => $options['city'],
            'State' => $options['state'],
            'PostalCode' => $options['postalCode'],
            'AddressCountryCode' => $options['addressCountryCode'],
            'NationalId' => $options['nationalId'],
            'DateOfBirth' => $options['dateOfBirth'],
        ]);

        $payload = $this->version->fetch('GET', $this->uri, $params);

        return new PhoneNumberInstance($this->version, $payload, $this->solution['phoneNumber']);
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
        return '[Twilio.Lookups.V2.PhoneNumberContext ' . \implode(' ', $context) . ']';
    }
}