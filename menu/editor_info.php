<?php

add_action( 'admin_footer', 'wp_mce_popup' );
add_action( 'media_buttons', 'krs_media_buttons' );

/**
 * Utility to add MCE Popup fired by custom Media Buttons button
 *
 * @hook admin_footer
 */
function wp_mce_popup() {
	?>
	<script>
		function InsertContainer() {
			// let's obtain the values of the fields
			var content = jQuery('#krs_content_container').val();
			var heading = jQuery('#krs_heading').val();
			var subheading = jQuery('#krs_sheading').val();

			window.send_to_editor("[div heading='"+heading+"' subheading='"+ subheading +"']" +content + '[/div]');
		}
	</script>

	<div id="krs_div_shortcode" style="display:none;">
		<div class="wrap krs_shortcode">
			<div>
				<div style="padding:15px 15px 0 15px;">
					<h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;">KRS shortcodes</h3>
					<p>Hier die wichtigste "Shortcodes"</p>
					<hr />
					<div class="field-container">
						<div class="label-desc krs_console">[logo]</div>
						<div class="content">
							Fügt einem rechtsbündigen KRS logo hinzu.
              <div class="options">
              options:<br/>
                <b>positon</b>: (<i>left|right</i>) macht es links- bzw. rechtsbündig
              </div>
              Examples:
              <div class="krs_console">
                [logo]<br/>
                [logo position=left]
              </div>
						</div>
					</div>
          <div class="field-container">
						<div class="label-desc krs_console">[krs]</div>
						<div class="content">
							Fügt <span>KUNST.R<span style="font-style:italic;color:#ec048c">A</span>UM.STEGLITZ</span> hinzu
              <div class="options">
              options: None<br/>
              Examples:
              <div class="krs_console">
                [krs]
              </div>
						</div>
					</div>
					</div>
				</div>

				<hr />
				<div style="padding:15px;">
					<a class="button-primary" href="#" onclick="tb_remove();
							return false;">Close</a>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Utility to add MCE Popup button to the Media Buttons section which lies directly
 * above the Visual / Text Editor
 *
 * @hook media_buttons
 */
function krs_media_buttons() {
	?>
	<style>
		.wp-core-ui a.editr_media_link {
			padding-left: 0.4em;
		}

		.label-desc {
			min-width: 60px;
			margin-right: 3%;
			float: left;
			font-weight: bold;
			text-align: right;
			padding-top: 2px;
		}
		.krs_shortcode .content {
			float: left;
			width: 70%;
		}
		.field-container {
			margin: 5px 0;
			display: inline-block;
			width: 100%;
		}
    .krs_console {
      font-family: "Lucida Console", Monaco, monospace;
    }
		#TB_ajaxContent h3 {
			margin-bottom: 20px;
		}
	</style>
	<a href = "#TB_inline?width=480&height=500&inlineId=krs_div_shortcode" class = "button thickbox krs_media_link" id = "add_div_shortcode" title = "Kunst Raum Steglitz - shortcodes">KRS Shortcodes</a></li>
	<?php
}
