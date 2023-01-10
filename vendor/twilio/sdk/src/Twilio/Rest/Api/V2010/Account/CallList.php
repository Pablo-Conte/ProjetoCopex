<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Api\V2010\Account\Call\FeedbackSummaryList;
use Twilio\Serialize;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;

/**
 * @property FeedbackSummaryList $feedbackSummaries
 * @method \Twilio\Rest\Api\V2010\Account\Call\FeedbackSummaryContext feedbackSummaries(string $sid)
 */
class CallList extends ListResource {
    protected $_feedbackSummaries = null;

    /**
     * Construct the CallList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created this resource
     */
    public function __construct(Version $version, string $accountSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['accountSid' => $accountSid, ];

        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Calls.json';
    }

    /**
     * Create the CallInstance
     *
     * @param string $to Phone number, SIP address, or client identifier to call
     * @param string $from Twilio number from which to originate the call
     * @param array|Options $options Optional Arguments
     * @return CallInstance Created CallInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $to, string $from, array $options = []): CallInstance {
        $options = new Values($options);

        $data = Values::of([
            'To' => $to,
            'From' => $from,
            'Url' => $options['url'],
            'Twiml' => $options['twiml'],
            'ApplicationSid' => $options['applicationSid'],
            'Method' => $options['method'],
            'FallbackUrl' => $options['fallbackUrl'],
            'FallbackMethod' => $options['fallbackMethod'],
            'StatusCallback' => $options['statusCallback'],
            'StatusCallbackEvent' => Serialize::map($options['statusCallbackEvent'], function($e) { return $e; }),
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
            'SendDigits' => $options['sendDigits'],
            'Timeout' => $options['timeout'],
            'Record' => Serialize::booleanToString($options['record']),
            'RecordingChannels' => $options['recordingChannels'],
            'RecordingStatusCallback' => $options['recordingStatusCallback'],
            'RecordingStatusCallbackMethod' => $options['recordingStatusCallbackMethod'],
            'SipAuthUsername' => $options['sipAuthUsername'],
            'SipAuthPassword' => $options['sipAuthPassword'],
            'MachineDetection' => $options['machineDetection'],
            'MachineDetectionTimeout' => $options['machineDetectionTimeout'],
            'RecordingStatusCallbackEvent' => Serialize::map($options['recordingStatusCallbackEvent'], function($e) { return $e; }),
            'Trim' => $options['trim'],
            'CallerId' => $options['callerId'],
            'MachineDetectionSpeechThreshold' => $options['machineDetectionSpeechThreshold'],
            'MachineDetectionSpeechEndThreshold' => $options['machineDetectionSpeechEndThreshold'],
            'MachineDetectionSilenceTimeout' => $options['machineDetectionSilenceTimeout'],
            'AsyncAmd' => $options['asyncAmd'],
            'AsyncAmdStatusCallback' => $options['asyncAmdStatusCallback'],
            'AsyncAmdStatusCallbackMethod' => $options['asyncAmdStatusCallbackMethod'],
            'Byoc' => $options['byoc'],
            'CallReason' => $options['callReason'],
            'CallToken' => $options['callToken'],
            'RecordingTrack' => $options['recordingTrack'],
            'TimeLimit' => $options['timeLimit'],
        ]);

        $payload = $this->version->create('POST', $this->uri, [], $data);

        return new CallInstance($this->version, $payload, $this->solution['accountSid']);
    }

    /**
     * Streams CallInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = [], int $limit = null, $pageSize = null): Stream {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads CallInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return CallInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null): array {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of CallInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return CallPage Page of CallInstance
     */
    public function page(array $options = [], $pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE): CallPage {
        $options = new Values($options);

        $params = Values::of([
            'To' => $options['to'],
            'From' => $options['from'],
            'ParentCallSid' => $options['parentCallSid'],
            'Status' => $options['status'],
            'StartTime<' => Serialize::iso8601DateTime($options['startTimeBefore']),
            'StartTime' => Serialize::iso8601DateTime($options['startTime']),
            'StartTime>' => Serialize::iso8601DateTime($options['startTimeAfter']),
            'EndTime<' => Serialize::iso8601DateTime($options['endTimeBefore']),
            'EndTime' => Serialize::iso8601DateTime($options['endTime']),
            'EndTime>' => Serialize::iso8601DateTime($options['endTimeAfter']),
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new CallPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of CallInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return CallPage Page of CallInstance
     */
    public function getPage(string $targetUrl): CallPage {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new CallPage($this->version, $response, $this->solution);
    }

    /**
     * Access the feedbackSummaries
     */
    protected function getFeedbackSummaries(): FeedbackSummaryList {
        if (!$this->_feedbackSummaries) {
            $this->_feedbackSummaries = new FeedbackSummaryList($this->version, $this->solution['accountSid']);
        }

        return $this->_feedbackSummaries;
    }

    /**
     * Constructs a CallContext
     *
     * @param string $sid The SID of the Call resource to fetch
     */
    public function getContext(string $sid): CallContext {
        return new CallContext($this->version, $this->solution['accountSid'], $sid);
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name) {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Api.V2010.CallList]';
    }
}