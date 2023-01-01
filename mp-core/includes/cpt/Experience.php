<?php

namespace CPT;

class Experience
{
    private $type               = 'Experience';
    private $slug               = 'experience';
    private $name               = 'Experience';
    private $singular_name      = 'experience';
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
            'menu_icon'             => 'dashicons-star-filled',
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
            'experience-mb',            // Unique ID
            'Additional Information',   // Box title
            array($this, 'experience_metabox'),       // Content callback, must be of type callable
            'experience'                // Post type
        );

        //Register meta box for custom post types
        add_meta_box(
            'project-mb',            // Unique ID
            'Projects Related',   // Box title
            array($this, 'projects_related_metabox'),       // Content callback, must be of type callable
            'experience'                // Post type
        );
    }

    // Meta box logic
    public function experience_metabox()
    {
        global $post;
?>
        <div class="experience_box">
            <style scoped>
                .experience_box {
                    display: grid;
                    grid-template-columns: max-content 1fr;
                    grid-row-gap: 10px;
                    grid-column-gap: 20px;
                }

                .experience_field {
                    display: contents;
                }
            </style>
            <p class="meta-options experience_field">
                <label for="experience_company">Company</label>
                <input id="experience_company" placeholder="Google" type="text" name="experience_company" value="<?= get_post_meta($post->ID, 'experience_company', true) ?? '' ?>">
            </p>
            <p class="meta-options experience_field">
                <label for="experience_title">Title</label>
                <input id="experience_title" placeholder="Software Engineer" type="text" name="experience_title" value="<?= get_post_meta($post->ID, 'experience_title', true) ?? '' ?>">
            </p>
            <p class="meta-options experience_field">
                <label for="experience_location">Location</label>
                <input id="experience_location" placeholder="Toronto, ON, Canada" type="text" name="experience_location" value="<?= get_post_meta($post->ID, 'experience_location', true) ?? '' ?>">
            </p>
            <p class="meta-options experience_field">
                <label for="experience_start_date">Start Date</label>
                <input id="experience_start_date" type="date" name="experience_start_date" value="<?= get_post_meta($post->ID, 'experience_start_date', true) ? date('Y-m-d', strtotime(get_post_meta($post->ID, 'experience_start_date', true))) : '' ?>">
            </p>
            <p class="meta-options experience_field">
                <label for="experience_end_date">End Date</label>
                <input id="experience_end_date" type="date" name="experience_end_date" value="<?= get_post_meta($post->ID, 'experience_end_date', true) ? date('Y-m-d', strtotime(get_post_meta($post->ID, 'experience_end_date', true))) : '' ?>">
            </p>
            <p class="meta-options experience_field">
                <label for="show_main">Show On Main Page</label>
                <?php $checked = get_post_meta($post->ID, 'show_main', true) == 'show' ? 'checked' : ''; ?>
                <input id="show_main" type="checkbox" name="show_main" value="show" <?= $checked ?>>
            </p>
            <p class="meta-options experience_field">
                <label for="order_main">Order on Main Page</label>
                <input id="order_main" type="number" min="0" name="order_main" value="<?= get_post_meta($post->ID, 'order_main', true) ?? '5' ?>">
            </p>
        </div>
    <?php
    }

    // Meta box logic
    public function projects_related_metabox()
    {
        global $post;
    ?>
        <div class="experience_box">
            <style scoped>
                .experience_box {
                    display: grid;
                    grid-template-columns: max-content 1fr;
                    grid-row-gap: 10px;
                    grid-column-gap: 20px;
                }

                .experience_field {
                    display: contents;
                }
            </style>
            <p class="meta-options experience_field">
                <?php
                // Experience on CPT
                $args = [
                    'post_type' => 'project',
                    'numberposts' => -1,
                ];
                $projects = get_posts($args);
                $exp = get_post_meta($post->ID, 'experience_project', true);
                foreach ($projects as $key => $project) :
                ?>

                    <input type="checkbox" name="experience_project[]" value="<?= $project->ID ?>" <?= in_array($project->ID, $exp) ? 'checked' : '' ?>><?= $project->post_title ?></option>
                <?php endforeach; ?>
            </p>
        </div>
<?php
    }

    public function experience_save_metabox($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if ($parent_id = wp_is_post_revision($post_id)) {
            $post_id = $parent_id;
        }

        $fields = [
            'experience_location',
            'experience_start_date',
            'experience_end_date',
            'experience_title',
            'experience_company',
            'order_main',
            'show_main',
            'experience_project'
        ];

        if (!isset($_POST['show_main'])) {
            update_post_meta($post_id, 'show_main', false);
        }
        if (!isset($_POST['experience_project'])) {
            $expCurrent = get_post_meta($post_id, 'experience_project', true);
            if (!empty($expCurrent)) {
                foreach ($expCurrent as $key => $value) {
                    if (!in_array($value, $_POST['experience_project']))
                        update_post_meta($value, 'project_experience', '');
                }
            }
            update_post_meta($post_id, 'experience_project', []);
        } else {
            $expCurrent = get_post_meta($post_id, 'experience_project', true);

            foreach ($_POST['experience_project'] as $keyProjectsNew => $project) {
                $otherExp = get_post_meta($project, 'project_experience', true);
                $otherExpProjects = get_post_meta($otherExp, 'experience_project', true);
                if (!empty($otherExpProjects)) {
                    foreach ($otherExpProjects as $keyProjectsPrev => $value) {
                        foreach ($_POST['experience_project'] as $incoming) {
                            if ($value == $incoming) {
                                unset($otherExpProjects[$keyProjectsPrev]);
                            }
                        }
                    }
                    update_post_meta($otherExp, 'experience_project', $otherExpProjects);
                }
            }
            if (!empty($expCurrent)) {
                foreach ($expCurrent as $key => $value) {

                    if (!in_array($value, $_POST['experience_project'])) {
                        update_post_meta($value, 'project_experience', '');
                    } else {
                        update_post_meta($value, 'project_experience', $post_id);
                    }
                }
            }
            update_post_meta($post_id, 'experience_project', $_POST['experience_project']);
        }

        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, $_POST[$field]);
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
        // Add save post function for this specific field
        add_action('save_post_experience', array($this, 'experience_save_metabox'));
    }
}
