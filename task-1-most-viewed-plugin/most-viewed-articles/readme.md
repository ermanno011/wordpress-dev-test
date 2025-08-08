# Most Viewed Articles

**Contributors:** Aleksandar Bjelica  
**Tags:** popular posts, most viewed, statistics, analytics, widget  
**Requires at least:** 5.0  
**Tested up to:** 6.6  
**Requires PHP:** 7.4  
**Stable tag:** 1.1  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

Displays the most viewed posts on your site for **this week** and **this month**, with a tabbed interface. Includes a widget and an admin dashboard page to preview the top posts.

## Description

Most Viewed Articles tracks visits to your posts and displays the most popular ones in two time ranges:
- **This Week** (last 7 days)
- **This Month** (last 30 days)

Features:
- Sidebar widget with tabbed view
- Admin dashboard page under **Most Viewed** menu
- Responsive design with customizable CSS
- Records visitor IP and timestamp
- Option to limit counting to 1 view per IP per hour (to prevent spam refreshes)
- Works with AJAX so the stats update without reloading

## Installation

1. **Upload the plugin**
   - Download the plugin files and place them in the `/wp-content/plugins/most-viewed-articles/` directory.
   - Or install via the WordPress dashboard by uploading the ZIP.

2. **Activate the plugin**
   - Go to **Plugins → Installed Plugins** and click **Activate** next to *Most Viewed Articles*.

3. **Database table creation**
   - Upon activation, the plugin automatically creates a database table called `{prefix}_most_viewed` to store view records.

4. **Place the widget**
   - Go to **Appearance → Widgets**.
   - Add the **Most Viewed Articles** widget to your sidebar or any widget area.

5. **View stats in the admin**
   - After activation, you will see a **Most Viewed** menu in your WordPress dashboard.
   - This page shows the same tabbed interface with **This Week** and **This Month** stats.

6. **(Optional) Adjust view tracking**
   - By default, every page load of a single post is counted.
   - To limit to **1 view per IP per hour**, replace the `track_post_view()` method with the rate-limited version in the plugin code.

## Frequently Asked Questions

### Does it work with caching plugins like WP Rocket?
The front-end widget will work fine, but caching can block the tracking code because cached pages skip PHP execution.  
For full compatibility, enable **AJAX-based tracking** in the plugin code.

### Can I change the number of posts shown?
Yes — in the `ajax_get_articles()` function, change the `LIMIT 10` value to your desired number.

### Does it track pages or only posts?
By default, only `post` post types are tracked. You can modify the `WHERE p.post_type = 'post'` line in the SQL query to include other types.

### Does it store visitor data?
The plugin stores:
- Visitor IP address
- Post ID
- View timestamp

This is for counting purposes only.

### 1.0
- Initial release with frontend widget and basic tracking.

## License

This plugin is licensed under the GPLv2 or later.

