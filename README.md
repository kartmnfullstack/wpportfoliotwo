# Custom WordPress Plugin: Dynamic Bootstrap Card

A custom WordPress plugin designed to display Bootstrap-styled cards dynamically by controlling layout settings and injecting content via a dynamic loop. Built as a core component of a professional development portfolio to demonstrate custom loop handling, data fetching, and modular architecture.
Built as a core piece of my professional development portfolio to showcase custom loop handling and data fetching.

## 🚀 Key Learning Objectives & Features
* **Dynamic WP_Query Loop:** Replaces hardcoded UI elements by pulling recent posts directly from the WordPress database.
* **Highly Customizable:** Enables the overall implementation of Boostrap card in a fast and customizable manner.
* **Shortcode Engine:** Proper data quering from settings and metadata to enable shortcode implementation both inline and via settings. 
* **Modular Architecture:** Structured with object-oriented principles, using classes and isolated files for settings, loops, and hooks to ensure a clean codebase.
* **Bootstrap Customisation:** Blends native Bootstrap utilities with existing WordPress CSS classes to deliver a tailored, performance-focused layout.

## 🛠️ CPT sample (creation)
This snippet highlights the creation of the custom post type inside the plugin:

```php
public function create_card(){
        register_post_type('bs_card',array(
                'label' => 'Add Bootstrap Card',
                'description' => 'Card for usage',
                'public' => true,
                'supports' => array('title','editor','thumbnail'),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => false,
                'menu_position' => 20,
                'show_in_admin_bar' => false,
                'show_in_nav_menus' => false,
                'can_export' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-table-row-before',
        )
        );
        
    }
}
```

## ⚙️ Installation & Usage Instructions

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/kartmnfullstack/wpportfoliotwo.git
   cd wpportfolio2
   ```
2. **Move the Folder:** 
   Copy the folder into the plugins folder under wp-content for the plugin.
3. **Select the Template:** 
   Log into the WordPress dashboard, click on activate to activate the plugin. 
4. **Add Bootstrap post:** 
   Add content dynamically by using shortcode and metadata or inline via shortcode.
5. **View Content Delivery:**
   The custom Bootstrap post will render on the page as per the settings page definition. Shortcode is [bs_card]
