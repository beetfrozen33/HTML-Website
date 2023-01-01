<?php

namespace AdminPages;

class MyPortfolioOptions
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'mp_options_page'));
    }

    public function mp_options_page()
    {
        add_menu_page(
            'My Portfolio Options',
            'My Portfolio Options',
            'manage_options',
            'mp-options',
            array($this, 'mp_options_view'),
            'dashicons-star-filled',
            '12',
        );
    }

    public function mp_options_view()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->store_portoflio_options();
        }
?>
        <div class="wrap">
            <h1>My Portfolio Options</h1>

            <form method="post" action="admin.php?page=mp-options" novalidate="novalidate" enctype="multipart/form-data">
                <table class="form-table" role="presentation">

                    <tbody>
                        <tr>
                            <th scope="row"><label for="global_web_title">Global Title</label></th>
                            <td><input name="global_web_title" type="text" id="global_web_title" value="<?= get_option('global_web_title') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_top_heading">About top heading</label></th>
                            <td><input name="about_top_heading" type="text" id="about_top_heading" value="<?= get_option('about_top_heading') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_heading">About heading</label></th>
                            <td><input name="about_heading" type="text" id="about_heading" value="<?= get_option('about_heading') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_description">About Description</label></th>
                            <td><textarea name="about_description" id="about_description" class="regular-text"><?= get_option('about_description') ?? '' ?></textarea></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_more_url">Learn More</label></th>
                            <td><input name="about_more_url" type="url" id="about_more_url" value="<?= get_option('about_more_url') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <!-- <tr>
                            <th scope="row"><label for="email_form">Email Form</label></th>
                            <td><input name="email_form" type="email" id="email_form" value="<?= get_option('email_form') ?? '' ?>" class="regular-text"></td>
                            </td>
                        </tr> -->

                        <tr>
                            <th scope="row"><label for="about_type">Type of Description</label></th>
                            <td>
                                <select name="about_type" id="about_type">
                                    <option value="" <?= !empty(get_option('about_type')) ? '' : 'selected' ?>>Select</option>
                                    <option value="video" <?= get_option('about_type') != 'video' ? '' : 'selected' ?>>Video</option>
                                    <option value="image" <?= get_option('about_type') != 'image' ? '' : 'selected' ?>>Image</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_image">Upload Image</label></th>
                            <td>
                                <input name="about_image" type="file" id="about_image" class="regular-text">
                                <div class="uploaded-image" style="background-image:url('<?= wp_get_attachment_image_url(get_option('about_image')) ?>');width:100px;height:100px;background-size:contain;"></div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_resume">Upload Resume</label></th>
                            <td>
                                <input name="about_resume" type="file" id="about_resume" class="regular-text">
                                <?php if (get_option('about_resume')) :  ?>
                                    <a href="<?= wp_get_attachment_url(get_option('about_resume')) ?>" download>Download</a>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="about_video">Video Url</label></th>
                            <td><input name="about_video" type="url" id="about_video" value="<?= get_option('about_video') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="youtube_url">Youtube Url</label></th>
                            <td><input name="youtube_url" type="url" id="youtube_url" value="<?= get_option('youtube_url') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="linkedin_url">LinkedIn Url</label></th>
                            <td><input name="linkedin_url" type="url" id="linkedin_url" value="<?= get_option('linkedin_url') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="twitch_url">Twitch Url</label></th>
                            <td><input name="twitch_url" type="url" id="twitch_url" value="<?= get_option('twitch_url') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="twitter_url">Twitter Url</label></th>
                            <td><input name="twitter_url" type="url" id="twitter_url" value="<?= get_option('twitter_url') ?? '' ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="github_url">Github Url</label></th>
                            <td><input name="github_url" type="url" id="github_url" value="<?= get_option('github_url') ?? '' ?>" class="regular-text"></td>
                        </tr>
                    </tbody>
                </table>

                <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Portfolio Options"></p>
            </form>

        </div>
<?php
    }
    private function store_portoflio_options()
    {
        $fields = [
            'global_web_title',
            'about_top_heading',
            'about_heading',
            'about_description',
            'about_more_url',
            'about_type',
            'about_video',
            'about_type',
            'email_form',
            'youtube_url',
            'linkedin_url',
            'twitch_url',
            'twitter_url',
            'github_url'
        ];

        // Upload custom image
        if (!empty($_FILES['about_image']['name'])) {
            $uploadedfile = $_FILES['about_image']['name'];

            $upload_overrides = array(
                'test_form' => false
            );

            $files = $_FILES['about_image'];
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
                update_option('about_image', $attach_id);
            } else {
                /*
                * Error generated by _wp_handle_upload()
                * @see _wp_handle_upload() in wp-admin/includes/file.php
                */
                echo $movefile['error'];
            }
        }

        // Upload resume
        if (!empty($_FILES['about_resume']['name'])) {
            $uploadedfile = $_FILES['about_resume']['name'];

            $upload_overrides = array(
                'test_form' => false
            );

            $files = $_FILES['about_resume'];
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
                update_option('about_resume', $attach_id);
            } else {
                /*
                * Error generated by _wp_handle_upload()
                * @see _wp_handle_upload() in wp-admin/includes/file.php
                */
                echo $movefile['error'];
            }
        }

        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {

                if( $field === 'about_description'){
                    update_option($field, htmlentities($_POST[$field]));
                }
                else
                {
                    update_option($field, sanitize_text_field($_POST[$field]));
                }

            }
        }
    }
}
