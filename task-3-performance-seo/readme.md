## Task 3 – Performance Optimization & SEO Best Practices

### 1. Three Key Performance Issues Affecting Core Web Vitals & How I’d Fix Them
**1. Large Unoptimized Images**  
  - Serve images in modern formats like **WebP** or **AVIF**.  
  - Use `srcset` and `sizes` so browsers only download the right size for the device.  
  - Apply lazy loading for all below-the-fold images.  
**2. Render-Blocking CSS & JavaScript**  
  - Inline critical CSS for above-the-fold content.  
  - Defer or `async` non-critical JavaScript.  
  - Minify and combine assets where possible to reduce HTTP requests.  
**3. Slow Server Response Time (TTFB)**  
  - Optimize database queries and clean up unused plugins.  
  - Use a caching layer (e.g., full-page cache via WP Rocket or built-in hosting cache).  
  - Serve static assets via a CDN and, if needed, move to faster hosting.

---

### 2. SEO Best Practices in WordPress
**1. Technical SEO**  
- Use clean, human-readable permalinks.  
- Generate and submit XML sitemaps.  
- Use canonical tags to prevent duplicate content issues.  
**2. Schema Markup**  
- Add **JSON-LD structured data** for:
  - `Article` schema on posts.  
  - `Person` schema for author pages.  
  - `Organization` schema for the site’s brand.  
**3. Meta Tags**  
- Set unique `<title>` and `<meta description>` for each page.  
- Add Open Graph and Twitter Card tags for social sharing.  
**4. Internal Linking**  
- Link related posts within the content to spread link equity.  
- Use breadcrumb navigation for better UX and crawlability.  
- Keep important content within 3 clicks from the homepage.  
**5. On-Page HTML & Accessibility SEO**  
- **Headings:** One `<h1>` per page for the main title, with logical `<h2>`, `<h3>` hierarchy for subtopics.  
- **Images:**  
  - Always include meaningful `alt` text for content images.  
  - Use empty `alt=""` for decorative images.  
  - Wrap images in `<figure>` with `<figcaption>` when adding captions.
