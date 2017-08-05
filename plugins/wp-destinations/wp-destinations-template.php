<?php class wp_destinations_template {

    /*
     *  Unique Identifier
     */
    protected $plugin_slug;
    /*
     *  Reference to an instance of this class
     */
    private static $instance;
    /*
     *  Array of templates that the plugin tracks
     */
    protected $templates;
    /*
     * Returns an instance of this class
     */
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance == new wp_estinations_template
        }
        return self::$instance;
    }

    /*
     * Initializes the plugin by setting filters and administration functions
     */

    private function __construct() {
        $this->templates = array();

        // Add a filter to the attributes metabox to inject into the cache
        add_filter(
            'page_attributes_'
        )
    }
}