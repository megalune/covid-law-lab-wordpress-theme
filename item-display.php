
<p><strong><?php the_field('country'); ?></strong> <span class="label">(<?php the_field('national_or_subnational'); ?>)</span></p>

<p><span class="label">Issuing Authority:</span> <?php the_field('issuing_authority'); ?></p>

<!-- <p>Region: <?php the_field('region'); ?></p> -->

<p><span class="label">Type:</span> <?php the_field('type'); ?></p>

<p>
<?php
 if(get_field('date_issued')){
 	echo get_field('date_issued').' <span class="label">(issued)</span>';
 }
 if(get_field('date_expired')){
 	echo ' &mdash; '.get_field('date_expired').' <span class="label">(expired)</span>';
 }
?>
</p>

<!-- <h5>citation</h5>
<p><?php the_field('citation'); ?></p> -->

<p><a href="<?php the_field('document'); ?>" class="button">Download <?php the_field('type'); ?></a></p>

<div class="meta">
    <p><span class="label">Legal Topics:</span> <?php the_category( ', ' ); ?></p>

    <p><?php the_tags( '<span class="label">Tags:</span> ', ', ', '<br />' ); ?></p>
</div>