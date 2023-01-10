<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Routes\V2;

use Twilio\ListResource;
use Twilio\Version;

class SipDomainList extends ListResource {
    /**
     * Construct the SipDomainList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [];
    }

    /**
     * Constructs a SipDomainContext
     *
     * @param string $sipDomain The sip_domain
     */
    public function getContext(string $sipDomain): SipDomainContext {
        return new SipDomainContext($this->version, $sipDomain);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Routes.V2.SipDomainList]';
    }
}