<?php
class wp_html5_category_selector {
	// The function which registers everything.
	public function __construct() {
		add_action('admin_init', array($this, 'admin_init'));
		add_filter('plugin_row_meta', array($this, 'extra_plugin_links'), 10, 2);
		
		add_action('admin_footer', array($this, 'admin_footer'));
	}
	
	// Add the required JavaScript
	public function admin_init(){
		wp_register_script('wp_html5_category_selector', plugins_url('wp-html5-category-selector.js', dirname(__FILE__)), false, wp_html5_category_selector_version, true);
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('wp_html5_category_selector');
	}
	
	// Add some helpful links to the plugin page.
	public function extra_plugin_links($links, $file){
		if ($file == 'wp-html5-category-selector/wp-html5-category-selector.php') {
            $links[] = '<a href="http://twitter.com/#!/rogem002">@Rogem002</a>';
        }
        return $links;						
	}
	
	// The boxes HTML/Javascript
	public function admin_footer(){
		?>
        <div class="hidden">
            <p id="category-filter">
                <input type="text" id="filterCats" placeholder="<?php _e('Type to filter', 'wp_html5_category_selector'); ?>" /> <input type="button" class="button clearThis" value="Clear" tabindex="4">
            </p>
        </div>
		<?php
	}
}
?>