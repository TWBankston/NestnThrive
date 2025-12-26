<?php
/**
 * Site Seeder - Creates demo content for template testing.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class NNT_Core_Seeder
 * 
 * Provides idempotent seeding for demo content.
 */
class NNT_Core_Seeder {

    /**
     * Seed result messages.
     *
     * @var array
     */
    private static $results = array();

    /**
     * WP-CLI command handler.
     *
     * @param array $args       Positional args.
     * @param array $assoc_args Named args.
     */
    public static function run_seeder_cli( $args, $assoc_args ) {
        WP_CLI::log( 'Starting NNT Site Seeder...' );
        
        self::run_seeder();
        
        foreach ( self::$results as $message ) {
            WP_CLI::log( $message );
        }
        
        WP_CLI::success( 'Seeding complete!' );
    }

    /**
     * Admin page callback.
     */
    public static function admin_page_content() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $ran_seeder = false;

        if ( isset( $_POST['nnt_run_seeder'] ) && check_admin_referer( 'nnt_seeder_nonce', 'nnt_seeder_nonce_field' ) ) {
            self::run_seeder();
            $ran_seeder = true;
        }

        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'NNT Site Seeder', 'nnt-core' ); ?></h1>
            
            <div class="notice notice-warning">
                <p><strong><?php esc_html_e( 'Warning:', 'nnt-core' ); ?></strong> 
                <?php esc_html_e( 'This will create demo content for testing purposes. The content is clearly marked as demo and can be deleted later.', 'nnt-core' ); ?></p>
            </div>

            <?php if ( $ran_seeder && ! empty( self::$results ) ) : ?>
                <div class="notice notice-success">
                    <p><strong><?php esc_html_e( 'Seeding Results:', 'nnt-core' ); ?></strong></p>
                    <ul style="margin-left: 20px; list-style: disc;">
                        <?php foreach ( self::$results as $message ) : ?>
                            <li><?php echo esc_html( $message ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" style="margin-top: 20px;">
                <?php wp_nonce_field( 'nnt_seeder_nonce', 'nnt_seeder_nonce_field' ); ?>
                
                <p class="description">
                    <?php esc_html_e( 'This seeder will create:', 'nnt-core' ); ?>
                </p>
                <ul style="margin-left: 20px; list-style: disc;">
                    <li><?php esc_html_e( '4 Rooms (Living Room, Bedroom, Kitchen, Home Office)', 'nnt-core' ); ?></li>
                    <li><?php esc_html_e( '4 Goals (Organization, Lighting, Small Spaces, Ergonomics)', 'nnt-core' ); ?></li>
                    <li><?php esc_html_e( '6 Guides (demo how-to articles)', 'nnt-core' ); ?></li>
                    <li><?php esc_html_e( '6 Collections (demo product reviews)', 'nnt-core' ); ?></li>
                    <li><?php esc_html_e( 'Static pages (About, Contact, Deals)', 'nnt-core' ); ?></li>
                    <li><?php esc_html_e( 'Matching taxonomy terms', 'nnt-core' ); ?></li>
                </ul>

                <p style="margin-top: 20px;">
                    <input type="submit" name="nnt_run_seeder" class="button button-primary" value="<?php esc_attr_e( 'Run Seeder', 'nnt-core' ); ?>">
                </p>
            </form>
        </div>
        <?php
    }

    /**
     * Main seeder runner.
     */
    public static function run_seeder() {
        self::$results = array();

        // Seed static pages.
        self::seed_pages();

        // Seed rooms.
        self::seed_rooms();

        // Seed goals.
        self::seed_goals();

        // Seed guides.
        self::seed_guides();

        // Seed collections.
        self::seed_collections();

        // Set homepage.
        self::set_static_homepage();

        // Flush rewrite rules.
        flush_rewrite_rules();

        self::$results[] = __( 'Rewrite rules flushed.', 'nnt-core' );
    }

    /**
     * Seed static pages.
     */
    private static function seed_pages() {
        $pages = array(
            array(
                'post_title'   => 'About',
                'post_name'    => 'about',
                'post_content' => '<!-- wp:paragraph --><p>This is a demo About page. Replace with your real content.</p><!-- /wp:paragraph -->',
            ),
            array(
                'post_title'   => 'Contact',
                'post_name'    => 'contact',
                'post_content' => '<!-- wp:paragraph --><p>This is a demo Contact page. The contact form is built into the template.</p><!-- /wp:paragraph -->',
            ),
            array(
                'post_title'   => 'Deals',
                'post_name'    => 'deals',
                'post_content' => '',
                'page_template' => 'page-deals.php',
            ),
        );

        $created = 0;
        foreach ( $pages as $page_data ) {
            $result = self::get_or_create_post( array_merge( $page_data, array(
                'post_type'   => 'page',
                'post_status' => 'publish',
            ) ) );
            if ( $result['created'] ) {
                $created++;
            }
        }

        self::$results[] = sprintf( __( 'Pages: %d created, %d already existed.', 'nnt-core' ), $created, count( $pages ) - $created );
    }

    /**
     * Seed rooms and their taxonomy terms.
     */
    private static function seed_rooms() {
        $rooms = array(
            array(
                'post_title' => 'Living Room',
                'post_name'  => 'living-room',
                'excerpt'    => 'Demo: The heart of your home. A calm space for family and relaxation.',
            ),
            array(
                'post_title' => 'Bedroom',
                'post_name'  => 'bedroom',
                'excerpt'    => 'Demo: Your restful retreat. Creating a calm sleep environment.',
            ),
            array(
                'post_title' => 'Kitchen',
                'post_name'  => 'kitchen',
                'excerpt'    => 'Demo: Where meals and memories are made. Functional and beautiful.',
            ),
            array(
                'post_title' => 'Home Office',
                'post_name'  => 'home-office',
                'excerpt'    => 'Demo: Your productive workspace. Ergonomic, organized, focused.',
            ),
        );

        $created = 0;
        foreach ( $rooms as $room_data ) {
            // Create the room CPT.
            $result = self::get_or_create_post( array(
                'post_title'   => $room_data['post_title'],
                'post_name'    => $room_data['post_name'],
                'post_type'    => 'nnt_room',
                'post_status'  => 'publish',
                'post_excerpt' => $room_data['excerpt'],
            ) );

            if ( $result['created'] ) {
                $created++;
            }

            // Create matching taxonomy term.
            self::get_or_create_term( $room_data['post_name'], $room_data['post_title'], 'nnt_room_tax' );
        }

        self::$results[] = sprintf( __( 'Rooms: %d created, %d already existed.', 'nnt-core' ), $created, count( $rooms ) - $created );
    }

    /**
     * Seed goals and their taxonomy terms.
     */
    private static function seed_goals() {
        $goals = array(
            array(
                'post_title' => 'Organization',
                'post_name'  => 'organization',
                'excerpt'    => 'Demo: Reduce clutter, increase calm. Systems that actually stick.',
                'icon'       => 'boxes',
            ),
            array(
                'post_title' => 'Lighting',
                'post_name'  => 'lighting',
                'excerpt'    => 'Demo: Set the right mood. Practical and ambient lighting solutions.',
                'icon'       => 'lamp',
            ),
            array(
                'post_title' => 'Small Spaces',
                'post_name'  => 'small-spaces',
                'excerpt'    => 'Demo: Maximize every square foot. Smart solutions for compact living.',
                'icon'       => 'maximize-2',
            ),
            array(
                'post_title' => 'Ergonomics',
                'post_name'  => 'ergonomics',
                'excerpt'    => 'Demo: Work comfortably, live better. Posture and productivity.',
                'icon'       => 'armchair',
            ),
        );

        $created = 0;
        foreach ( $goals as $goal_data ) {
            $result = self::get_or_create_post( array(
                'post_title'   => $goal_data['post_title'],
                'post_name'    => $goal_data['post_name'],
                'post_type'    => 'nnt_goal',
                'post_status'  => 'publish',
                'post_excerpt' => $goal_data['excerpt'],
            ) );

            if ( $result['created'] ) {
                $created++;
            }

            // Create matching taxonomy term.
            self::get_or_create_term( $goal_data['post_name'], $goal_data['post_title'], 'nnt_goal_tax' );
        }

        self::$results[] = sprintf( __( 'Goals: %d created, %d already existed.', 'nnt-core' ), $created, count( $goals ) - $created );
    }

    /**
     * Seed guides.
     */
    private static function seed_guides() {
        $guides = array(
            array(
                'post_title' => 'Demo: How to Set Up a Home Office',
                'post_name'  => 'demo-how-to-set-up-home-office',
                'excerpt'    => 'A practical guide to creating an ergonomic and productive workspace at home.',
                'room'       => 'home-office',
                'goal'       => 'ergonomics',
            ),
            array(
                'post_title' => 'Demo: Living Room Lighting Guide',
                'post_name'  => 'demo-living-room-lighting-guide',
                'excerpt'    => 'Layer your lighting for a cozy, functional living space.',
                'room'       => 'living-room',
                'goal'       => 'lighting',
            ),
            array(
                'post_title' => 'Demo: Bedroom Organization Tips',
                'post_name'  => 'demo-bedroom-organization-tips',
                'excerpt'    => 'Simple systems to keep your bedroom calm and clutter-free.',
                'room'       => 'bedroom',
                'goal'       => 'organization',
            ),
            array(
                'post_title' => 'Demo: Small Kitchen Storage Solutions',
                'post_name'  => 'demo-small-kitchen-storage',
                'excerpt'    => 'Maximize every inch of your compact kitchen.',
                'room'       => 'kitchen',
                'goal'       => 'small-spaces',
            ),
            array(
                'post_title' => 'Demo: Desk Cable Management',
                'post_name'  => 'demo-desk-cable-management',
                'excerpt'    => 'Tame the cable chaos under your desk once and for all.',
                'room'       => 'home-office',
                'goal'       => 'organization',
            ),
            array(
                'post_title' => 'Demo: Creating a Sleep-Friendly Bedroom',
                'post_name'  => 'demo-sleep-friendly-bedroom',
                'excerpt'    => 'Environment tweaks for better rest.',
                'room'       => 'bedroom',
                'goal'       => 'lighting',
            ),
        );

        $created = 0;
        foreach ( $guides as $guide_data ) {
            $content = '<!-- wp:paragraph --><p>This is demo content for template testing. Replace with your actual guide content.</p><!-- /wp:paragraph -->';
            $content .= '<!-- wp:heading --><h2>Step 1: Planning</h2><!-- /wp:heading -->';
            $content .= '<!-- wp:paragraph --><p>Demo step content goes here.</p><!-- /wp:paragraph -->';
            $content .= '<!-- wp:heading --><h2>Step 2: Implementation</h2><!-- /wp:heading -->';
            $content .= '<!-- wp:paragraph --><p>Demo step content goes here.</p><!-- /wp:paragraph -->';

            $result = self::get_or_create_post( array(
                'post_title'   => $guide_data['post_title'],
                'post_name'    => $guide_data['post_name'],
                'post_type'    => 'nnt_guide',
                'post_status'  => 'publish',
                'post_excerpt' => $guide_data['excerpt'],
                'post_content' => $content,
            ) );

            if ( $result['created'] || $result['post_id'] ) {
                // Assign taxonomy terms.
                $room_term = get_term_by( 'slug', $guide_data['room'], 'nnt_room_tax' );
                $goal_term = get_term_by( 'slug', $guide_data['goal'], 'nnt_goal_tax' );

                if ( $room_term ) {
                    wp_set_object_terms( $result['post_id'], $room_term->term_id, 'nnt_room_tax' );
                }
                if ( $goal_term ) {
                    wp_set_object_terms( $result['post_id'], $goal_term->term_id, 'nnt_goal_tax' );
                }
            }

            if ( $result['created'] ) {
                $created++;
            }
        }

        self::$results[] = sprintf( __( 'Guides: %d created, %d already existed.', 'nnt-core' ), $created, count( $guides ) - $created );
    }

    /**
     * Seed collections.
     */
    private static function seed_collections() {
        $collections = array(
            array(
                'post_title' => 'Demo: Best Desk Chairs for Home Office',
                'post_name'  => 'demo-best-desk-chairs',
                'excerpt'    => 'Our top ergonomic chair picks after testing 15 models.',
                'room'       => 'home-office',
                'goal'       => 'ergonomics',
                'is_deal'    => true,
                'deal_badge' => '20% Off',
            ),
            array(
                'post_title' => 'Demo: Best Desk Lamps for Work',
                'post_name'  => 'demo-best-desk-lamps',
                'excerpt'    => 'Task lighting that reduces eye strain and looks great.',
                'room'       => 'home-office',
                'goal'       => 'lighting',
                'is_deal'    => false,
            ),
            array(
                'post_title' => 'Demo: Best Closet Organizers',
                'post_name'  => 'demo-best-closet-organizers',
                'excerpt'    => 'Maximize your closet space with these tested systems.',
                'room'       => 'bedroom',
                'goal'       => 'organization',
                'is_deal'    => true,
                'deal_badge' => 'Limited Time',
            ),
            array(
                'post_title' => 'Demo: Best Nightstands',
                'post_name'  => 'demo-best-nightstands',
                'excerpt'    => 'Functional bedside tables for any bedroom style.',
                'room'       => 'bedroom',
                'goal'       => 'small-spaces',
                'is_deal'    => false,
            ),
            array(
                'post_title' => 'Demo: Best Kitchen Drawer Organizers',
                'post_name'  => 'demo-best-kitchen-drawer-organizers',
                'excerpt'    => 'Bring order to your kitchen drawers.',
                'room'       => 'kitchen',
                'goal'       => 'organization',
                'is_deal'    => false,
            ),
            array(
                'post_title' => 'Demo: Best Floor Lamps for Living Room',
                'post_name'  => 'demo-best-floor-lamps',
                'excerpt'    => 'Ambient lighting that transforms your living space.',
                'room'       => 'living-room',
                'goal'       => 'lighting',
                'is_deal'    => true,
                'deal_badge' => 'Sale',
            ),
        );

        $created = 0;
        foreach ( $collections as $col_data ) {
            $content = '<!-- wp:paragraph --><p>This is demo content for template testing. Replace with your actual review content.</p><!-- /wp:paragraph -->';

            $result = self::get_or_create_post( array(
                'post_title'   => $col_data['post_title'],
                'post_name'    => $col_data['post_name'],
                'post_type'    => 'nnt_collection',
                'post_status'  => 'publish',
                'post_excerpt' => $col_data['excerpt'],
                'post_content' => $content,
            ) );

            $post_id = $result['post_id'];

            if ( $post_id ) {
                // Assign taxonomy terms.
                $room_term = get_term_by( 'slug', $col_data['room'], 'nnt_room_tax' );
                $goal_term = get_term_by( 'slug', $col_data['goal'], 'nnt_goal_tax' );

                if ( $room_term ) {
                    wp_set_object_terms( $post_id, $room_term->term_id, 'nnt_room_tax' );
                }
                if ( $goal_term ) {
                    wp_set_object_terms( $post_id, $goal_term->term_id, 'nnt_goal_tax' );
                }

                // Set products tested count.
                update_post_meta( $post_id, 'nnt_products_tested', rand( 5, 15 ) );

                // Set demo products data.
                $products_data = array(
                    array(
                        'name'          => 'Demo Product One',
                        'image_url'     => '',
                        'price_note'    => 'Around $100-150',
                        'rating'        => 4.5,
                        'affiliate_url' => '#',
                        'pros'          => array( 'Demo pro 1', 'Demo pro 2' ),
                        'cons'          => array( 'Demo con 1' ),
                    ),
                    array(
                        'name'          => 'Demo Product Two',
                        'image_url'     => '',
                        'price_note'    => 'Around $75-100',
                        'rating'        => 4.0,
                        'affiliate_url' => '#',
                        'pros'          => array( 'Demo pro 1', 'Demo pro 2' ),
                        'cons'          => array( 'Demo con 1' ),
                    ),
                    array(
                        'name'          => 'Demo Product Three',
                        'image_url'     => '',
                        'price_note'    => 'Budget pick',
                        'rating'        => 3.5,
                        'affiliate_url' => '#',
                        'pros'          => array( 'Demo pro 1' ),
                        'cons'          => array( 'Demo con 1', 'Demo con 2' ),
                    ),
                );
                update_post_meta( $post_id, 'nnt_products_data', $products_data );

                // Set deal meta if applicable.
                if ( ! empty( $col_data['is_deal'] ) && $col_data['is_deal'] ) {
                    update_post_meta( $post_id, 'nnt_deal_active', true );
                    update_post_meta( $post_id, 'nnt_deal_badge', $col_data['deal_badge'] ?? 'Sale' );
                    update_post_meta( $post_id, 'nnt_deal_last_checked', current_time( 'Y-m-d H:i:s' ) );
                }
            }

            if ( $result['created'] ) {
                $created++;
            }
        }

        self::$results[] = sprintf( __( 'Collections: %d created, %d already existed.', 'nnt-core' ), $created, count( $collections ) - $created );
    }

    /**
     * Set the static homepage.
     */
    private static function set_static_homepage() {
        // WordPress doesn't use a front-page.php "page" by default for the homepage.
        // Just ensure the reading settings are correct.
        update_option( 'show_on_front', 'page' );
        
        // Check if we have a homepage set.
        $front_page_id = get_option( 'page_on_front' );
        
        if ( ! $front_page_id ) {
            // Create a simple front page if needed (though front-page.php will override).
            $result = self::get_or_create_post( array(
                'post_title'   => 'Home',
                'post_name'    => 'home',
                'post_type'    => 'page',
                'post_status'  => 'publish',
                'post_content' => '',
            ) );
            
            if ( $result['post_id'] ) {
                update_option( 'page_on_front', $result['post_id'] );
                self::$results[] = __( 'Homepage set.', 'nnt-core' );
            }
        }
    }

    /**
     * Get or create a post (idempotent).
     *
     * @param array $post_data Post data.
     * @return array ['post_id' => int, 'created' => bool]
     */
    private static function get_or_create_post( $post_data ) {
        // Check if post already exists by slug.
        $existing = get_page_by_path( $post_data['post_name'], OBJECT, $post_data['post_type'] );

        if ( $existing ) {
            return array( 'post_id' => $existing->ID, 'created' => false );
        }

        // Create the post.
        $post_id = wp_insert_post( array(
            'post_title'   => $post_data['post_title'],
            'post_name'    => $post_data['post_name'],
            'post_type'    => $post_data['post_type'],
            'post_status'  => $post_data['post_status'] ?? 'publish',
            'post_content' => $post_data['post_content'] ?? '',
            'post_excerpt' => $post_data['post_excerpt'] ?? '',
        ) );

        if ( is_wp_error( $post_id ) ) {
            return array( 'post_id' => 0, 'created' => false );
        }

        // Set page template if specified.
        if ( ! empty( $post_data['page_template'] ) ) {
            update_post_meta( $post_id, '_wp_page_template', $post_data['page_template'] );
        }

        return array( 'post_id' => $post_id, 'created' => true );
    }

    /**
     * Get or create a taxonomy term (idempotent).
     *
     * @param string $slug     Term slug.
     * @param string $name     Term name.
     * @param string $taxonomy Taxonomy name.
     * @return int|false Term ID or false on failure.
     */
    private static function get_or_create_term( $slug, $name, $taxonomy ) {
        $existing = get_term_by( 'slug', $slug, $taxonomy );

        if ( $existing ) {
            return $existing->term_id;
        }

        $result = wp_insert_term( $name, $taxonomy, array( 'slug' => $slug ) );

        if ( is_wp_error( $result ) ) {
            return false;
        }

        return $result['term_id'];
    }
}

/**
 * Admin page callback wrapper.
 */
function nnt_core_seeder_admin_page_content() {
    NNT_Core_Seeder::admin_page_content();
}
