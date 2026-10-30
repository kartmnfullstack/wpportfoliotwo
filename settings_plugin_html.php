

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() );?></h1>
    <form action="options.php" method="post">
    <?php
        settings_fields('card_group');
        do_settings_sections('card_pg_1');
        do_settings_sections('card_pg_2');
        submit_button('Save Changes')
    ?>
    </form>
</div>