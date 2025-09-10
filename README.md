# AI-Community-Discussions

A WordPress plugin that adds a "Community Discussions" custom post type with mock AI-generated summaries, stored as post meta and displayed on the front-end. It includes an admin settings page for summary length and integrates with Elementor via a shortcode.
How to Use

Install and Activate:

Download the plugin ZIP and in WordPress, go to Plugins > Add New > Upload Plugin, upload the ZIP, and activate AI Community Discussions.
Or, unzip and upload the ai-community-discussions folder to /wp-content/plugins/ via FTP, then activate.

Create a Discussion:

Go to Discussions > Add New in the WordPress admin.
Add a title and content.
In the AI Summary meta box (right sidebar), click Generate AI Summary to create a mock summary.
Save or publish the post.

Configure Summary Length:

Go to Settings > AI Discussions.
Set Summary Length (words) (50–500, default: 100).
Save changes.

Display Summary:

View the post (e.g., yoursite.com/community-discussions/your-post). The summary appears below the content.
In Elementor insert [ai_summary_shortcode] in your Elementor page or post to display a summary.
