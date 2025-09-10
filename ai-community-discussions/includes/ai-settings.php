<?php
// If this file is accessed directly, Exit.
if (! defined('ABSPATH')) {
    exit;
}

class AI_Settings
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function add_settings_page()
    {
        add_options_page(
            __('AI Discussions Settings', 'ai-community-discussions'),
            __('AI Discussions', 'ai-community-discussions'),
            'manage_options',
            'ai-cd-settings',
            array($this, 'render_settings_page')
        );
    }

    public function render_settings_page()
    {
?>
        <div class="wrap">
            <h1><?php esc_html_e('AI Community Discussions Settings', 'ai-community-discussions'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('ai_cd_settings_group');
                do_settings_sections('ai-cd-settings');
                submit_button();
                ?>
            </form>
        </div>
<?php
    }

    public function register_settings()
    {
        register_setting('ai_cd_settings_group', 'ai_cd_summary_length', array($this, 'sanitize_summary_length'));

        add_settings_section(
            'ai_cd_main_section',
            __(' Configuration', 'ai-community-discussions'),
            null,
            'ai-cd-settings'
        );

        add_settings_field(
            'ai_cd_summary_length',
            __('Summary Length (words)', 'ai-community-discussions'),
            array($this, 'render_summary_length_field'),
            'ai-cd-settings',
            'ai_cd_main_section'
        );
    }

    public function render_summary_length_field()
    {
        $value = get_option('ai_cd_summary_length', 100);
        echo '<input type="number" name="ai_cd_summary_length" value="' . esc_attr($value) . '" min="20" max="500" />';
        echo '<p class="description">' . esc_html__('word count should be between 20 and 500.', 'ai-community-discussions') . '</p>';
    }

    public function sanitize_summary_length($input)
    {
        $input = intval($input);

        // Handle if the Word Count is either too short (< 20) or too long (> 500)
        if ($input < 20 || $input > 500) {
            add_settings_error('ai_cd_summary_length', 'ai_cd_summary_length_error', __('Summary length must be between 20 and 500.', 'ai-community-discussions'), 'error');
            return get_option('ai_cd_summary_length', 100);
        }
        return $input;
    }
}
