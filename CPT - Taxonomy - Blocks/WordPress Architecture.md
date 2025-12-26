# Nest N Thrive — WordPress Architecture Specification

This document defines the complete WordPress architecture for the Nest N Thrive site.

Constraints:
- Fully custom WordPress build
- No Elementor
- No ACF Pro
- Custom theme
- Custom plugin
- Gutenberg-first
- Built with Cursor

---

## 1. Architecture Principles

- Custom Post Types (CPTs) represent primary content entities with dedicated templates
- Taxonomies provide classification, filtering, and relationships
- Custom Gutenberg blocks replace ACF Pro repeaters and flexible content
- Relationships are query-driven first, manually curated second
- Editorial clarity and scalability are prioritized over over-engineering

---

## 2. Custom Post Types (CPTs)

### A) Rooms  
**Slug:** `nnt_room`  
**Purpose:** Editorial room hub pages (e.g. Home Office, Bedroom, Kitchen)

**Fields:**
- hero_title (string)
- hero_subtitle (textarea)
- hero_supporting_line (string)
- featured_collections (array of post IDs → nnt_collection)
- featured_guides (array of post IDs → nnt_guide)
- featured_goals (array of term IDs → goal taxonomy)

**Template Behavior:**
- Query all guides tagged with this room taxonomy
- Query all collections tagged with this room taxonomy
- Display curated featured sections first, then full listings

---

### B) Goals  
**Slug:** `nnt_goal`  
**Purpose:** Intent-based hub pages (e.g. Organization & Storage, Lighting & Ambience)

**Fields:**
- hero_subtitle (textarea)
- hero_supporting_line (string)
- featured_collections (array of post IDs → nnt_collection)
- featured_guides (array of post IDs → nnt_guide)
- featured_rooms (array of term IDs → room taxonomy)

**Template Behavior:**
- Query all guides tagged with this goal taxonomy
- Query all collections tagged with this goal taxonomy
- Display curated featured sections first, then full listings

---

### C) Guides  
**Slug:** `nnt_guide`  
**Purpose:** Educational, evergreen how-to content

**Fields:**
- guide_kicker (string)
- hero_summary (textarea)
- reading_time (integer or string)
- updated_date_override (date)
- email_cta_toggle (boolean)
- related_content_manual (array of post IDs)

**Content Structure:**
- Gutenberg blocks only
- No repeaters in meta fields

---

### D) Collections  
**Slug:** `nnt_collection`  
**Purpose:** Monetization pages (“Best X for Y”)

**Fields:**
- collection_kicker (string)
- intro_summary (textarea)
- updated_date_override (date)
- affiliate_disclosure_style (enum: inline | block)
- related_content_manual (array of post IDs)

**Content Structure:**
- Gutenberg blocks only
- No Product CPT at MVP

---

## 3. Taxonomies

### Room Taxonomy  
**Slug:** `nnt_room_tax`

### Goal Taxonomy  
**Slug:** `nnt_goal_tax`

**Attached To:**
- nnt_guide
- nnt_collection

**Usage:**
- Classification
- Filtering
- Queries
- SEO indexing
- Breadcrumbs

Rooms and Goals exist as both:
- CPTs (for hub pages)
- Taxonomies (for tagging and filtering)

---

## 4. Custom Gutenberg Blocks

### Shared Blocks
- `nnt/takeaways`
- `nnt/step`
- `nnt/tool-callout`
- `nnt/common-mistakes`
- `nnt/faq`

### Collection-Specific Blocks
- `nnt/quick-picks`
- `nnt/product-pick`
- `nnt/comparison-table`

All blocks must:
- Store structured data
- Be reusable
- Be editor-friendly
- Replace ACF Pro repeater functionality

---

## 5. Pages

### Home
- Standard WordPress page
- Custom page template
- Dynamically queries Rooms, Goals, Guides, and Collections

### About
- Standard WordPress page
- Custom template
- Static editorial content

### Contact
- Standard WordPress page
- Custom template
- Simple contact form (name, email, message)

---

## 6. Plugin / Theme Responsibilities

### Plugin: `nnt-core`
- Register CPTs
- Register taxonomies
- Register post meta
- Register Gutenberg blocks
- Expose data to REST API
- Add admin UI helpers where necessary

### Theme: `nestnthrive`
- All templates (single + archive)
- Layout components
- Styling and animations
- Query logic and loops
- Navigation and breadcrumbs

---

## 7. Product Handling (MVP Decision)

- No Product CPT at MVP
- Products are handled via:
  - `nnt/product-pick` blocks
  - Affiliate URLs stored at block level
- Product CPT may be added post-launch if reuse patterns emerge

---

## 8. Implementation Order

1. Create `nnt-core` plugin scaffold
2. Register CPTs and taxonomies
3. Register meta fields
4. Register Gutenberg blocks
5. Create `nestnthrive` theme scaffold
6. Build templates for:
   - Home
   - Room Hub
   - Goal Hub
   - Collection
   - Guide
   - About
   - Contact

---

## 9. Locked Decisions

- Rooms and Goals implemented as BOTH CPTs and taxonomies
- Product CPT deferred until after MVP launch
- Gutenberg blocks replace ACF Pro repeaters
- Fully custom theme and plugin architecture
