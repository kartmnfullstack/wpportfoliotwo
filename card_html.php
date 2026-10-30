<div class="card shadow-lg h-100 w-100" style="background-color: <?php echo esc_attr($card_bg_color); ?>;">
  <?php if (!empty($card_image)): ?>
    <img src="<?php echo esc_url($card_image); ?>" class="card-img-top" alt="<?php echo esc_attr($card_title); ?>">
  <?php endif; ?>
  <div class="card-body">
    <h5 class="card-title"><?php echo esc_html($card_title); ?></h5>
    
    <?php if ($card_toggle_info && !empty($card_span_text)): ?>
        <span class="text-muted small mb-2"><?php echo esc_html($card_span_text); ?></span>
    <?php endif; ?>    
    <hr>
    <p class="card-text py-4"><?php echo esc_html($card_paragraph_text); ?></p>
    <hr>
    <?php if (!empty($card_button_url)): ?>
      <a href="<?php echo esc_url($card_button_url); ?>" class="btn btn-primary p-3 d-block mx-auto"><?php echo esc_html($card_button_text); ?></a>
    <?php endif; ?>
  </div>
</div>