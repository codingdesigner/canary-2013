<?php
/**
 * @file field--fences-no-wrapper.tpl.php
 * Render each field value with no wrapper element.
 */
?>
<section class="media-contact">
  <?php if ($element['#label_display'] == 'inline'): ?>
    <span class=""<?php print $title_attributes; ?>>
      <?php print $label; ?>:
    </span>
  <?php elseif ($element['#label_display'] == 'above'): ?>
    <h3 class=""<?php print $title_attributes; ?>>
      <?php print $label; ?>
    </h3>
  <?php endif; ?>

  <?php foreach ($items as $delta => $item): ?>
    <?php print render($item); ?>
  <?php endforeach; ?>
</section>
