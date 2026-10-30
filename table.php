<?php   
    $data_text = get_post_meta( $post_id, 'card_title',true);
    $data_span = get_post_meta( $post_id, 'card_span_text',true);
    $data_p = get_post_meta( $post_id, 'card_paragraph_text',true);
    $data_url = get_post_meta( $post_id, 'card_button_url',true);
    $data_button = get_post_meta( $post_id, 'card_button_text',true);

    wp_nonce_field('save_bs_card_action', 'bs_card_nonce');
?>

<table style="width: 100%;">
    <tr>
        <th style="text-align: left; padding-bottom: 5px;">
            <label for="card_title">Card Title</label>
        </th>
        <td>
            <input type="text" name="card_title" id="card_title" style="width: 100%;" class="" value="<?php echo (isset($data_text)) ? esc_html($data_text) : ''; ?>" required>
        </td>
    </tr>
        <tr>
        <th style="text-align: left; padding-bottom: 5px;">
            <label for="card_span_text">Card Span text</label>
        </th>
        <td>
            <input type="text" name="card_span_text" id="card_span_text" style="width: 100%;" class="" value="<?php echo (isset($data_span)) ? esc_html($data_span) : ''; ?>" required>
        </td>
    </tr>
        <tr>
        <th style="text-align: left; padding-bottom: 5px;">
            <label for="card_paragraph_text">Card Text</label>
        </th>
        <td>
            <input type="text" name="card_paragraph_text" id="card_paragraph_text" style="width: 100%;" class="" value="<?php echo (isset($data_p)) ? esc_html($data_p) : ''; ?>" required>
        </td>
    </tr>
        <tr>
        <th style="text-align: left; padding-bottom: 5px;">
            <label for="card_button_url">Card Button Url</label>
        </th>
        <td>
            <input type="text" name="card_button_url" id="card_button_url" style="width: 100%;" class="" value="<?php echo (isset($data_url)) ? esc_html($data_url) : ''; ?>" required>
        </td>
    </tr>
        <tr>
        <th style="text-align: left; padding-bottom: 5px;">
            <label for="card_button_text">Card Button Text</label>
        </th>
        <td>
            <input type="text" name="card_button_text" id="card_button_text" style="width: 100%;" class="" value="<?php echo (isset($data_button)) ? esc_html($data_button) : ''; ?>" required>
        </td>
    </tr>

</table>