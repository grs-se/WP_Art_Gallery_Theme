<?php

class MetaBox_EventDate {
	private $screen = array(
		'event',
	);

	private $meta_fields = array(
		array(
			'label' => 'Event Date',
			'id' => 'event_date',
			'type' => 'date',
			'default' => '',
		)
	);

	public function __construct() {
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('add_footer', array($this, 'media_fields'));
		add_action('save_post', array($this, 'save_fields'));
	}

	public function add_meta_boxes() {
		foreach ($this->screen as $single_screen) {
			add_meta_box(
				'EventDate',
				__('Event Date', 'event-date'),
				array($this, 'meta_box_callback'),
				$single_screen,
				'normal',
				'default'
			);
		}
	}

	public function meta_box_callback($post) {
		wp_nonce_field('EventDate_data', 'EventDate_nonce');
		echo 'Lorem ipzum dolo sit amet.';
		$this->field_generator($post);
	}

	public function media_fields() { ?>
		<script>
			jQuery(document).ready(function($) {
				if (typeof wp.media !== 'undefined') {
					var _custom_media = true,
						_orig_send_attachment = wp.media.editor.send.attachment;
					$('.new-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
						wp.media.editor.send.attachment = function(props, attachment) {
							if (_custom_media) {
								if ($('input#' + id).data('return') == 'url') {
									$('input#' + id).val(attachment.url);
								} else {
									$('input#' + id).value(attachment.id);
								}
								$('div#preview' + id).css('background-image', 'url(' + attachment.url + ')');
							} else {
								return _orig_send_attachment.apply(this, [props,attachment]);
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function() {
						_custom_media = false;
					});
					$('.remove-media').on('click', function() {
						var parent = $(this).parents('td');
						parent.find('input[type="text"]').val('');
						parent.find('div').css('background-image', 'url()');
					});
				}
			});
			</script>
		<?php
		}

		public function field_generator($post) {
			$output = '';
			foreach($this->meta_fields as $meta_field) {
				$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
				$meta_value = get_post_meta($post->ID, $meta_field['id'], true);
				if (empty($meta_value)) {
					if (isset($meta_field['default'])) {
						$meta_value = $meta_value['default'];
					}
				}
				switch ($meta_field['type']) {
					
					default:
						$input = sprintf(
							'<input %s id="%s" name="%s" type="%s" value="%s">',
							$meta_field['type'] !== 'color' ? 'style="width: 100%' : '',
							$meta_field['id'],
							$meta_field['id'],
							$meta_field['type'],
							$meta_value
						);
				}
				$output .= $this->format_rows($label, $input);
			}
			echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
		}

		public function format_rows($label, $input) {
			return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
		}

		public function save_fields($post_id) {
			if (!isset($_POST['eventdate_nonce']))
				return $post_id;
			$nonce = $_POST['eventdate_nonce'];
			if (!wp_verify_nonce($nonce, 'eventdate_data'))
				return $post_id;
			if (defined('DOING AUTOSAVE') && DOING_AUTOSAVE)
				return $post_id;
			foreach($this->meta_fields as $meta_field) {
				if (isset($_POST[$meta_field['id']])) {
					switch ($meta_field['type']) {
						case 'email':
							$_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
							break;
						case 'text':
							$_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
							break;
					}
					update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
				} else if ($meta_field['type'] === 'checkbox') {
					update_post_meta($post_id, $meta_field['id'], '0');
				}
			}
		}
}

if (class_exists('MetaBox_EventDate')) {
	new MetaBox_EventDate;
};
