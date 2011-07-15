<?php

class wp_html5_category_selector {
	public function __construct() {
		add_action('admin_init', array($this, 'admin_head') );
		add_filter('plugin_row_meta', array($this, 'extra_plugin_links'), 10, 2);
		add_action('add_meta_boxes', array($this, 'add_html5category_boxes'));
	}
	
	// Add the required JavaScript and CSS
	public function admin_head(){
		wp_enqueue_script('jquery');
		wp_register_style('wp_html5_category_selector', WP_PLUGIN_URL . '/wp-html5-category-selector/admin.css' );
		wp_enqueue_style('wp_html5_category_selector');
	}
	
	// Add some helpful links to the plugin page.
	public function extra_plugin_links($links, $file){
		if ($file == 'wp-html5-category-selector/wp-html5-category-selector.php') {
            $links[] = '<a href="http://twitter.com/#!/rogem002">@Rogem002</a>';
        }
        return $links;
	}
	
	// Add the meta box to the post page.
	public function add_html5category_boxes(){
		add_meta_box(
			'wp_html5_category_selector',
			__( 'HTML5 Category Selector', 'wp_html5_category_selector', 'wp_html5_category_selector'), 
			array($this, 'add_html5category_box'),
			'post', 
			'side'
		);
	}
	
	// The boxes HTML/Javascript
	public function add_html5category_box(){
		?>
		<p><?php _e('You shouldn\'t see this. This box contains the JavaScript to add the filter box.', 'wp_html5_category_selector'); ?></p>
		<script type="text/javascript">
		//<![CDATA[
		(function($){
		
		$(document).ready(function() {
			function updateFiltered(){
				
				// If the field is empty, show everything.
				if($("#filterCats").val() == ''){
					$("#categorydiv .selectit").show();
					return true;
				}
				
				// Cycle through the options. Hide those without the text the user inputted.
				$("#categorydiv .selectit").each(function(){
					if($(this).text().toLowerCase().indexOf($("#filterCats").val().toLowerCase()) >= 0){
						$(this).show();
					} else {
						$(this).hide();
					}
				});
			}
		
			// Add the filter input
			$("#category-all").after('<div id="category-filter"><label><?php _e('Filter', 'wp_html5_category_selector'); ?>: <input type="text" id="filterCats" placeholder="<?php _e('Type to filter', 'wp_html5_category_selector'); ?>" /></label> <a class="clearThis">Clear</a></div>');
			
			// The listners
			$("#filterCats").keyup(updateFiltered);
			$("#filterCats").mouseout(updateFiltered);
			
			// Support the clear button
			$("#category-filter .clearThis").click(function(){
				$("#filterCats").val('');
				$("#filterCats").trigger('keyup');
			});
		});

		})(jQuery);
		//]]>
		</script>
		<?php
	}
}
