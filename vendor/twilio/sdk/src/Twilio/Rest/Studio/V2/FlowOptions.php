<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V2;

use Twilio\Options;
use Twilio\Values;

abstract class FlowOptions {
    /**
     * @param string $commitMessage Description of change made in the revision
     * @return CreateFlowOptions Options builder
     */
    public static function create(string $commitMessage = Values::NONE): CreateFlowOptions {
        return new CreateFlowOptions($commitMessage);
    }

    /**
     * @param string $friendlyName The string that you assigned to describe the Flow
     * @param array $definition JSON representation of flow definition
     * @param string $commitMessage Description of change made in the revision
     * @return UpdateFlowOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, array $definition = Values::ARRAY_NONE, string $commitMessage = Values::NONE): UpdateFlowOptions {
        return new UpdateFlowOptions($friendlyName, $definition, $commitMessage);
    }
}

class CreateFlowOptions extends Options {
    /**
     * @param string $commitMessage Description of change made in the revision
     */
    public function __construct(string $commitMessage = Values::NONE) {
        $this->options['commitMessage'] = $commitMessage;
    }

    /**
     * Description of change made in the revision.
     *
     * @param string $commitMessage Description of change made in the revision
     * @return $this Fluent Builder
     */
    public function setCommitMessage(string $commitMessage): self {
        $this->options['commitMessage'] = $commitMessage;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Studio.V2.CreateFlowOptions ' . $options . ']';
    }
}

class UpdateFlowOptions extends Options {
    /**
     * @param string $friendlyName The string that you assigned to describe the Flow
     * @param array $definition JSON representation of flow definition
     * @param string $commitMessage Description of change made in the revision
     */
    public function __construct(string $friendlyName = Values::NONE, array $definition = Values::ARRAY_NONE, string $commitMessage = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['definition'] = $definition;
        $this->options['commitMessage'] = $commitMessage;
    }

    /**
     * The string that you assigned to describe the Flow.
     *
     * @param string $friendlyName The string that you assigned to describe the Flow
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * JSON representation of flow definition.
     *
     * @param array $definition JSON representation of flow definition
     * @return $this Fluent Builder
     */
    public function setDefinition(array $definition): self {
        $this->options['definition'] = $definition;
        return $this;
    }

    /**
     * Description of change made in the revision.
     *
     * @param string $commitMessage Description of change made in the revision
     * @return $this Fluent Builder
     */
    public function setCommitMessage(string $commitMessage): self {
        $this->options['commitMessage'] = $commitMessage;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Studio.V2.UpdateFlowOptions ' . $options . ']';
    }
}