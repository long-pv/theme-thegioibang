<?php

class ntBreadcrumb {
    public function __construct() {
        add_action('ux_builder_setup', array($this,'admin'));
        add_shortcode('nt_breadcrumb', array($this,'display'));
    }

    public function admin(){
        add_ux_builder_shortcode('nt_breadcrumb', array(
            'name'      => __('Breadcrumb'),
            'category'  => __('Content'),
            'priority'  => 1,
            'thumbnail' =>  $this->thumbnail( 'breadcrumb' ),
            'options' => array(
                'full_page'    =>  array(
                    'type' => 'radio-buttons',
                    'heading' => __('Full page'),
                    'default' => 'false',
                    'options' => array(
                        'false'  => array( 'title' => 'Off'),
                        'true'  => array( 'title' => 'On'),
                    ),
                ),
                
            ),
        ));
    }

    // Get path thumbnail ux
	public function thumbnail( $name ) {
		return NT_THUM . $name . '.svg';
	}
    
    public function display($atts){
        extract(shortcode_atts(array(
            'full_page'    => 'false',
        ), $atts));
        ob_start();
       
        if($full_page == 'true'): ?>
        <div id="breadcrumb-container" >
            <div class="breadcrumbs">
                <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
            </div>
        </div>
        <?php else: ?>
            <div id="breadcrumb-container" >
                <div class="row" >
                    <div class="large-12 col" >
                        <div class="breadcrumbs">
                            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php
        return ob_get_clean();
    }
    

}
new ntBreadcrumb();

