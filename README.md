# AI Community Discussions

A WordPress plugin that adds a **“Community Discussions”** custom post type with mock AI-generated summaries. Summaries are stored as post meta, configurable from an admin settings page, and can be displayed on the front-end (including in Elementor) via a shortcode.

---

## Features

- **Custom Post Type**: `community_discussion`
- **AI Summary Meta Box**: Generate and save mock AI summaries per discussion
- **Admin Settings Page**: Control summary length (50–500 words, default: 100)
- **Elementor Integration**: Display summaries anywhere with a shortcode

---

## Installation

1. **Upload the Plugin Folder**

   - Copy the `ai-community-discussions` folder into `/wp-content/plugins/`.

2. **Activate the Plugin**

   - In your WordPress admin, go to **Plugins > Installed Plugins**.
   - Activate _AI Community Discussions_.

---

## Usage

### 1. Create a Discussion

- Navigate to **Discussions > Add New**.
- Enter a title and content.
- In the **AI Summary** meta box (right sidebar), click **Generate AI Summary**.
- Save or publish the post.

### 2. Configure Summary Settings

- Go to **Settings > AI Discussions**.
- Adjust **Summary Length (words)**.
- Save changes.

### 3. Display the Summary

- Use the shortcode anywhere in posts, pages, or Elementor:
  [ai_summary_shortcode]
