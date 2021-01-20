<form class="search-form" action="<?php  echo esc_url(home_url('/')); ?>/" method="get">
    <fieldset>
        <input type="text" name="s" placeholder="<?php echo esc_attr__('Search...', 'globax'); ?>" />
        <input type="submit" />
    	<div class="search-icon"></div>
    </fieldset>
</form>