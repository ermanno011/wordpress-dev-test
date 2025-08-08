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
