<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Chat\V1\Service;

use Twilio\Options;
use Twilio\Values;

abstract class ChannelOptions {
    /**
     * @param string $friendlyName A string to describe the new resource
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $type The visibility of the channel
     * @return CreateChannelOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE, string $type = Values::NONE): CreateChannelOptions {
        return new CreateChannelOptions($friendlyName, $uniqueName, $attributes, $type);
    }

    /**
     * @param string[] $type The visibility of the channel to read
     * @return ReadChannelOptions Options builder
     */
    public static function read(array $type = Values::ARRAY_NONE): ReadChannelOptions {
        return new ReadChannelOptions($type);
    }

    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return UpdateChannelOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE): UpdateChannelOptions {
        return new UpdateChannelOptions($friendlyName, $uniqueName, $attributes);
    }
}

class CreateChannelOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the new resource
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $type The visibility of the channel
     */
    public function __construct(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE, string $type = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['attributes'] = $attributes;
        $this->options['type'] = $type;
    }

    /**
     * A descriptive string that you create to describe the new resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the new resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * An application-defined string that uniquely identifies the resource. It can be used to address the resource in place of the resource's `sid` in the URL. This value must be 64 characters or less in length and be unique within the Service.
     *
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * A valid JSON string that contains application-specific data.
     *
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes): self {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * The visibility of the channel. Can be: `public` or `private` and defaults to `public`.
     *
     * @param string $type The visibility of the channel
     * @return $this Fluent Builder
     */
    public function setType(string $type): self {
        $this->options['type'] = $type;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Chat.V1.CreateChannelOptions ' . $options . ']';
    }
}

class ReadChannelOptions extends Options {
    /**
     * @param string[] $type The visibility of the channel to read
     */
    public function __construct(array $type = Values::ARRAY_NONE) {
        $this->options['type'] = $type;
    }

    /**
     * The visibility of the Channels to read. Can be: `public` or `private` and defaults to `public`.
     *
     * @param string[] $type The visibility of the channel to read
     * @return $this Fluent Builder
     */
    public function setType(array $type): self {
        $this->options['type'] = $type;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Chat.V1.ReadChannelOptions ' . $options . ']';
    }
}

class UpdateChannelOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     */
    public function __construct(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['attributes'] = $attributes;
    }

    /**
     * A descriptive string that you create to describe the resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * An application-defined string that uniquely identifies the resource. It can be used to address the resource in place of the resource's `sid` in the URL. This value must be 64 characters or less in length and be unique within the Service.
     *
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * A valid JSON string that contains application-specific data.
     *
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes): self {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Chat.V1.UpdateChannelOptions ' . $options . ']';
    }
}