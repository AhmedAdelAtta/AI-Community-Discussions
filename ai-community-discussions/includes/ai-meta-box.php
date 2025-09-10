<?php
// If this file is accessed directly, Exit.
if (! defined('ABSPATH')) {
    exit;
}

class AI_Meta_Box
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('wp_ajax_ai_generate_summary', array($this, 'ajax_generate_summary'));
    }

    public function add_meta_box()
    {
        add_meta_box(
            'ai_summary_box',
            __('AI Summary', 'community-discussions'),
            array($this, 'render_meta_box'),
            'community_discussion',
            'side',
            'default'
        );
    }

    public function render_meta_box($post)
    {
        wp_nonce_field('ai_summary_nonce', 'ai_summary_nonce');
        $summary = get_post_meta($post->ID, '_ai_summary', true);
?>
        <p>
            <button type="button" id="ai_generate_summary" class="button button-primary"><?php esc_html_e('Generate', 'ai-community-discussions'); ?></button>
        </p>
        <div id="ai_summary_display">
            <?php if ($summary) : ?>
                <strong><?php esc_html_e('Generated Summary:', 'ai-community-discussions'); ?></strong>
                <p><?php echo esc_html($summary); ?></p>
            <?php endif; ?>
        </div>
        <div id="custom_loader" style="display:none;"><?php esc_html_e('Generating...', 'ai-community-discussions'); ?></div>
        <script>
            jQuery(document).ready(function($) {
                $('#ai_generate_summary').on('click', function() {
                    $('#custom_loader').show();
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'ai_generate_summary',
                            post_id: <?php echo esc_js($post->ID); ?>,
                            nonce: $('#ai_summary_nonce').val()
                        },
                        success: function(response) {
                            $('#custom_loader').hide();
                            if (response.success) {
                                $('#ai_summary_display').html('<strong>Generated Summary:</strong><p>' + response.data.summary + '</p>');
                            } else {
                                alert(response.data.message || 'An error occurred.');
                            }
                        },
                        error: function() {
                            $('#custom_loader').hide();
                            alert('AJAX error.');
                        }
                    });
                });
            });
        </script>
<?php
    }

    public function ajax_generate_summary()
    {
        // For security to ensure the request is coming from the site 
        check_ajax_referer('ai_summary_nonce', 'nonce');

        // For security to ensure that only user with edit permission can use the feature
        if (! current_user_can('edit_posts')) {
            wp_send_json_error(array('message' => __('Permission denied.', 'ai-community-discussions')));
        }

        // Checks if post ID exists
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        if (! $post_id) {
            wp_send_json_error(array('message' => __('Invalid post ID.', 'ai-community-discussions')));
        }

        // Checks if post exists and post has the correct post type 'community discussion'
        $post = get_post($post_id);
        if (! $post || $post->post_type !== 'community_discussion') {
            wp_send_json_error(array('message' => __('Invalid post.', 'ai-community-discussions')));
        }


        // Checks if post content is not empty
        if (empty($post->post_content)) {
            wp_send_json_error(array('message' => __('Post content is empty. Cannot generate summary.', 'ai-community-discussions')));
        }

        // Default summary length is 50 words
        $summary_length = get_option('ai_cd_summary_length', 50);

        // Simulate summary by truncating content.
        $summary = $this->mock_ai_summary($post->post_content, $summary_length);

        // Sanitize output before storing.
        $summary = sanitize_text_field($summary);

        // Store as post meta data
        update_post_meta($post_id, '_ai_summary', $summary);
        wp_send_json_success(array('summary' => $summary));
    }

    private function mock_ai_summary($content, $length)
    {
        // Stripping tags and Truncating to word count.
        $content = wp_strip_all_tags($content);
        $words = explode(' ', $content);
        $summary = implode(' ', array_slice($words, 0, $length));
        return $summary . (count($words) > $length ? '...' : '');
    }
}
