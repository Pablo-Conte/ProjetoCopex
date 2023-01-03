<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service\SyncList;

use Twilio\Options;
use Twilio\Values;

abstract class SyncListItemOptions {
    /**
     * @param string $ifMatch The If-Match HTTP request header
     * @return DeleteSyncListItemOptions Options builder
     */
    public static function delete(string $ifMatch = Values::NONE): DeleteSyncListItemOptions {
        return new DeleteSyncListItemOptions($ifMatch);
    }

    /**
     * @param int $ttl An alias for item_ttl
     * @param int $itemTtl How long, in seconds, before the List Item expires
     * @param int $collectionTtl How long, in seconds, before the List Item's
     *                           parent Sync List expires
     * @return CreateSyncListItemOptions Options builder
     */
    public static function create(int $ttl = Values::NONE, int $itemTtl = Values::NONE, int $collectionTtl = Values::NONE): CreateSyncListItemOptions {
        return new CreateSyncListItemOptions($ttl, $itemTtl, $collectionTtl);
    }

    /**
     * @param string $order The order to return the List Items
     * @param string $from The index of the first Sync List Item resource to read
     * @param string $bounds Whether to include the List Item referenced by the
     *                       from parameter
     * @return ReadSyncListItemOptions Options builder
     */
    public static function read(string $order = Values::NONE, string $from = Values::NONE, string $bounds = Values::NONE): ReadSyncListItemOptions {
        return new ReadSyncListItemOptions($order, $from, $bounds);
    }

    /**
     * @param array $data A JSON string that represents an arbitrary, schema-less
     *                    object that the List Item stores
     * @param int $ttl An alias for item_ttl
     * @param int $itemTtl How long, in seconds, before the List Item expires
     * @param int $collectionTtl How long, in seconds, before the List Item's
     *                           parent Sync List expires
     * @param string $ifMatch The If-Match HTTP request header
     * @return UpdateSyncListItemOptions Options builder
     */
    public static function update(array $data = Values::ARRAY_NONE, int $ttl = Values::NONE, int $itemTtl = Values::NONE, int $collectionTtl = Values::NONE, string $ifMatch = Values::NONE): UpdateSyncListItemOptions {
        return new UpdateSyncListItemOptions($data, $ttl, $itemTtl, $collectionTtl, $ifMatch);
    }
}

class DeleteSyncListItemOptions extends Options {
    /**
     * @param string $ifMatch The If-Match HTTP request header
     */
    public function __construct(string $ifMatch = Values::NONE) {
        $this->options['ifMatch'] = $ifMatch;
    }

    /**
     * If provided, applies this mutation if (and only if) the “revision” field of this [map item] matches the provided value. This matches the semantics of (and is implemented with) the HTTP [If-Match header](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/If-Match).
     *
     * @param string $ifMatch The If-Match HTTP request header
     * @return $this Fluent Builder
     */
    public function setIfMatch(string $ifMatch): self {
        $this->options['ifMatch'] = $ifMatch;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Sync.V1.DeleteSyncListItemOptions ' . $options . ']';
    }
}

class CreateSyncListItemOptions extends Options {
    /**
     * @param int $ttl An alias for item_ttl
     * @param int $itemTtl How long, in seconds, before the List Item expires
     * @param int $collectionTtl How long, in seconds, before the List Item's
     *                           parent Sync List expires
     */
    public function __construct(int $ttl = Values::NONE, int $itemTtl = Values::NONE, int $collectionTtl = Values::NONE) {
        $this->options['ttl'] = $ttl;
        $this->options['itemTtl'] = $itemTtl;
        $this->options['collectionTtl'] = $collectionTtl;
    }

    /**
     * An alias for `item_ttl`. If both parameters are provided, this value is ignored.
     *
     * @param int $ttl An alias for item_ttl
     * @return $this Fluent Builder
     */
    public function setTtl(int $ttl): self {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * How long, [in seconds](https://www.twilio.com/docs/sync/limits#sync-payload-limits), before the List Item expires (time-to-live) and is deleted.
     *
     * @param int $itemTtl How long, in seconds, before the List Item expires
     * @return $this Fluent Builder
     */
    public function setItemTtl(int $itemTtl): self {
        $this->options['itemTtl'] = $itemTtl;
        return $this;
    }

    /**
     * How long, [in seconds](https://www.twilio.com/docs/sync/limits#sync-payload-limits), before the List Item's parent Sync List expires (time-to-live) and is deleted.
     *
     * @param int $collectionTtl How long, in seconds, before the List Item's
     *                           parent Sync List expires
     * @return $this Fluent Builder
     */
    public function setCollectionTtl(int $collectionTtl): self {
        $this->options['collectionTtl'] = $collectionTtl;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Sync.V1.CreateSyncListItemOptions ' . $options . ']';
    }
}

class ReadSyncListItemOptions extends Options {
    /**
     * @param string $order The order to return the List Items
     * @param string $from The index of the first Sync List Item resource to read
     * @param string $bounds Whether to include the List Item referenced by the
     *                       from parameter
     */
    public function __construct(string $order = Values::NONE, string $from = Values::NONE, string $bounds = Values::NONE) {
        $this->options['order'] = $order;
        $this->options['from'] = $from;
        $this->options['bounds'] = $bounds;
    }

    /**
     * How to order the List Items returned by their `index` value. Can be: `asc` (ascending) or `desc` (descending) and the default is ascending.
     *
     * @param string $order The order to return the List Items
     * @return $this Fluent Builder
     */
    public function setOrder(string $order): self {
        $this->options['order'] = $order;
        return $this;
    }

    /**
     * The `index` of the first Sync List Item resource to read. See also `bounds`.
     *
     * @param string $from The index of the first Sync List Item resource to read
     * @return $this Fluent Builder
     */
    public function setFrom(string $from): self {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * Whether to include the List Item referenced by the `from` parameter. Can be: `inclusive` to include the List Item referenced by the `from` parameter or `exclusive` to start with the next List Item. The default value is `inclusive`.
     *
     * @param string $bounds Whether to include the List Item referenced by the
     *                       from parameter
     * @return $this Fluent Builder
     */
    public function setBounds(string $bounds): self {
        $this->options['bounds'] = $bounds;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Sync.V1.ReadSyncListItemOptions ' . $options . ']';
    }
}

class UpdateSyncListItemOptions extends Options {
    /**
     * @param array $data A JSON string that represents an arbitrary, schema-less
     *                    object that the List Item stores
     * @param int $ttl An alias for item_ttl
     * @param int $itemTtl How long, in seconds, before the List Item expires
     * @param int $collectionTtl How long, in seconds, before the List Item's
     *                           parent Sync List expires
     * @param string $ifMatch The If-Match HTTP request header
     */
    public function __construct(array $data = Values::ARRAY_NONE, int $ttl = Values::NONE, int $itemTtl = Values::NONE, int $collectionTtl = Values::NONE, string $ifMatch = Values::NONE) {
        $this->options['data'] = $data;
        $this->options['ttl'] = $ttl;
        $this->options['itemTtl'] = $itemTtl;
        $this->options['collectionTtl'] = $collectionTtl;
        $this->options['ifMatch'] = $ifMatch;
    }

    /**
     * A JSON string that represents an arbitrary, schema-less object that the List Item stores. Can be up to 16 KiB in length.
     *
     * @param array $data A JSON string that represents an arbitrary, schema-less
     *                    object that the List Item stores
     * @return $this Fluent Builder
     */
    public function setData(array $data): self {
        $this->options['data'] = $data;
        return $this;
    }

    /**
     * An alias for `item_ttl`. If both parameters are provided, this value is ignored.
     *
     * @param int $ttl An alias for item_ttl
     * @return $this Fluent Builder
     */
    public function setTtl(int $ttl): self {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * How long, [in seconds](https://www.twilio.com/docs/sync/limits#sync-payload-limits), before the List Item expires (time-to-live) and is deleted.
     *
     * @param int $itemTtl How long, in seconds, before the List Item expires
     * @return $this Fluent Builder
     */
    public function setItemTtl(int $itemTtl): self {
        $this->options['itemTtl'] = $itemTtl;
        return $this;
    }

    /**
     * How long, [in seconds](https://www.twilio.com/docs/sync/limits#sync-payload-limits), before the List Item's parent Sync List expires (time-to-live) and is deleted. This parameter can only be used when the List Item's `data` or `ttl` is updated in the same request.
     *
     * @param int $collectionTtl How long, in seconds, before the List Item's
     *                           parent Sync List expires
     * @return $this Fluent Builder
     */
    public function setCollectionTtl(int $collectionTtl): self {
        $this->options['collectionTtl'] = $collectionTtl;
        return $this;
    }

    /**
     * If provided, applies this mutation if (and only if) the “revision” field of this [map item] matches the provided value. This matches the semantics of (and is implemented with) the HTTP [If-Match header](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/If-Match).
     *
     * @param string $ifMatch The If-Match HTTP request header
     * @return $this Fluent Builder
     */
    public function setIfMatch(string $ifMatch): self {
        $this->options['ifMatch'] = $ifMatch;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Sync.V1.UpdateSyncListItemOptions ' . $options . ']';
    }
}