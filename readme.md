# WordPress Developer Test – Tasks 1–3

This repository contains my solutions for the WordPress developer test.  
It includes:

1. **Task 1 – Custom WordPress Plugin:** Most Viewed Articles widget with a tabbed interface (This Week / This Month) and unique view counting logic.
2. **Task 2 – Frontend Implementation:** Custom WordPress theme author page template based on provided Figma design.
3. **Task 3 – Performance Optimization & SEO Best Practices:** Written explanation of key Core Web Vitals improvements and SEO recommendations.

---

## Live Demo

- **Main site:** https://darkseagreen-ant-563107.hostingersite.com/  
- **Author page example:** https://darkseagreen-ant-563107.hostingersite.com/author/barry/
- Demo website is locked and credentials are delivered via email.
- /wp-admin/ login:
- username: Berry
- password: @leksandarBj3lica

---

## Installation

### Task 1 – Most Viewed Articles Plugin
1. Upload the `most-viewed-articles` folder to `wp-content/plugins/`.
2. Activate it in the WordPress admin panel.
3. Add the widget via **Appearance → Widgets**.

### Task 2 – Custom Author Page Template
1. Upload the `custom-author-theme` folder to `wp-content/themes/`.
2. Activate it in the WordPress admin panel.
3. Extract `uploads.zip` file to `wp-content/uploads`
4. Install `Advanced Custom Fields` plugin
5. Import `acf-export-2025-08-08.json` inside `Advanced Custom Fields` plugin tools
6. Visit any author archive page (e.g., `/author/barry/`).

---

## Task 3 – Performance & SEO

Full write-up is in:  
[`task-3-performance-seo.md`](task-3-performance-seo/performance-seo.md)  

Covers:
- Three key Core Web Vitals issues and fixes.
- Technical SEO setup (meta tags, schema, internal linking).
- On-page HTML & accessibility best practices.

---

## Self-Assessment

- Focused on **clean, maintainable code** following WordPress coding standards.
- Kept HTML/CSS/JS lightweight with no unnecessary libraries.
- Designed for **mobile-first** and tested against Google Lighthouse.
- Added performance-conscious features like lazy loading and modern image formats.
- Documented installation for quick setup.

---

**Author:** Aleksandar Bjelica
**Date:** 8/8/2025






