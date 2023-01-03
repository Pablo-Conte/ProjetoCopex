<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Serverless\V1\Service\Environment;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class DeploymentList extends ListResource {
    /**
     * Construct the DeploymentList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Service that the Deployment
     *                           resource is associated with
     * @param string $environmentSid The SID of the Environment for the Deployment
     */
    public function __construct(Version $version, string $serviceSid, string $environmentSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'environmentSid' => $environmentSid, ];

        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Environments/' . \rawurlencode($environmentSid) . '/Deployments';
    }

    /**
     * Streams DeploymentInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
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
    public function stream(int $limit = null, $pageSize = null): Stream {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads DeploymentInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return DeploymentInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null): array {
        return \iterator_to_array($this->stream($limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of DeploymentInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return DeploymentPage Page of DeploymentInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE): DeploymentPage {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize, ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new DeploymentPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of DeploymentInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return DeploymentPage Page of DeploymentInstance
     */
    public function getPage(string $targetUrl): DeploymentPage {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new DeploymentPage($this->version, $response, $this->solution);
    }

    /**
     * Create the DeploymentInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DeploymentInstance Created DeploymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): DeploymentInstance {
        $options = new Values($options);

        $data = Values::of(['BuildSid' => $options['buildSid'], ]);

        $payload = $this->version->create('POST', $this->uri, [], $data);

        return new DeploymentInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['environmentSid']
        );
    }

    /**
     * Constructs a DeploymentContext
     *
     * @param string $sid The SID that identifies the Deployment resource to fetch
     */
    public function getContext(string $sid): DeploymentContext {
        return new DeploymentContext(
            $this->version,
            $this->solution['serviceSid'],
            $this->solution['environmentSid'],
            $sid
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Serverless.V1.DeploymentList]';
    }
}