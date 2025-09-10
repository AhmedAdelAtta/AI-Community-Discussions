<?php
// If this file is accessed directly, Exit.
if (! defined('ABSPATH')) {
    exit;
}

class AI_Custom_Post_Type
{
    public function __construct()
    {
        add_action('init', array($this, 'register_cpt'));
    }

    public function register_cpt()
    {
        $labels = array(
            'name'                  => _x('Community Discussions', 'ai-community-discussions'),
            'singular_name'         => _x('Community Discussion', 'ai-community-discussions'),
            'menu_name'             => __('Community Discussions', 'ai-community-discussions'),
            'name_admin_bar'        => __('Discussion', 'ai-community-discussions'),
            'all_items'             => __('All Discussions', 'ai-community-discussions'),
            'add_new_item'          => __('Add New Discussion', 'ai-community-discussions'),
            'new_item'              => __('New Discussion', 'ai-community-discussions'),
            'edit_item'             => __('Edit Discussion', 'ai-community-discussions'),
            'update_item'           => __('Update Discussion', 'ai-community-discussions'),
        );

        $args = array(
            'label'                 => __('Community Discussion', 'ai-community-discussions'),
            'description'           => __('AI Generated Summaries for Communiy Discussions', 'ai-community-discussions'),
            'labels'                => $labels,
            'public'                => true,
            'show_in_rest'          => true,
            'supports'              => array('title', 'editor', 'author', 'comments'),
            'capability_type'       => 'post',
        );



        register_post_type('community_discussion', $args);
    }
}
