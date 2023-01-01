<?php

namespace CPT;

class Project
{
    private $type               = 'Project';
    private $slug               = 'projects';
    private $name               = 'Projects';
    private $singular_name      = 'project';
    /**
     * Register post type
     */
    public function register()
    {

        $labels = array(
            'name'                  => _x($this->name, 'Post Type General Name', 'mp'),
            'singular_name'         => _x($this->singular_name, 'Post Type Singular Name', 'mp'),
            'menu_name'             => __($this->name, 'mp'),
            'name_admin_bar'        => __($this->name, 'mp'),
            'archives'              => __($this->name . ' Archives', 'mp'),
            'attributes'            => __($this->singular_name . ' Attributes', 'mp'),
            'parent_item_colon'     => __('Parent Item:', 'mp'),
            'all_items'             => __('All ' . $this->name, 'mp'),
            'add_new_item'          => __('Add New ' . $this->singular_name, 'mp'),
            'add_new'               => __('Add New', 'mp'),
            'new_item'              => __('New ' . $this->singular_name, 'mp'),
            'edit_item'             => __('Edit ' . $this->singular_name, 'mp'),
            'update_item'           => __('Update ' . $this->singular_name, 'mp'),
            'view_item'             => __('View ' . $this->singular_name, 'mp'),
            'view_items'            => __('View ' . $this->name, 'mp'),
            'not_found'             => __('Not found', 'mp'),
            'search_items'          => __('Search ' . strtolower($this->name), 'mp'),
            'not_found_in_trash'    => __('Not found in Trash', 'mp'),
            'featured_image'        => __('Featured Image', 'mp'),
            'set_featured_image'    => __('Set featured image', 'mp'),
            'remove_featured_image' => __('Remove featured image', 'mp'),
            'use_featured_image'    => __('Use as featured image', 'mp'),
            'insert_into_item'      => __('Insert into', 'mp'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'mp'),
            'items_list'            => __($this->name . ' list', 'mp'),
            'items_list_navigation' => __($this->name . ' list navigation', 'mp'),
            'filter_items_list'     => __('Filter ' . $this->name . ' list', 'mp'),
        );
        $rewrite = array(
            'slug'                  => $this->slug,
            'pages'                 => true,
            'with_front'            => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __($this->singular_name, 'mp'),
            'description'           => __($this->name, 'mp'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
            'taxonomies'            => array('category', 'post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 10,
            'menu_icon'             => 'dashicons-portfolio',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type($this->type, $args);
    }

    public function metabox()
    {
        //Register meta box for custom post types
        add_meta_box(
            'project-mb',            // Unique ID
            'Additional Information',   // Box title
            array($this, 'project_metabox'),       // Content callback, must be of type callable
            'project'                // Post type
        );
    }

    // Meta box logic
    public function project_metabox()
    {
        global $post;
?>
        <div class="project_box">
            <style scoped>
                .project_box {
                    display: grid;
                    grid-template-columns: max-content 1fr;
                    grid-row-gap: 10px;
                    grid-column-gap: 20px;
                }

                .project_field {
                    display: contents;
                }
            </style>

            <p class="meta-options project_field">
                <label for="show_main">Show On Main Page</label>
                <input id="show_main" type="checkbox" name="show_main" value="show" <?= get_post_meta($post->ID, 'show_main', true) == 'show' ? 'checked' : '' ?>>
            </p>
            <p class="meta-options project_field">
                <label for="order_main">Order on Main Page</label>
                <input id="order_main" type="number" min="0" name="order_main" value="<?= get_post_meta($post->ID, 'order_main', true) ?? '5' ?>">
            </p>
            <p class="meta-options project_field">
                <label for="project_status">Project Status</label>
                <select name="project_status" id="project_status">
                    <option value="complete" <?= get_post_meta($post->ID, 'project_status', true) == '' ? 'selected' : '' ?>>Select</option>
                    <option value="working" <?= get_post_meta($post->ID, 'project_status', true) == 'working' ? 'selected' : '' ?>>Working</option>
                    <option value="complete" <?= get_post_meta($post->ID, 'project_status', true) == 'complete' ? 'selected' : '' ?>>Complete</option>
                </select>
            </p>
            <p class="meta-options project_field">
                <label for="project_url">Project URL</label>
                <input id="project_url" placeholder="http://www.website.com" type="url" name="project_url" value="<?= get_post_meta($post->ID, 'project_url', true) ?? '' ?>">
            </p>
            <p class=" meta-options project_field">
                <label for="project_video">Project Video</label>
                <input id="project_video" type="url" placeholder="http://www.youtube.com" name="project_video" value="<?= get_post_meta($post->ID, 'project_video', true) ?? '' ?>">
            </p>
            <p class="meta-options project_field">
                <label for="project_category">Project Category</label>
                <input id="project_category" type="text" name="project_category" value="<?= get_post_meta($post->ID, 'project_category', true) ?? '' ?>">
            </p>
            <p class="meta-options project_field">
                <label for="project_tagline">Project Tagline</label>
                <input id="project_tagline" type="text" name="project_tagline" value="<?= get_post_meta($post->ID, 'project_tagline', true) ?? '' ?>">
            </p>
            <p class="meta-options project_field">
                <label for="additional_description">Aditional Project Description</label>
                <input id="additional_description" type="text" name="additional_description" value="<?= get_post_meta($post->ID, 'additional_description', true) ?? '' ?>">
            </p>
            <p class="meta-options project_field">
                <label for="additional_image">Aditional Project Image</label>
                <input id="additional_image" type="file" name="additional_image">
            </p>
            <p class="meta-options project_field">
                <label for="project_experience">Experience From</label>
                <select name="project_experience" id="project_experience">
                    <option value="" <?= get_post_meta($post->ID, 'project_experience', true) == '' ? 'selected' : '' ?>>Select</option>
                    <?php
                    // Experience on CPT
                    $experienceAdquired = [
                        'post_type' => 'experience',
                        'numberposts' => -1,
                    ];
                    $experiences = get_posts($experienceAdquired);
                    foreach ($experiences as $key => $experience) :
                    ?>
                        <option value="<?= $experience->ID ?>" <?= get_post_meta($post->ID, 'project_experience', true) == $experience->ID ? 'selected' : '' ?>><?= $experience->post_title ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>
<?php
    }

    public function post_edit_form_tag()
    {
        echo ' enctype="multipart/form-data"';
    }

    public function project_save_metabox($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if ($parent_id = wp_is_post_revision($post_id)) {
            $post_id = $parent_id;
        }

        $fields = [
            'project_url',
            'project_video',
            'project_category',
            'project_tagline',
            'additional_description',
            'additional_image',
            'order_main',
            'show_main',
            'project_status',
            'project_experience'
        ];

        if (!isset($_POST['show_main'])) {
            update_post_meta($post_id, 'show_main', false);
        }

        if (isset($_POST['project_experience'])) {
            $current = get_post_meta($post_id, 'project_experience', true);
            $experience = get_post_meta($_POST['project_experience'], 'project_experience', true);
            if (!$experience) {
                $experience = [$post_id];
            } else {
                if ($current) {
                    $cleanCurrent = get_post_meta($current, 'project_experience', true);
                    foreach ($cleanCurrent as $item => $clean) {
                        if ($clean == $post_id) unset($cleanCurrent[$item]);
                    }
                    update_post_meta($current, 'project_experience', $cleanCurrent);
                }
                $experience[] = $post_id;
            }
            update_post_meta($_POST['project_experience'], 'project_experience', $experience);
        }

        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }

        // Upload custom image
        if (!empty($_FILES['additional_image']['name'])) {
            $uploadedfile = $_FILES['additional_image']['name'];

            $upload_overrides = array(
                'test_form' => false
            );

            $files = $_FILES['additional_image'];
            $file = array(
                'name'      => $files['name'],
                'type'      => $files['type'],
                'tmp_name'  => $files['tmp_name'],
                'error'     => $files['error'],
                'size'      => $files['size']
            );
            $movefile = wp_handle_upload($file, $upload_overrides);
            apply_filters('wp_handle_upload', array('file' => $movefile['file'], 'url' => $movefile['url'], 'type' => $movefile['type']), 'upload');

            if ($movefile && !isset($movefile['error'])) {
                $wp_upload_dir = wp_upload_dir();
                $attachment = array(
                    'guid'              => $wp_upload_dir['url'] . '/' . basename($movefile['file']),
                    'post_mime_type'    => $movefile['type'],
                    'post_title'        => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
                    'post_content'      => '',
                    'post_status'       => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $movefile['file']);
                $attach_data = wp_generate_attachment_metadata($attach_id, $movefile['file']);
                wp_update_attachment_metadata($attach_id, $attach_data);
                update_post_meta($post_id, 'additional_image', $attach_id);
            } else {
                /*
                * Error generated by _wp_handle_upload()
                * @see _wp_handle_upload() in wp-admin/includes/file.php
                */
                echo $movefile['error'];
            }
        }
    }

    /**
     * Event constructor.
     *
     * When class is instantiated
     */
    public function __construct()
    {

        // Register the post type
        add_action('init', array($this, 'register'));
        // Register Meta box for custom fields
        add_action('add_meta_boxes', array($this, 'metabox'));
        // Allow file upload
        add_action('post_edit_form_tag', array($this, 'post_edit_form_tag'));
        // Add save post function for this specific field
        add_action('save_post_project', array($this, 'project_save_metabox'));
    }
}
