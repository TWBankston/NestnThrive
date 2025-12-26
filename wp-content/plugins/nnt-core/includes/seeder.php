<?php
/**
 * NNT Core Site Seeder
 *
 * Creates initial content entries for Nest N Thrive.
 * Idempotent - safe to run multiple times.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Seeder Class.
 */
class NNT_Site_Seeder {

    /**
     * Results tracking.
     *
     * @var array
     */
    private $results = array(
        'pages'       => array( 'created' => 0, 'updated' => 0 ),
        'rooms'       => array( 'created' => 0, 'updated' => 0 ),
        'goals'       => array( 'created' => 0, 'updated' => 0 ),
        'guides'      => array( 'created' => 0, 'updated' => 0 ),
        'collections' => array( 'created' => 0, 'updated' => 0 ),
        'terms'       => array( 'created' => 0, 'updated' => 0 ),
        'menu'        => array( 'created' => 0, 'updated' => 0 ),
    );

    /**
     * Room definitions.
     *
     * @var array
     */
    private $rooms = array(
        'bedroom' => array(
            'title'           => 'Bedroom',
            'hero_title'      => 'Create Your Perfect Bedroom Sanctuary',
            'hero_subtitle'   => 'Transform your bedroom into a restful retreat with thoughtfully chosen furniture, bedding, and organization solutions.',
            'supporting_line' => 'Better sleep starts with better design.',
        ),
        'living-room' => array(
            'title'           => 'Living Room',
            'hero_title'      => 'Living Room Essentials for Everyday Comfort',
            'hero_subtitle'   => 'Curated furniture and decor that make your living room both beautiful and functional.',
            'supporting_line' => 'Where comfort meets style.',
        ),
        'bathroom' => array(
            'title'           => 'Bathroom',
            'hero_title'      => 'Bathroom Organization & Upgrades',
            'hero_subtitle'   => 'Simple solutions for a cleaner, calmer bathroom space.',
            'supporting_line' => 'Start and end your day right.',
        ),
        'kitchen' => array(
            'title'           => 'Kitchen',
            'hero_title'      => 'Kitchen Essentials That Work',
            'hero_subtitle'   => 'Practical tools and organization systems for a more efficient kitchen.',
            'supporting_line' => 'The heart of the home, optimized.',
        ),
        'pantry' => array(
            'title'           => 'Pantry',
            'hero_title'      => 'Pantry Organization Made Simple',
            'hero_subtitle'   => 'Storage solutions and containers that keep your pantry tidy and accessible.',
            'supporting_line' => 'Everything in its place.',
        ),
        'closet' => array(
            'title'           => 'Closet',
            'hero_title'      => 'Closet Systems & Organization',
            'hero_subtitle'   => 'Maximize your closet space with smart storage and organization solutions.',
            'supporting_line' => 'Less clutter, more clarity.',
        ),
        'home-office' => array(
            'title'           => 'Home Office',
            'hero_title'      => 'Build Your Ideal Home Office',
            'hero_subtitle'   => 'Ergonomic furniture, lighting, and accessories for productive work-from-home days.',
            'supporting_line' => 'Work better from home.',
        ),
        'garage' => array(
            'title'           => 'Garage',
            'hero_title'      => 'Garage Organization & Storage',
            'hero_subtitle'   => 'Heavy-duty storage solutions to tame the chaos and reclaim your garage space.',
            'supporting_line' => 'Your garage, transformed.',
        ),
        'outdoor-living' => array(
            'title'           => 'Outdoor Living',
            'hero_title'      => 'Outdoor Living Spaces',
            'hero_subtitle'   => 'Furniture, lighting, and accessories for patios, decks, and outdoor entertaining.',
            'supporting_line' => 'Extend your living space outside.',
        ),
    );

    /**
     * Goal definitions.
     *
     * @var array
     */
    private $goals = array(
        'organization-storage' => array(
            'title'           => 'Organization & Storage',
            'hero_title'      => 'Organization & Storage Solutions',
            'hero_subtitle'   => 'Declutter and organize every room with smart storage systems and containers.',
            'supporting_line' => 'A place for everything.',
        ),
        'cleaning-maintenance' => array(
            'title'           => 'Cleaning & Maintenance',
            'hero_title'      => 'Cleaning & Maintenance Made Easy',
            'hero_subtitle'   => 'Tools and products that make keeping your home clean less of a chore.',
            'supporting_line' => 'Less effort, better results.',
        ),
        'lighting-ambience' => array(
            'title'           => 'Lighting & Ambience',
            'hero_title'      => 'Lighting That Transforms Your Space',
            'hero_subtitle'   => 'From task lighting to ambient glow, find the right light for every moment.',
            'supporting_line' => 'Set the mood, any time.',
        ),
        'small-space-solutions' => array(
            'title'           => 'Small Space Solutions',
            'hero_title'      => 'Make the Most of Small Spaces',
            'hero_subtitle'   => 'Clever furniture and storage for apartments, studios, and compact rooms.',
            'supporting_line' => 'Small space, big potential.',
        ),
        'work-from-home-setup' => array(
            'title'           => 'Work From Home Setup',
            'hero_title'      => 'Work From Home Essentials',
            'hero_subtitle'   => 'Everything you need to create a productive and comfortable home workspace.',
            'supporting_line' => 'Your best work, from home.',
        ),
        'outdoor-living-essentials' => array(
            'title'           => 'Outdoor Living Essentials',
            'hero_title'      => 'Essentials for Outdoor Living',
            'hero_subtitle'   => 'Furniture, decor, and tools to make your outdoor space an extension of your home.',
            'supporting_line' => 'Live outside.',
        ),
        'smart-home-basics' => array(
            'title'           => 'Smart Home Basics',
            'hero_title'      => 'Smart Home for Beginners',
            'hero_subtitle'   => 'Simple, practical smart home devices that actually make life easier.',
            'supporting_line' => 'Smart without the complexity.',
        ),
    );

    /**
     * Guide definitions.
     *
     * @var array
     */
    private $guides = array(
        'ergonomic-desk-setup' => array(
            'title'      => 'Ergonomic Desk Setup: The Complete Guide',
            'kicker'     => 'Workspace Wellness',
            'summary'    => 'Learn how to set up an ergonomic desk that prevents pain and boosts productivity.',
            'rooms'      => array( 'home-office' ),
            'goals'      => array( 'work-from-home-setup' ),
        ),
        'pantry-organization-basics' => array(
            'title'      => 'Pantry Organization Basics: A Step-by-Step Guide',
            'kicker'     => 'Kitchen Organization',
            'summary'    => 'Transform your pantry from chaotic to calm with these organization fundamentals.',
            'rooms'      => array( 'pantry', 'kitchen' ),
            'goals'      => array( 'organization-storage' ),
        ),
        'reduce-visual-clutter' => array(
            'title'      => 'How to Reduce Visual Clutter in Any Room',
            'kicker'     => 'Calm Spaces',
            'summary'    => 'Simple strategies to create a more peaceful, visually calm living environment.',
            'rooms'      => array( 'living-room', 'bedroom' ),
            'goals'      => array( 'organization-storage', 'small-space-solutions' ),
        ),
        'bedroom-upgrades-for-sleep' => array(
            'title'      => 'Bedroom Upgrades That Actually Improve Sleep',
            'kicker'     => 'Better Sleep',
            'summary'    => 'Evidence-based bedroom improvements for deeper, more restful sleep.',
            'rooms'      => array( 'bedroom' ),
            'goals'      => array( 'lighting-ambience' ),
        ),
        'cable-management-clean-desk' => array(
            'title'      => 'Cable Management for a Clean Desk Setup',
            'kicker'     => 'Desk Organization',
            'summary'    => 'Tame the cable chaos under and around your desk with these proven solutions.',
            'rooms'      => array( 'home-office' ),
            'goals'      => array( 'organization-storage', 'work-from-home-setup' ),
        ),
        'choose-office-chair-long-workdays' => array(
            'title'      => 'How to Choose an Office Chair for Long Workdays',
            'kicker'     => 'Buying Guide',
            'summary'    => 'What to look for in an ergonomic office chair when you sit for 8+ hours.',
            'rooms'      => array( 'home-office' ),
            'goals'      => array( 'work-from-home-setup' ),
        ),
        'lighting-that-feels-expensive' => array(
            'title'      => 'Lighting That Makes Any Room Feel More Expensive',
            'kicker'     => 'Lighting Design',
            'summary'    => 'Budget-friendly lighting upgrades that elevate your space instantly.',
            'rooms'      => array( 'living-room', 'bedroom' ),
            'goals'      => array( 'lighting-ambience' ),
        ),
        'small-space-storage-strategy' => array(
            'title'      => 'Small Space Storage: A Complete Strategy',
            'kicker'     => 'Small Spaces',
            'summary'    => 'Maximize storage in apartments and compact homes without sacrificing style.',
            'rooms'      => array( 'closet', 'bedroom' ),
            'goals'      => array( 'small-space-solutions', 'organization-storage' ),
        ),
        'bathroom-organization-essentials' => array(
            'title'      => 'Bathroom Organization Essentials',
            'kicker'     => 'Bathroom Tips',
            'summary'    => 'Create a clutter-free bathroom with these organization must-haves.',
            'rooms'      => array( 'bathroom' ),
            'goals'      => array( 'organization-storage', 'cleaning-maintenance' ),
        ),
        'moving-room-reset-checklist' => array(
            'title'      => 'The Ultimate Moving & Room Reset Checklist',
            'kicker'     => 'Fresh Start',
            'summary'    => 'Everything you need to set up or reset a room from scratch.',
            'rooms'      => array( 'bedroom', 'living-room', 'home-office' ),
            'goals'      => array( 'organization-storage' ),
        ),
    );

    /**
     * Collection definitions.
     *
     * @var array
     */
    private $collections = array(
        'best-standing-desks-small-spaces' => array(
            'title'        => 'Best Standing Desks for Small Spaces',
            'kicker'       => 'Top Picks 2025',
            'intro'        => 'Compact standing desks that fit in tight spaces without sacrificing functionality.',
            'rooms'        => array( 'home-office' ),
            'goals'        => array( 'work-from-home-setup', 'small-space-solutions' ),
        ),
        'best-office-chairs-long-workdays' => array(
            'title'        => 'Best Office Chairs for Long Workdays',
            'kicker'       => 'Ergonomic Picks',
            'intro'        => 'Tested and reviewed chairs that keep you comfortable during marathon work sessions.',
            'rooms'        => array( 'home-office' ),
            'goals'        => array( 'work-from-home-setup' ),
        ),
        'best-cable-management-products' => array(
            'title'        => 'Best Cable Management Products',
            'kicker'       => 'Desk Essentials',
            'intro'        => 'The best cable trays, clips, and sleeves to eliminate desk clutter.',
            'rooms'        => array( 'home-office' ),
            'goals'        => array( 'organization-storage', 'work-from-home-setup' ),
        ),
        'best-pantry-organization-systems' => array(
            'title'        => 'Best Pantry Organization Systems',
            'kicker'       => 'Kitchen Organization',
            'intro'        => 'Containers, racks, and bins that transform chaotic pantries.',
            'rooms'        => array( 'pantry', 'kitchen' ),
            'goals'        => array( 'organization-storage' ),
        ),
        'best-bedroom-upgrades-sleep' => array(
            'title'        => 'Best Bedroom Upgrades for Better Sleep',
            'kicker'       => 'Sleep Better',
            'intro'        => 'Pillows, bedding, and accessories proven to improve sleep quality.',
            'rooms'        => array( 'bedroom' ),
            'goals'        => array( 'lighting-ambience' ),
        ),
        'best-lighting-small-rooms' => array(
            'title'        => 'Best Lighting for Small Rooms',
            'kicker'       => 'Lighting Guide',
            'intro'        => 'Lamps and fixtures that brighten compact spaces without overwhelming them.',
            'rooms'        => array( 'living-room', 'bedroom' ),
            'goals'        => array( 'lighting-ambience', 'small-space-solutions' ),
        ),
        'best-closet-organization-essentials' => array(
            'title'        => 'Best Closet Organization Essentials',
            'kicker'       => 'Closet Picks',
            'intro'        => 'Hangers, dividers, and storage solutions for a perfectly organized closet.',
            'rooms'        => array( 'closet', 'bedroom' ),
            'goals'        => array( 'organization-storage' ),
        ),
        'best-work-from-home-setup-starters' => array(
            'title'        => 'Best Work From Home Setup Starters',
            'kicker'       => 'Starter Kit',
            'intro'        => 'Essential gear to build a productive home office from scratch.',
            'rooms'        => array( 'home-office' ),
            'goals'        => array( 'work-from-home-setup' ),
        ),
    );

    /**
     * Page definitions.
     *
     * @var array
     */
    private $pages = array(
        'home' => array(
            'title'   => 'Home',
            'content' => '',
            'status'  => 'publish',
        ),
        'about' => array(
            'title'   => 'About',
            'content' => '',
            'status'  => 'publish',
            'template' => 'page-about.php',
        ),
        'contact' => array(
            'title'   => 'Contact',
            'content' => '',
            'status'  => 'publish',
            'template' => 'page-contact.php',
        ),
        'privacy-policy' => array(
            'title'   => 'Privacy Policy',
            'content' => '<!-- wp:paragraph --><p>Privacy Policy content coming soon.</p><!-- /wp:paragraph -->',
            'status'  => 'draft',
        ),
        'affiliate-disclosure' => array(
            'title'   => 'Affiliate Disclosure',
            'content' => '<!-- wp:paragraph --><p>As an Amazon Associate, we may earn from qualifying purchases. This supports our work at no extra cost to you.</p><!-- /wp:paragraph -->',
            'status'  => 'draft',
        ),
        'terms-of-service' => array(
            'title'   => 'Terms of Service',
            'content' => '<!-- wp:paragraph --><p>Terms of Service content coming soon.</p><!-- /wp:paragraph -->',
            'status'  => 'draft',
        ),
    );

    /**
     * Run the seeder.
     *
     * @return array Results summary.
     */
    public function run() {
        $this->seed_pages();
        $this->seed_rooms();
        $this->seed_goals();
        $this->seed_guides();
        $this->seed_collections();
        $this->seed_featured_content();
        $this->seed_navigation_menu();
        $this->set_homepage();

        return $this->results;
    }

    /**
     * Seed pages.
     */
    private function seed_pages() {
        foreach ( $this->pages as $slug => $data ) {
            $existing = get_page_by_path( $slug );

            $post_data = array(
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => $data['status'],
                'post_type'    => 'page',
            );

            if ( $existing ) {
                $post_data['ID'] = $existing->ID;
                wp_update_post( $post_data );
                $this->results['pages']['updated']++;
                $post_id = $existing->ID;
            } else {
                $post_id = wp_insert_post( $post_data );
                $this->results['pages']['created']++;
            }

            // Set page template if specified.
            if ( $post_id && ! empty( $data['template'] ) ) {
                update_post_meta( $post_id, '_wp_page_template', $data['template'] );
            }
        }
    }

    /**
     * Seed rooms.
     */
    private function seed_rooms() {
        foreach ( $this->rooms as $slug => $data ) {
            // Create/update room post.
            $post_id = $this->create_or_update_post( array(
                'slug'       => $slug,
                'title'      => $data['title'],
                'post_type'  => 'nnt_room',
                'status'     => 'publish',
            ) );

            if ( $post_id ) {
                // Set meta.
                update_post_meta( $post_id, 'nnt_hero_title', $data['hero_title'] );
                update_post_meta( $post_id, 'nnt_hero_subtitle', $data['hero_subtitle'] );
                update_post_meta( $post_id, 'nnt_hero_supporting_line', $data['supporting_line'] );

                // Initialize empty featured arrays.
                if ( ! get_post_meta( $post_id, 'nnt_featured_collections', true ) ) {
                    update_post_meta( $post_id, 'nnt_featured_collections', array() );
                }
                if ( ! get_post_meta( $post_id, 'nnt_featured_guides', true ) ) {
                    update_post_meta( $post_id, 'nnt_featured_guides', array() );
                }
                if ( ! get_post_meta( $post_id, 'nnt_featured_goals', true ) ) {
                    update_post_meta( $post_id, 'nnt_featured_goals', array() );
                }

                // Create/update matching taxonomy term.
                $this->create_or_update_term( $data['title'], $slug, 'nnt_room_tax' );
            }
        }
    }

    /**
     * Seed goals.
     */
    private function seed_goals() {
        foreach ( $this->goals as $slug => $data ) {
            // Create/update goal post.
            $post_id = $this->create_or_update_post( array(
                'slug'       => $slug,
                'title'      => $data['title'],
                'post_type'  => 'nnt_goal',
                'status'     => 'publish',
            ) );

            if ( $post_id ) {
                // Set meta.
                update_post_meta( $post_id, 'nnt_hero_title', $data['hero_title'] );
                update_post_meta( $post_id, 'nnt_hero_subtitle', $data['hero_subtitle'] );
                update_post_meta( $post_id, 'nnt_hero_supporting_line', $data['supporting_line'] );

                // Initialize empty featured arrays.
                if ( ! get_post_meta( $post_id, 'nnt_featured_collections', true ) ) {
                    update_post_meta( $post_id, 'nnt_featured_collections', array() );
                }
                if ( ! get_post_meta( $post_id, 'nnt_featured_guides', true ) ) {
                    update_post_meta( $post_id, 'nnt_featured_guides', array() );
                }
                if ( ! get_post_meta( $post_id, 'nnt_featured_rooms', true ) ) {
                    update_post_meta( $post_id, 'nnt_featured_rooms', array() );
                }

                // Create/update matching taxonomy term.
                $this->create_or_update_term( $data['title'], $slug, 'nnt_goal_tax' );
            }
        }
    }

    /**
     * Seed guides.
     */
    private function seed_guides() {
        foreach ( $this->guides as $slug => $data ) {
            // Generate minimal Gutenberg content.
            $content = $this->generate_guide_content( $data );

            // Create/update guide post.
            $post_id = $this->create_or_update_post( array(
                'slug'       => $slug,
                'title'      => $data['title'],
                'post_type'  => 'nnt_guide',
                'status'     => 'draft',
                'content'    => $content,
            ) );

            if ( $post_id ) {
                // Set meta.
                update_post_meta( $post_id, 'nnt_guide_kicker', $data['kicker'] );
                update_post_meta( $post_id, 'nnt_hero_summary', $data['summary'] );
                update_post_meta( $post_id, 'nnt_email_cta_toggle', true );

                // Assign taxonomy terms.
                $room_term_ids = $this->get_term_ids_by_slugs( $data['rooms'], 'nnt_room_tax' );
                $goal_term_ids = $this->get_term_ids_by_slugs( $data['goals'], 'nnt_goal_tax' );

                wp_set_object_terms( $post_id, $room_term_ids, 'nnt_room_tax' );
                wp_set_object_terms( $post_id, $goal_term_ids, 'nnt_goal_tax' );
            }
        }
    }

    /**
     * Seed collections.
     */
    private function seed_collections() {
        foreach ( $this->collections as $slug => $data ) {
            // Generate minimal Gutenberg content.
            $content = $this->generate_collection_content( $data );

            // Create/update collection post.
            $post_id = $this->create_or_update_post( array(
                'slug'       => $slug,
                'title'      => $data['title'],
                'post_type'  => 'nnt_collection',
                'status'     => 'draft',
                'content'    => $content,
            ) );

            if ( $post_id ) {
                // Set meta.
                update_post_meta( $post_id, 'nnt_collection_kicker', $data['kicker'] );
                update_post_meta( $post_id, 'nnt_intro_summary', $data['intro'] );
                update_post_meta( $post_id, 'nnt_affiliate_disclosure_style', 'block' );

                // Assign taxonomy terms.
                $room_term_ids = $this->get_term_ids_by_slugs( $data['rooms'], 'nnt_room_tax' );
                $goal_term_ids = $this->get_term_ids_by_slugs( $data['goals'], 'nnt_goal_tax' );

                wp_set_object_terms( $post_id, $room_term_ids, 'nnt_room_tax' );
                wp_set_object_terms( $post_id, $goal_term_ids, 'nnt_goal_tax' );
            }
        }
    }

    /**
     * Seed featured content on hubs.
     */
    private function seed_featured_content() {
        // Get all guides and collections.
        $guides = get_posts( array(
            'post_type'      => 'nnt_guide',
            'posts_per_page' => -1,
            'post_status'    => 'any',
        ) );

        $collections = get_posts( array(
            'post_type'      => 'nnt_collection',
            'posts_per_page' => -1,
            'post_status'    => 'any',
        ) );

        // Seed featured content for rooms.
        foreach ( $this->rooms as $slug => $data ) {
            $room_post = get_page_by_path( $slug, OBJECT, 'nnt_room' );
            if ( ! $room_post ) {
                continue;
            }

            $room_term = get_term_by( 'slug', $slug, 'nnt_room_tax' );
            if ( ! $room_term ) {
                continue;
            }

            // Find related guides (up to 3).
            $related_guides = array();
            foreach ( $guides as $guide ) {
                $terms = wp_get_object_terms( $guide->ID, 'nnt_room_tax', array( 'fields' => 'slugs' ) );
                if ( in_array( $slug, $terms, true ) ) {
                    $related_guides[] = $guide->ID;
                }
                if ( count( $related_guides ) >= 3 ) {
                    break;
                }
            }

            // Find related collections (up to 3).
            $related_collections = array();
            foreach ( $collections as $collection ) {
                $terms = wp_get_object_terms( $collection->ID, 'nnt_room_tax', array( 'fields' => 'slugs' ) );
                if ( in_array( $slug, $terms, true ) ) {
                    $related_collections[] = $collection->ID;
                }
                if ( count( $related_collections ) >= 3 ) {
                    break;
                }
            }

            // Get first 3 goal term IDs.
            $goal_terms = get_terms( array(
                'taxonomy'   => 'nnt_goal_tax',
                'number'     => 3,
                'hide_empty' => false,
            ) );
            $goal_term_ids = wp_list_pluck( $goal_terms, 'term_id' );

            // Update meta.
            update_post_meta( $room_post->ID, 'nnt_featured_guides', $related_guides );
            update_post_meta( $room_post->ID, 'nnt_featured_collections', $related_collections );
            update_post_meta( $room_post->ID, 'nnt_featured_goals', $goal_term_ids );
        }

        // Seed featured content for goals.
        foreach ( $this->goals as $slug => $data ) {
            $goal_post = get_page_by_path( $slug, OBJECT, 'nnt_goal' );
            if ( ! $goal_post ) {
                continue;
            }

            $goal_term = get_term_by( 'slug', $slug, 'nnt_goal_tax' );
            if ( ! $goal_term ) {
                continue;
            }

            // Find related guides (up to 3).
            $related_guides = array();
            foreach ( $guides as $guide ) {
                $terms = wp_get_object_terms( $guide->ID, 'nnt_goal_tax', array( 'fields' => 'slugs' ) );
                if ( in_array( $slug, $terms, true ) ) {
                    $related_guides[] = $guide->ID;
                }
                if ( count( $related_guides ) >= 3 ) {
                    break;
                }
            }

            // Find related collections (up to 3).
            $related_collections = array();
            foreach ( $collections as $collection ) {
                $terms = wp_get_object_terms( $collection->ID, 'nnt_goal_tax', array( 'fields' => 'slugs' ) );
                if ( in_array( $slug, $terms, true ) ) {
                    $related_collections[] = $collection->ID;
                }
                if ( count( $related_collections ) >= 3 ) {
                    break;
                }
            }

            // Get first 4 room term IDs.
            $room_terms = get_terms( array(
                'taxonomy'   => 'nnt_room_tax',
                'number'     => 4,
                'hide_empty' => false,
            ) );
            $room_term_ids = wp_list_pluck( $room_terms, 'term_id' );

            // Update meta.
            update_post_meta( $goal_post->ID, 'nnt_featured_guides', $related_guides );
            update_post_meta( $goal_post->ID, 'nnt_featured_collections', $related_collections );
            update_post_meta( $goal_post->ID, 'nnt_featured_rooms', $room_term_ids );
        }
    }

    /**
     * Seed navigation menu.
     */
    private function seed_navigation_menu() {
        $menu_name     = 'Primary';
        $menu_location = 'primary';

        // Check if menu exists.
        $menu = wp_get_nav_menu_object( $menu_name );

        if ( ! $menu ) {
            $menu_id = wp_create_nav_menu( $menu_name );
            $this->results['menu']['created']++;
        } else {
            $menu_id = $menu->term_id;
            // Clear existing items.
            $menu_items = wp_get_nav_menu_items( $menu_id );
            foreach ( $menu_items as $item ) {
                wp_delete_post( $item->ID, true );
            }
            $this->results['menu']['updated']++;
        }

        // Get page IDs.
        $home_page    = get_page_by_path( 'home' );
        $about_page   = get_page_by_path( 'about' );
        $contact_page = get_page_by_path( 'contact' );

        // Get first room and goal for links.
        $bedroom_room = get_page_by_path( 'bedroom', OBJECT, 'nnt_room' );
        $org_goal     = get_page_by_path( 'organization-storage', OBJECT, 'nnt_goal' );

        // Add menu items.
        $order = 1;

        // Home.
        if ( $home_page ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Home',
                'menu-item-object-id' => $home_page->ID,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $order++,
            ) );
        }

        // Shop by Room (links to Bedroom).
        if ( $bedroom_room ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Shop by Room',
                'menu-item-object-id' => $bedroom_room->ID,
                'menu-item-object'    => 'nnt_room',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $order++,
            ) );
        }

        // Shop by Goal (links to Organization & Storage).
        if ( $org_goal ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Shop by Goal',
                'menu-item-object-id' => $org_goal->ID,
                'menu-item-object'    => 'nnt_goal',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $order++,
            ) );
        }

        // Guides (archive link).
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'    => 'Guides',
            'menu-item-url'      => home_url( '/guides/' ),
            'menu-item-type'     => 'custom',
            'menu-item-status'   => 'publish',
            'menu-item-position' => $order++,
        ) );

        // About.
        if ( $about_page ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'About',
                'menu-item-object-id' => $about_page->ID,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $order++,
            ) );
        }

        // Contact (keeping it out of main nav, in footer instead).
        // Uncomment below to add to main nav:
        // if ( $contact_page ) {
        //     wp_update_nav_menu_item( $menu_id, 0, array(
        //         'menu-item-title'     => 'Contact',
        //         'menu-item-object-id' => $contact_page->ID,
        //         'menu-item-object'    => 'page',
        //         'menu-item-type'      => 'post_type',
        //         'menu-item-status'    => 'publish',
        //         'menu-item-position'  => $order++,
        //     ) );
        // }

        // Assign menu to location.
        $locations                   = get_theme_mod( 'nav_menu_locations', array() );
        $locations[ $menu_location ] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    /**
     * Set homepage as static front page.
     */
    private function set_homepage() {
        $home_page = get_page_by_path( 'home' );

        if ( $home_page ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_page->ID );
            update_option( 'page_for_posts', 0 );
        }
    }

    /**
     * Create or update a post.
     *
     * @param array $args Post arguments.
     * @return int|false Post ID or false on failure.
     */
    private function create_or_update_post( $args ) {
        $defaults = array(
            'slug'       => '',
            'title'      => '',
            'post_type'  => 'post',
            'status'     => 'publish',
            'content'    => '',
        );

        $args = wp_parse_args( $args, $defaults );

        // Check for existing post.
        $existing = get_page_by_path( $args['slug'], OBJECT, $args['post_type'] );

        $post_data = array(
            'post_title'   => $args['title'],
            'post_name'    => $args['slug'],
            'post_content' => $args['content'],
            'post_status'  => $args['status'],
            'post_type'    => $args['post_type'],
        );

        if ( $existing ) {
            $post_data['ID'] = $existing->ID;
            wp_update_post( $post_data );
            $this->increment_result( $args['post_type'], 'updated' );
            return $existing->ID;
        }

        $post_id = wp_insert_post( $post_data );
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            $this->increment_result( $args['post_type'], 'created' );
            return $post_id;
        }

        return false;
    }

    /**
     * Create or update a taxonomy term.
     *
     * @param string $name     Term name.
     * @param string $slug     Term slug.
     * @param string $taxonomy Taxonomy name.
     * @return int|false Term ID or false.
     */
    private function create_or_update_term( $name, $slug, $taxonomy ) {
        $existing = get_term_by( 'slug', $slug, $taxonomy );

        if ( $existing ) {
            wp_update_term( $existing->term_id, $taxonomy, array(
                'name' => $name,
            ) );
            $this->results['terms']['updated']++;
            return $existing->term_id;
        }

        $result = wp_insert_term( $name, $taxonomy, array(
            'slug' => $slug,
        ) );

        if ( ! is_wp_error( $result ) ) {
            $this->results['terms']['created']++;
            return $result['term_id'];
        }

        return false;
    }

    /**
     * Get term IDs by slugs.
     *
     * @param array  $slugs    Term slugs.
     * @param string $taxonomy Taxonomy name.
     * @return array Term IDs.
     */
    private function get_term_ids_by_slugs( $slugs, $taxonomy ) {
        $term_ids = array();

        foreach ( $slugs as $slug ) {
            $term = get_term_by( 'slug', $slug, $taxonomy );
            if ( $term ) {
                $term_ids[] = $term->term_id;
            }
        }

        return $term_ids;
    }

    /**
     * Increment result counter.
     *
     * @param string $post_type Post type.
     * @param string $action    Action (created/updated).
     */
    private function increment_result( $post_type, $action ) {
        $type_map = array(
            'nnt_room'       => 'rooms',
            'nnt_goal'       => 'goals',
            'nnt_guide'      => 'guides',
            'nnt_collection' => 'collections',
        );

        $key = $type_map[ $post_type ] ?? $post_type;

        if ( isset( $this->results[ $key ][ $action ] ) ) {
            $this->results[ $key ][ $action ]++;
        }
    }

    /**
     * Generate minimal Gutenberg content for guides.
     *
     * @param array $data Guide data.
     * @return string Block content.
     */
    private function generate_guide_content( $data ) {
        $content = '';

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Introduction</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>' . esc_html( $data['summary'] ) . '</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Key Takeaways</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:list -->' . "\n";
        $content .= '<ul class="wp-block-list">' . "\n";
        $content .= '<li>First key point to remember</li>' . "\n";
        $content .= '<li>Second important consideration</li>' . "\n";
        $content .= '<li>Third actionable tip</li>' . "\n";
        $content .= '</ul>' . "\n";
        $content .= '<!-- /wp:list -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Step-by-Step Guide</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>Detailed instructions will go here when this guide is published.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Frequently Asked Questions</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>FAQ section coming soon.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n";

        return $content;
    }

    /**
     * Generate minimal Gutenberg content for collections.
     *
     * @param array $data Collection data.
     * @return string Block content.
     */
    private function generate_collection_content( $data ) {
        $content = '';

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Quick Picks</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>Our top recommendations at a glance—perfect if you\'re short on time.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">How We Chose</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>Our selection criteria and testing methodology for these products.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Comparison</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>Side-by-side comparison of features and pricing.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Detailed Picks</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>In-depth reviews of each recommended product.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">Buying Guide</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>What to consider when making your purchase decision.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n\n";

        $content .= '<!-- wp:heading -->' . "\n";
        $content .= '<h2 class="wp-block-heading">FAQs</h2>' . "\n";
        $content .= '<!-- /wp:heading -->' . "\n\n";

        $content .= '<!-- wp:paragraph -->' . "\n";
        $content .= '<p>Common questions answered.</p>' . "\n";
        $content .= '<!-- /wp:paragraph -->' . "\n";

        return $content;
    }

    /**
     * Format results for output.
     *
     * @return string Formatted results.
     */
    public function format_results() {
        $output = "=== NNT Site Seeder Results ===\n\n";

        foreach ( $this->results as $type => $counts ) {
            $output .= ucfirst( $type ) . ":\n";
            $output .= "  - Created: {$counts['created']}\n";
            $output .= "  - Updated: {$counts['updated']}\n";
        }

        $output .= "\n✅ Seeder completed successfully!";

        return $output;
    }
}

/**
 * Run the seeder via WP-CLI or admin.
 *
 * @return array Results.
 */
function nnt_run_seeder() {
    $seeder = new NNT_Site_Seeder();
    return $seeder->run();
}

/**
 * Register WP-CLI command.
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'nnt seed', function( $args, $assoc_args ) {
        WP_CLI::log( 'Running NNT Site Seeder...' );

        $seeder  = new NNT_Site_Seeder();
        $results = $seeder->run();

        WP_CLI::log( '' );
        WP_CLI::log( $seeder->format_results() );
    } );
}

/**
 * Add admin tools page.
 */
function nnt_add_seeder_admin_page() {
    add_management_page(
        __( 'NNT Site Seeder', 'nnt-core' ),
        __( 'NNT Site Seeder', 'nnt-core' ),
        'manage_options',
        'nnt-seeder',
        'nnt_render_seeder_admin_page'
    );
}
add_action( 'admin_menu', 'nnt_add_seeder_admin_page' );

/**
 * Render admin seeder page.
 */
function nnt_render_seeder_admin_page() {
    // Check permissions.
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'nnt-core' ) );
    }

    $results = null;
    $seeder  = null;

    // Handle form submission.
    if ( isset( $_POST['nnt_run_seeder'] ) && check_admin_referer( 'nnt_seeder_nonce', 'nnt_seeder_nonce_field' ) ) {
        $seeder  = new NNT_Site_Seeder();
        $results = $seeder->run();
    }

    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Nest N Thrive Site Seeder', 'nnt-core' ); ?></h1>

        <div class="card" style="max-width: 600px; padding: 20px;">
            <h2><?php esc_html_e( 'About the Seeder', 'nnt-core' ); ?></h2>
            <p><?php esc_html_e( 'This tool creates initial content for the Nest N Thrive site:', 'nnt-core' ); ?></p>
            <ul style="list-style: disc; padding-left: 20px;">
                <li><?php esc_html_e( 'Pages (Home, About, Contact, legal pages)', 'nnt-core' ); ?></li>
                <li><?php esc_html_e( 'Rooms (9 room hub posts with taxonomy terms)', 'nnt-core' ); ?></li>
                <li><?php esc_html_e( 'Goals (7 goal hub posts with taxonomy terms)', 'nnt-core' ); ?></li>
                <li><?php esc_html_e( 'Starter Guides (10 draft posts)', 'nnt-core' ); ?></li>
                <li><?php esc_html_e( 'Starter Collections (8 draft posts)', 'nnt-core' ); ?></li>
                <li><?php esc_html_e( 'Navigation Menu (Primary menu)', 'nnt-core' ); ?></li>
                <li><?php esc_html_e( 'Homepage Settings (static front page)', 'nnt-core' ); ?></li>
            </ul>
            <p><strong><?php esc_html_e( 'Note:', 'nnt-core' ); ?></strong> <?php esc_html_e( 'This is idempotent—running multiple times will update existing content, not duplicate it.', 'nnt-core' ); ?></p>
        </div>

        <?php if ( $results ) : ?>
            <div class="notice notice-success" style="max-width: 600px; margin-top: 20px;">
                <h3><?php esc_html_e( 'Seeder Results', 'nnt-core' ); ?></h3>
                <pre style="background: #f5f5f5; padding: 15px; border-radius: 4px;"><?php echo esc_html( $seeder->format_results() ); ?></pre>
            </div>
        <?php endif; ?>

        <form method="post" style="margin-top: 20px;">
            <?php wp_nonce_field( 'nnt_seeder_nonce', 'nnt_seeder_nonce_field' ); ?>
            <p>
                <input type="submit" name="nnt_run_seeder" class="button button-primary button-hero" value="<?php esc_attr_e( 'Run Seeder', 'nnt-core' ); ?>">
            </p>
        </form>

        <div class="card" style="max-width: 600px; margin-top: 30px; padding: 20px; background: #f9f9f9;">
            <h3><?php esc_html_e( 'WP-CLI Command', 'nnt-core' ); ?></h3>
            <p><?php esc_html_e( 'You can also run the seeder via WP-CLI:', 'nnt-core' ); ?></p>
            <code style="background: #222; color: #0f0; padding: 10px; display: block; border-radius: 4px;">wp nnt seed</code>
        </div>
    </div>
    <?php
}

