<?php
class nc_change_location{
	public $terms = [];
	function __construct(){
		add_action('wp_head', function(){
			global $woocommerce;
			$this->terms = get_terms( array(
				'hide_empty' => false,
				'taxonomy' => 'pa_khu-vuc',
				'orderby' => 'id',
            	'order' => 'ASC',
            	
			) );
		});
		add_action('get_footer', array($this, 'nc_popup_callback'));
		add_shortcode( 'nc_change_location',  array($this, 'nc_change_location') );
	}

	function nc_change_location() {
		if(empty($this->terms)) return;
		$option = '';
		foreach ($this->terms as $term) {
			$option .= '<option value="'. $term->slug .'">'. $term->name .'</option>';
		}
		echo '<div class="nc-location"><span>Bạn đang xem tại:</span><select id="pa_khu-vuc"> '.$option.'</select></div>';
	}


	function nc_popup_callback(){
		if(empty($this->terms)) return;
		?>
		<div class="site-popup-wrap">
			<div class="site-popup">
				<p class="title">Chọn khu vực gần bạn nhất</p>
				<div class="location">
					<?php if(!empty($this->terms)){
						foreach ($this->terms as $term) {
							echo '<a href="#" id="', $term->slug ,'" class="item">', $term->name ,'</a>';
						}
					}?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			! function($) {
				var nc_popup = {}
				nc_popup.setCookie = function(name, value, days) {
					var expires;
					if (days) {
						var date = new Date();
						date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
						expires = "; expires=" + date.toGMTString()
					} else {
						expires = ""
					}
					document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/"
				}
				nc_popup.readCookie = function(name) {
					var nameEQ = encodeURIComponent(name) + "=";
					var ca = document.cookie.split(';');
					for (var i = 0; i < ca.length; i++) {
						var c = ca[i];
						while (c.charAt(0) === ' ') c = c.substring(1, c.length);
						if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length))
					}
				return null
			}
			nc_popup.set_attribute = function() {
				var $val = nc_popup.readCookie('attribute') 
				var $select = $('select#pa_khu-vuc') 
				if ($select && $val != undefined) {
					$select.val($val)
				}
			}
			nc_popup.init = function() {
				var $select = $('select#pa_khu-vuc')
				$(document).on('wc_variation_form', function($data){
					var attribute = $('form.variations_form').find('select#pa_khu-vuc')
					if(attribute.length){
						$select.children().prop('disabled', true)
						attribute.children().each(function(){
							$select.find('option[value="'+$(this).attr('value')+'"]').prop('disabled', false)
						})
					}
				})

				var $val = nc_popup.readCookie('attribute') 
				if ($val == undefined || !$select.eq(0).find('[value="' + $val + '"]')) {
					var $popup = $('.site-popup-wrap')
					$popup.css({
						display: 'flex'
					}) 
					$popup.find('.location a').click(function(e) {
						e.preventDefault() 
						$val = $(this).attr('id') 
						if ($val) {
							nc_popup.setCookie('attribute', $val, 30)
						}
						$popup.hide() 
						nc_popup.set_attribute()
						if($('form.variations_form').find('select#pa_khu-vuc').length){
							location.reload()
						}
					})
				} else {
					if ($select) {
						nc_popup.set_attribute() 
						$select.change(function(e) {
							nc_popup.setCookie('attribute', $(this).val(), 30) 
							nc_popup.set_attribute()
							if($(this).attr('name') == undefined){
								location.reload()
							}
						})
					}
				}
			}
			nc_popup.init()
		}(jQuery)
	</script>
	<?php 
}
}

new nc_change_location;