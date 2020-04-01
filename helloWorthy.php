<?php
/**
 * @package Hello_Dolly
 * @version 1.0
 */
/*
Plugin Name: Hello Worthy
Plugin URI: http://wordpress.org/extend/plugins/hello-worthy/
Description: This is based on the Hello Dolly plugin that comes as a standard install of all WordPress installations. Instead of lyrics to the song Hello, Dolly, this plugin will display a quote, reminder or other comment.
Author: Claire Worthington
Version: 1.0
Author URI: http://worthyontheweb.co.uk
*/

function hello_worthy_get_quote() {
	/** These are the lyrics to I love your smile*/
	$lyrics = "Hello, Worthy,
	Sitting in my class, just driftin' away,
	Staring into the windows of the world, yeah,
	I cant hear the teacher, his books don't call me at all,
	I dont see the bad boys tryin' to catch some play,Cause I love your smile,
	I love your smile,The clock at work says 3,
	And I wanna be free,
	Free to scream, free to bathe, free to paint
	My toes all day,
	My boss is lame you know, and so is the pay,
	I'm gonna put that new black mini on my charge anyway,";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_worthy() {
	$chosen = hello_worthy_get_quote();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_worthy' );

// We need some CSS to position the paragraph
function dolly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );

?>