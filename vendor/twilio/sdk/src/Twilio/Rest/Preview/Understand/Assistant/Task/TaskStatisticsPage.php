<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant\Task;

use Twilio\Http\Response;
use Twilio\Page;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class TaskStatisticsPage extends Page {
    /**
     * @param Version $version Version that contains the resource
     * @param Response $response Response from the API
     * @param array $solution The context solution
     */
    public function __construct(Version $version, Response $response, array $solution) {
        parent::__construct($version, $response);

        // Path Solution
        $this->solution = $solution;
    }

    /**
     * @param array $payload Payload response from the API
     * @return TaskStatisticsInstance \Twilio\Rest\Preview\Understand\Assistant\Task\TaskStatisticsInstance
     */
    public function buildInstance(array $payload): TaskStatisticsInstance {
        return new TaskStatisticsInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid'],
            $this->solution['taskSid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Preview.Understand.TaskStatisticsPage]';
    }
}