<?php
/**
 * @file field--fences-figure.tpl.php
 * Wrap each field value in the <figure> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-figure-element
 */
?>
<section class="file-downloads--client" data-eq-pts="small: 0, medium: 350">
  <?php if ($element['#label_display'] == 'inline'): ?>
    <span class="section-title"<?php print $title_attributes; ?>>
      <?php print $label; ?>:
    </span>
  <?php elseif ($element['#label_display'] == 'above'): ?>
    <h3 class="section-title"<?php print $title_attributes; ?>>
      <?php print $label; ?>
    </h3>
  <?php endif; ?>

  <?php foreach ($items as $delta => $item): ?>
    <?php print render($item); ?>
  <?php endforeach; ?>
</section>
