# Sarmad Gardezi WordPress Theme Architecture & Structure

A high-performance, modular custom WordPress portfolio and case-study theme designed for Sarmad Gardezi.

---

## 📁 Complete Theme Directory Structure

```text
sarmadgardezi/                       # WordPress Theme Root
│
├── style.css                         # Required WP theme metadata & header
├── functions.php                     # Theme bootstrap only (loads inc/)
├── theme.json                        # Global block & editor styles/tokens
├── index.php                         # Required fallback template
├── screenshot.png                    # Appearance > Themes preview image (1200x900)
├── THEME_STRUCTURE.md                # Structural architecture documentation
│
├── header.php                        # HTML5 document head & global site-header call
├── footer.php                        # Global site-footer call & closing scripts
├── front-page.php                    # Dynamic homepage section orchestrator
├── home.php                          # Blog listing template
├── single.php                        # Standard blog post template
├── page.php                          # Standard static page template
├── archive.php                       # Archive fallback template
├── search.php                        # Search results template
├── searchform.php                    # Search form component
├── 404.php                           # 404 Error page template
├── comments.php                      # Comments template
│
├── single-project.php                # Single Project custom post type template
├── archive-project.php               # Projects archive template
│
├── single-case-study.php             # Single Case Study custom post type template
├── archive-case-study.php            # Case Studies archive template
│
├── taxonomy-technology.php           # Taxonomy template for Technology tags
├── taxonomy-project-category.php     # Taxonomy template for Project Categories
│
├── page-templates/                   # Custom Page Templates (select in WP Admin)
│   ├── full-width.php                # Full-width containerless layout
│   ├── contact.php                   # Contact page with inquiry form
│   └── about.php                     # In-depth About & Bio page
│
├── template-parts/                   # Modular UI Components
│   │
│   ├── global/                       # Reusable global site components
│   │   ├── site-header.php           # Sticky glassmorphism header & navigation
│   │   ├── site-footer.php           # Multi-column footer & copyright
│   │   ├── breadcrumbs.php           # Accessible breadcrumb trail
│   │   └── social-links.php          # Social profile icons & links
│   │
│   ├── home/                         # Modular sections for front-page.php
│   │   ├── hero.php                  # Interactive hero section
│   │   ├── about.php                 # Summary introduction & highlights
│   │   ├── expertise.php             # Core competencies & skill matrix
│   │   ├── featured-projects.php     # Handpicked featured project showcases
│   │   ├── case-studies.php          # Deep-dive case studies preview
│   │   ├── latest-posts.php          # Recent articles & insights
│   │   ├── community.php             # Open-source, talks, & community
│   │   └── contact-cta.php           # High-impact contact & hire CTA
│   │
│   ├── blog/                         # Blog listing & post modules
│   │   ├── post-card.php             # Article card grid item
│   │   ├── post-content.php          # Article body wrapper
│   │   ├── post-meta.php             # Author, date, reading time, tags
│   │   └── related-posts.php         # Related articles query
│   │
│   ├── projects/                     # Portfolio project components
│   │   ├── project-card.php          # Portfolio card with live/repo links
│   │   ├── project-hero.php          # Single project header banner
│   │   ├── project-details.php       # Tech stack, timeline, client info
│   │   └── project-navigation.php    # Next/previous project pagination
│   │
│   └── case-studies/                 # In-depth case study components
│       ├── case-study-card.php       # Case study card with metric badges
│       ├── challenge.php             # Problem statement & context
│       ├── solution.php              # Technical architecture & approach
│       ├── results.php               # Quantifiable impact & metrics
│       └── technologies.php          # Deep tech breakdown
│
├── inc/                              # Backend Theme Engine & Functionality
│   ├── setup.php                     # Theme supports, menus, thumbnail sizes
│   ├── enqueue.php                   # Script and stylesheet enqueuing
│   ├── helpers.php                   # Utility functions & sanitization helpers
│   ├── security.php                  # WP hardening, header protections
│   ├── performance.php               # Clean head, remove bloat, SVG support
│   ├── schema.php                    # JSON-LD structured data for SEO
│   │
│   ├── post-types/                   # Custom Post Type Registrations
│   │   ├── projects.php              # 'project' post type
│   │   └── case-studies.php          # 'case-study' post type
│   │
│   ├── taxonomies/                   # Custom Taxonomies
│   │   ├── technologies.php          # 'technology' taxonomy (hierarchical/tag)
│   │   └── project-categories.php    # 'project-category' taxonomy
│   │
│   └── admin/                        # WP Admin Customizations
│       ├── theme-options.php         # Customizer or theme settings
│       └── custom-columns.php        # Custom admin columns for CPTs
│
├── assets/                           # Front-End Assets & Sources
│   │
│   ├── scss/                         # Modular Sass (7-1 Pattern)
│   │   ├── abstracts/
│   │   │   ├── _variables.scss       # Color tokens, fonts, spacing, shadows
│   │   │   ├── _mixins.scss          # Flex, grid, transitions, glassmorphism
│   │   │   └── _breakpoints.scss     # Responsive media query mixins
│   │   │
│   │   ├── base/
│   │   │   ├── _reset.scss           # Modern CSS reset & box-sizing
│   │   │   ├── _typography.scss      # Heading scales & text styling
│   │   │   └── _global.scss          # Root variables, body, utility classes
│   │   │
│   │   ├── components/
│   │   │   ├── _buttons.scss         # Primary, secondary, glow, ghost buttons
│   │   │   ├── _cards.scss           # Glass cards, interactive hover states
│   │   │   ├── _badges.scss          # Tech badges, metric pills, status tags
│   │   │   └── _forms.scss           # Inputs, textareas, search, submit buttons
│   │   │
│   │   ├── layout/
│   │   │   ├── _header.scss          # Navbar, mobile toggle, sticky state
│   │   │   ├── _footer.scss          # Footer grid, widgets, copyright
│   │   │   ├── _navigation.scss      # Nav menus, dropdowns, mobile drawer
│   │   │   └── _container.scss       # Layout widths (1200px / 1400px), grids
│   │   │
│   │   ├── pages/
│   │   │   ├── _home.scss            # Homepage section styling
│   │   │   ├── _blog.scss            # Blog index and single article styling
│   │   │   ├── _project.scss         # Projects archive & single layout
│   │   │   └── _case-study.scss      # Case studies layout & metric displays
│   │   │
│   │   └── main.scss                 # Master SCSS orchestrator
│   │
│   ├── css/
│   │   └── main.min.css              # Compiled production stylesheet
│   │
│   ├── js/
│   │   ├── main.js                   # Main application logic & init
│   │   ├── navigation.js             # Mobile nav drawer, sticky scroll logic
│   │   └── animations.js             # Micro-animations, reveal triggers
│   │
│   ├── images/
│   │   └── placeholder.svg           # Scalable vector placeholder graphic
│   │
│   └── fonts/                        # Self-hosted typography (optional)
│
└── languages/
    └── .gitkeep                      # Localization / translation files (.po/.mo)
```

---

## 🚀 Implementation Phases

### Phase 1: Foundation & Homepage (Current Focus)
- Bootstrap files: `style.css`, `functions.php`, `theme.json`, `index.php`, `header.php`, `footer.php`, `front-page.php`.
- Core engine: `inc/setup.php`, `inc/enqueue.php`, `inc/helpers.php`.
- Global parts: `template-parts/global/site-header.php`, `site-footer.php`, `social-links.php`.
- Home parts: `template-parts/home/hero.php`, `about.php`, `expertise.php`, `featured-projects.php`, `case-studies.php`, `latest-posts.php`, `community.php`, `contact-cta.php`.
- Complete SCSS 7-1 architecture & compiled `main.min.css`.
- Core JavaScript: `main.js`, `navigation.js`, `animations.js`.
- Official theme `screenshot.png` preview.

### Phase 2: Homepage Design Customization
- Incorporate custom design sample provided by the user.
- Polish hero animations, typography, project cards, and metric highlights.

### Phase 3: Custom Post Types & Taxonomies
- Register `projects` & `case-studies` custom post types in `inc/post-types/`.
- Register `technologies` & `project-categories` taxonomies in `inc/taxonomies/`.
- Admin columns and metadata fields.

### Phase 4: Inner Templates & Polish
- Single & Archive templates: `single-project.php`, `archive-project.php`, `single-case-study.php`, `archive-case-study.php`.
- Blog & standard templates: `home.php`, `single.php`, `page.php`, `search.php`, `404.php`.
- Page templates: `page-templates/contact.php`, `page-templates/about.php`, `page-templates/full-width.php`.
