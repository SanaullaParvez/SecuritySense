<?php
/*
Template Name: Contact 
*/
?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<div class="sub_content">
        <div class="content">
	<form action="mailto:admin@localhost" method="post" enctype="text/plain">
	<table border="0" cellspacing="0" cellpadding="4" width="90%">
	<tr>
	<td width="30%"><div align="right">
	<b>Name:</b>
	</div>
	</td>
	<td width="70%">
	<input type="text" name="name" size="20">
	</td>
	</tr>
	<tr>
	<td><div align="right"><b>Email:</b></div>
	</td>
	<td>
	<input type="text" name="email" size="20">
	</td>
	</tr>
	<tr>
	<td><div align="right">
	<b>Message:</b>
	</div>
	</td>
	<td><textarea name="comment" cols="30" wrap="virtual" rows="4">
	</textarea>
	</td></tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<input type="submit" name="submit" value="submit">
	<input type="reset" name="reset" value="reset">
	</td></tr>
	</table>
	</form>
</div><!--content End-->
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>
