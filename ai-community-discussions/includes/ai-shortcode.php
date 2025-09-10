<?php
// If this file is accessed directly, Exit.
if (! defined('ABSPATH')) {
    exit;
}

class AI_Shortcode
{
    public function __construct()
    {
        // Register shortcode
        add_shortcode('ai_summary_shortcode', array($this, 'summary_shortcode'));
    }

    /**
     * Shortcode handler for [ai_cd_summary]
     *
     * Returns the AI summary meta value
     */
    public function summary_shortcode($atts)
    {
        global $post;

        if (! $post || $post->post_type !== 'community_discussion') {
            return '';
        }

        $summary = get_post_meta($post->ID, '_ai_summary', true);

        return $summary ? esc_html($summary) : '';
    }
}
