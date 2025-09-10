<?php

/**
 * Plugin Name: AI Community Discussions
 * Description: AI Generated Summaries for Communiy Discussions
 * Version: 1.0
 * Author: Ahmed Adel
 */


// If this file is accessed directly, Exit.
if (! defined('ABSPATH')) {
    exit;
}


class AI_Community_Discussions
{
    public function __construct()
    {

        // Include class files.
        require_once plugin_dir_path(__FILE__) . 'includes/ai-cpt.php';
        require_once plugin_dir_path(__FILE__) . 'includes/ai-meta-box.php';
        require_once plugin_dir_path(__FILE__) . 'includes/ai-settings.php';
        require_once plugin_dir_path(__FILE__) . 'includes/ai-shortcode.php';

        // Initialize the Classes
        new AI_Custom_Post_Type();
        new AI_Meta_Box();
        new AI_Settings();
        new AI_Shortcode();
    }
}

// Initialize the Plugin
new AI_Community_Discussions();
