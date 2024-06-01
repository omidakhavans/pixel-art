<?php

namespace RBL\Pixel_Art;

/**
 * Class CacheHandler
 *
 * Handles caching operations for various data.
 *
 * @package RBL\Pixel_Art
 * @since 1.0
 */
class CacheHandler {

    /**
     * Cache group.
     *
     * @var string
     */
    protected string $cache_group;

    /**
     * Cache expiration time in seconds.
     *
     * @var int
     */
    protected int $cache_expiration;

    /**
     * CacheHandler constructor.
     *
     * @param string $cache_group Cache group name.
     * @param int    $cache_expiration Cache expiration time in seconds.
     */
    public function __construct( string $cache_group, int $cache_expiration = HOUR_IN_SECONDS ) {
        $this->cache_group = $cache_group;
        $this->cache_expiration = $cache_expiration;
    }

    /**
     * Retrieve data from cache or database.
     *
     * @param string $cache_key Cache key.
     * @param mixed  $default Default value if cache miss.
     * @return mixed Cached data or default value.
     */
    public function get( string $cache_key, $default = false ) {
        $data = wp_cache_get( $cache_key, $this->cache_group );

        if ( false === $data ) {
            $data = get_option( $cache_key, $default );
            $this->set( $cache_key, $data );
        }

        return $data;
    }

    /**
     * Save data to the cache and database.
     *
     * @param string $cache_key Cache key.
     * @param mixed  $data Data to cache.
     */
    public function set( string $cache_key, $data ): void {
        // Save to cache.
        wp_cache_set( $cache_key, $data, $this->cache_group, $this->cache_expiration );
        // Save to database.
        update_option( $cache_key, $data );
    }

    /**
     * Clear the cache.
     *
     * @param string $cache_key Cache key.
     */
    public function clear( string $cache_key ): void {
        wp_cache_delete( $cache_key, $this->cache_group );
    }
}
