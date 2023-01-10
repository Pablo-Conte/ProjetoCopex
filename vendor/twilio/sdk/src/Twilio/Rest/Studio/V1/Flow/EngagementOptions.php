<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V1\Flow;

use Twilio\Options;
use Twilio\Values;

abstract class EngagementOptions {
    /**
     * @param array $parameters A JSON string we will add to your flow's context
     *                          and that you can access as variables inside your
     *                          flow
     * @return CreateEngagementOptions Options builder
     */
    public static function create(array $parameters = Values::ARRAY_NONE): CreateEngagementOptions {
        return new CreateEngagementOptions($parameters);
    }
}

class CreateEngagementOptions extends Options {
    /**
     * @param array $parameters A JSON string we will add to your flow's context
     *                          and that you can access as variables inside your
     *                          flow
     */
    public function __construct(array $parameters = Values::ARRAY_NONE) {
        $this->options['parameters'] = $parameters;
    }

    /**
     * A JSON string we will add to your flow's context and that you can access as variables inside your flow. For example, if you pass in `Parameters={'name':'Zeke'}` then inside a widget you can reference the variable `{{flow.data.name}}` which will return the string 'Zeke'. Note: the JSON value must explicitly be passed as a string, not as a hash object. Depending on your particular HTTP library, you may need to add quotes or URL encode your JSON string.
     *
     * @param array $parameters A JSON string we will add to your flow's context
     *                          and that you can access as variables inside your
     *                          flow
     * @return $this Fluent Builder
     */
    public function setParameters(array $parameters): self {
        $this->options['parameters'] = $parameters;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Studio.V1.CreateEngagementOptions ' . $options . ']';
    }
}