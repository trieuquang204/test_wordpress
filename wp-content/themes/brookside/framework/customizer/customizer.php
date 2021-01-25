<?php 
/* customizer */
$brookside_cache_time_google_fonts = get_option('brookside_cache_time_google_fonts');
$diff = time() - $brookside_cache_time_google_fonts;
$crt = 604800;
$google_fonts = $google_fonts_vc = array();
function brookside_sanitize_text_html( $input ) {
  return wp_kses_post( force_balance_tags( ''.$input ) );
}

function brookside_create_font_types_vc( $variants ){
	$font_types = array();
	foreach ($variants as $variant) {
		switch ($variant) {
			case '100':
				$font_types[] = 'Thin:100:normal';
				break;
			case '100italic':
				$font_types[] = 'Thin italic:100:italic';
				break;
			case '200':
				$font_types[] = 'Extra-Light:200:normal';
				break;
			case '200italic':
				$font_types[] = 'Extra-Light italic:200:italic';
				break;
			case '300':
				$font_types[] = 'Light:300:normal';
				break;
			case '300italic':
				$font_types[] = 'Light italic:300:italic';
				break;
			case '500':
				$font_types[] = 'Medium:500:normal';
				break;
			case '500italic':
				$font_types[] = 'Medium italic:500:italic';
				break;
			case '600':
				$font_types[] = 'Semi-bold:600:normal';
				break;
			case '600italic':
				$font_types[] = 'Semi-bold italic:600:italic';
				break;
			case '700':
				$font_types[] = 'Bold:700:normal';
				break;
			case '700italic':
				$font_types[] = 'Bold italic:700:italic';
				break;
			case '800':
				$font_types[] = 'Extra-bold:800:normal';
				break;
			case '800italic':
				$font_types[] = 'Extra-bold italic:800:italic';
				break;
			case '900':
				$font_types[] = 'Black:900:normal';
				break;
			case '900italic':
				$font_types[] = 'Black italic:900:italic';
				break;
			case 'italic':
				$font_types[] = 'Regular italic:400:italic';
			case 'regular':
				$font_types[] = 'Regular:400:normal';
			default:
				
				break;
		}
	}
	$tmp = implode(',', $font_types);
	return $tmp;
}
function brookside_get_all_posts(){
	$args = array(
	  'numberposts' => -1,
	  'post_type'   => 'post',
	  'orderby'		=> 'date'
	);
	$the_query = new WP_Query( $args );
	$array_of_post = array();
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$array_of_post[get_the_ID()] = get_the_title();
		}
	}
	wp_reset_postdata();
	if( empty($array_of_post) ){
		$array_of_post['not-select'] = esc_html__('No posts to select', 'brookside');
	}
	return $array_of_post;
}
function brookside_sanitize_posts_select( $input )
{
    $valid = brookside_get_all_posts();
    foreach ($input as $value) {
        if ( !array_key_exists( $value, $valid ) ) {
            return [];
        }
    }
    return $input;
}
function brookside_get_all_posts_pages(){
	$args = array(
	  'numberposts' => -1,
	  'post_type'   => array('post', 'page'),
	  'orderby'		=> 'type'
	);
	$the_query = new WP_Query( $args );
	$array_of_post = array();
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$array_of_post[get_the_ID()] = get_the_title();
		}
	}
	wp_reset_postdata();
	if( empty($array_of_post) ){
		$array_of_post['not-select'] = esc_html__('No items to select', 'brookside');
	}
	return $array_of_post;
}
if( $diff >= $crt || empty($brookside_cache_time_google_fonts ) ){
	$url = "http://www.artstudioworks.net/webfonts/fonts.json";
	$tmpresult = wp_remote_get($url);
	$result = wp_remote_retrieve_body( $tmpresult );
	$result = json_decode($result, TRUE);
	if(is_array($result)){
		foreach ( $result['items'] as $font ) {
		    $google_fonts[] = $font['family'];
		    $temp_font = (object)array(); 
		    $temp_font->font_family = $font['family'];
		    $temp_font->font_types = brookside_create_font_types_vc($font['variants']);
		    if( in_array('italic', $font['variants'] ) ){
		    	$temp_font->font_styles = 'regular,italic';
		    } else {
		    	$temp_font->font_styles = 'regular';
		    }
		    $temp_font->font_family_description = esc_html__( 'Select font family', 'brookside' );
	    	$temp_font->font_style_description = esc_html__( 'Select font styling', 'brookside' );
		    $google_fonts_vc[] = $temp_font;         
		}
	}
	$google_fonts = array_filter($google_fonts);
	update_option('brookside_cached_google_fonts', serialize($google_fonts));
	update_option('brookside_cached_google_fonts_vc', $google_fonts_vc);
	update_option('brookside_cache_time_google_fonts', time());
} else {
	$google_fonts = maybe_unserialize(get_option('brookside_cached_google_fonts'));
}
if(empty($google_fonts)){
	$google_fonts = array('ABeeZee','Abel','Abril Fatface','Aclonica','Acme','Actor','Adamina','Advent Pro','Aguafina Script','Akronim','Aladin','Aldrich','Alef','Alegreya','Alegreya SC','Alegreya Sans','Alegreya Sans SC','Alex Brush','Alfa Slab One','Alice','Alike','Alike Angular','Allan','Allerta','Allerta Stencil','Allura','Almendra','Almendra Display','Almendra SC','Amarante','Amaranth','Amatic SC','Amethysta','Anaheim','Andada','Andika','Angkor','Annie Use Your Telescope','Anonymous Pro','Antic','Antic Didone','Antic Slab','Anton','Arapey','Arbutus','Arbutus Slab','Architects Daughter','Archivo Black','Archivo Narrow','Arimo','Arizonia','Armata','Artifika','Arvo','Asap','Asset','Astloch','Asul','Atomic Age','Aubrey','Audiowide','Autour One','Average','Average Sans','Averia Gruesa Libre','Averia Libre','Averia Sans Libre','Averia Serif Libre','Bad Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','BenchNine','Bentham','Berkshire Swash','Bevan','Bigelow Rules','Bigshot One','Bilbo','Bilbo Swash Caps','Bitter','Black Ops One','Bokor','Bonbon','Boogaloo','Bowlby One','Bowlby One SC','Brawler','Bree Serif','Bubblegum Sans','Bubbler One','Buda','Buenard','Butcherman','Butterfly Kids','Cabin','Cabin Condensed','Cabin Sketch','Caesar Dressing','Cagliostro','Calligraffitti','Cambo','Candal','Cantarell','Cantata One','Cantora One','Capriola','Cardo','Carme','Carrois Gothic','Carrois Gothic SC','Carter One','Caudex','Cedarville Cursive','Ceviche One','Changa One','Chango','Chau Philomene One','Chela One','Chelsea Market','Chenla','Cherry Cream Soda','Cherry Swash','Chewy','Chicle','Chivo','Cinzel','Cinzel Decorative','Clicker Script','Coda','Coda Caption','Codystar','Combo','Comfortaa','Coming Soon','Concert One','Condiment','Content','Contrail One','Convergence','Cookie','Copse','Corben','Courgette','Cousine','Coustard','Covered By Your Grace','Crafty Girls','Creepster','Crete Round','Crimson Text','Croissant One','Crushed','Cuprum','Cutive','Cutive Mono','Damion','Dancing Script','Dangrek','Dawning of a New Day','Days One','Delius','Delius Swash Caps','Delius Unicase','Della Respira','Denk One','Devonshire','Didact Gothic','Diplomata','Diplomata SC','Domine','Donegal One','Doppio One','Dorsa','Dosis','Dr Sugiyama','Droid Sans','Droid Sans Mono','Droid Serif','Duru Sans','Dynalight','EB Garamond','Eagle Lake','Eater','Economica','Ek Mukta','Electrolize','Elsie','Elsie Swash Caps','Emblema One','Emilys Candy','Engagement','Englebert','Enriqueta','Erica One','Esteban','Euphoria Script','Ewert','Exo','Exo 2','Expletus Sans','Fanwood Text','Fascinate','Fascinate Inline','Faster One','Fasthand','Fauna One','Federant','Federo','Felipa','Fenix','Finger Paint','Fira Mono','Fira Sans','Fjalla One','Fjord One','Flamenco','Flavors','Fondamento','Fontdiner Swanky','Forum','Francois One','Freckle Face','Fredericka the Great','Fredoka One','Freehand','Fresca','Frijole','Fruktur','Fugaz One','GFS Didot','GFS Neohellenic','Gabriela','Gafata','Galdeano','Galindo','Gentium Basic','Gentium Book Basic','Geo','Geostar','Geostar Fill','Germania One','Gilda Display','Give You Glory','Glass Antiqua','Glegoo','Gloria Hallelujah','Goblin One','Gochi Hand','Gorditas','Goudy Bookletter 1911','Graduate','Grand Hotel','Gravitas One','Great Vibes','Griffy','Gruppo','Gudea','Habibi','Hammersmith One','Hanalei','Hanalei Fill','Handlee','Hanuman','Happy Monkey','Headland One','Henny Penny','Herr Von Muellerhoff','Holtwood One SC','Homemade Apple','Homenaje','IM Fell DW Pica','IM Fell DW Pica SC','IM Fell Double Pica','IM Fell Double Pica SC','IM Fell English','IM Fell English SC','IM Fell French Canon','IM Fell French Canon SC','IM Fell Great Primer','IM Fell Great Primer SC','Iceberg','Iceland','Impbrookside','Inconsolata','Inder','Indie Flower','Inika','Irish Grover','Istok Web','Italiana','Italianno','Jacques Francois','Jacques Francois Shadow','Jim Nightshade','Jockey One','Jolly Lodger','Josefin Sans','Josefin Slab','Joti One','Judson','Julee','Julius Sans One','Junge','Jura','Just Another Hand','Just Me Again Down Here','Kameron','Kantumruy','Karla','Kaushan Script','Kavoon','Kdam Thmor','Keania One','Kelly Slab','Kenia','Khmer','Kite One','Knewave','Kotta One','Koulen','Kranky','Kreon','Kristi','Krona One','La Belle Aurore','Lancelot','Lato','League Script','Leckerli One','Ledger','Lekton','Lemon','Libre Baskerville','Life Savers','Lilita One','Lily Script One','Limelight','Linden Hill','Lobster','Lobster Two','Londrina Outline','Londrina Shadow','Londrina Sketch','Londrina Solid','Lora','Love Ya Like A Sister','Loved by the King','Lovers Quarrel','Luckiest Guy','Lusitana','Lustria','Macondo','Macondo Swash Caps','Magra','Maiden Orange','Mako','Marcellus','Marcellus SC','Marck Script','Margarine','Marko One','Marmelad','Marvel','Mate','Mate SC','Maven Pro','McLaren','Meddon','MedievalSharp','Medula One','Megrim','Meie Script','Merienda','Merienda One','Merriweather','Merriweather Sans','Metal','Metal Mania','Metamorphous','Metrophobic','Michroma','Milonga','Miltonian','Miltonian Tattoo','Miniver','Miss Fajardose','Modern Antiqua','Molengo','Molle','Monda','Monofett','Monoton','Monsieur La Doulaise','Montaga','Montez','Montserrat','Montserrat Alternates','Montserrat Subrayada','Moul','Moulpali','Mountains of Christmas','Mouse Memoirs','Mr Bedfort','Mr Dafoe','Mr De Haviland','Mrs Saint Delafield','Mrs Sheppards','Muli','Mystery Quest','Neucha','Neuton','New Rocker','News Cycle','Niconne','Nixie One','Nobile','Nokora','Norican','Nosifer','Nothing You Could Do','Noticia Text','Noto Sans','Noto Serif','Nova Cut','Nova Flat','Nova Mono','Nova Oval','Nova Round','Nova Script','Nova Slim','Nova Square','Numans','Nunito','Odor Mean Chey','Offside','Old Standard TT','Oldenburg','Oleo Script','Oleo Script Swash Caps','Open Sans','Open Sans Condensed','Oranienbaum','Orbitron','Oregano','Orienta','Original Surfer','Oswald','Over the Rainbow','Overlock','Overlock SC','Ovo','Oxygen','Oxygen Mono','PT Mono','PT Sans','PT Sans Caption','PT Sans Narrow','PT Serif','PT Serif Caption','Pacifico','Paprika','Parisienne','Passero One','Passion One','Pathway Gothic One','Patrick Hand','Patrick Hand SC','Patua One','Paytone One','Peralta','Permanent Marker','Petit Formal Script','Petrona','Philosopher','Piedra','Pinyon Script','Pirata One','Plaster','Play','Playball','Playfair Display','Playfair Display SC','Podkova','Poiret One','Poller One','Poly','Pompiere','Pontano Sans','Port Lligat Sans','Port Lligat Slab','Prata','Preahvihear','Press Start 2P','Princess Sofia','Prociono','Prosto One','Puritan','Purple Purse','Quando','Quantico','Quattrocento','Quattrocento Sans','Questrial','Quicksand','Quintessential','Qwigley','Racing Sans One','Radley','Raleway','Raleway Dots','Rambla','Rammetto One','Ranchers','Rancho','Rationale','Redressed','Reenie Beanie','Revalia','Ribeye','Ribeye Marrow','Righteous','Risque','Roboto','Roboto Condensed','Roboto Slab','Rochester','Rock Salt','Rokkitt','Romanesco','Ropa Sans','Rosario','Rosarivo','Rouge Script','Rubik Mono One','Rubik One','Ruda','Rufina','Ruge Boogie','Ruluko','Rum Raisin','Ruslan Display','Russo One','Ruthie','Rye','Sacramento','Sail','Salsa','Sanchez','Sancreek','Sansita One','Sarina','Satisfy','Scada','Schoolbell','Seaweed Script','Sevillana','Seymour One','Shadows Into Light','Shadows Into Light Two','Shanti','Share','Share Tech','Share Tech Mono','Shojumaru','Short Stack','Siemreap','Sigmar One','Signika','Signika Negative','Simonetta','Sintony','Sirin Stencil','Six Caps','Skranji','Slackey','Smokum','Smythe','Sniglet','Snippet','Snowburst One','Sofadi One','Sofia','Sonsie One','Sorts Mill Goudy','Source Code Pro','Source Sans Pro','Source Serif Pro','Special Elite','Spicy Rice','Spinnaker','Spirax','Squada One','Stalemate','Stalinist One','Stardos Stencil','Stint Ultra Condensed','Stint Ultra Expanded','Stoke','Strait','Sue Ellen Francisco','Sunshiney','Supermercado One','Suwannaphum','Swanky and Moo Moo','Syncopate','Tangerine','Taprom','Tauri','Telex','Tenor Sans','Text Me One','The Girl Next Door','Tienne','Tinos','Titan One','Titillium Web','Trade Winds','Trocchi','Trochut','Trykker','Tulpen One','Ubuntu','Ubuntu Condensed','Ubuntu Mono','Ultra','Uncial Antiqua','Underdog','Unica One','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Vampiro One','Varela','Varela Round','Vast Shadow','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting for the Sunrise','Wallpoet','Walter Turncoat','Warnes','Wellfleet','Wendy One','Wire One','Yanone Kaffeesatz','Yellowtail','Yeseva One','Yesteryear','Zeyada');
}

if ( ! function_exists( 'brookside_helper_vc_fonts' ) ) {
	function brookside_helper_vc_fonts( $fonts_list ) {

		$google_fonts_vc = get_option('brookside_cached_google_fonts_vc');
		
		if( !empty($google_fonts_vc) ) {
			$fonts_list = $google_fonts_vc;
		}
	    
	    return $fonts_list;
	}
}
add_filter('vc_google_fonts_get_fonts_filter', 'brookside_helper_vc_fonts');

function brookside_register_theme_customizer( $wp_customize ) {

	/**
	 * Multiple checkbox customize control class.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class Brookside_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

	    /**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
	    public $type = 'checkbox-multiple';

	    /**
	     * Enqueue scripts/styles.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
	    public function enqueue() {
	        wp_enqueue_script( 'js-for-customize' );
	    }

	    /**
	     * Displays the control content.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
	    public function render_content() {

	        if ( empty( $this->choices ) )
	            return; ?>

	        <?php if ( !empty( $this->label ) ) : ?>
	            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <?php endif; ?>

	        <?php if ( !empty( $this->description ) ) : ?>
	            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	        <?php endif; ?>

	        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

	        <ul>
	            <?php foreach ( $this->choices as $value => $label ) : ?>

	                <li>
	                    <label>
	                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
	                        <?php echo esc_html( $label ); ?>
	                    </label>
	                </li>

	            <?php endforeach; ?>
	        </ul>

	        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
	    <?php }
	}
	/**
	* Custom Customizer Control: Sortable Checkboxes
	* @link https://shellcreeper.com/?p=1503
	*/
	class Brookside_Control_Image_Select extends WP_Customize_Control {
	 
	    public function enqueue(){
	        wp_enqueue_style( 'css-for-customize' );
	        wp_enqueue_script( 'js-for-customize' );
	        
	    }

	    public function render_content(){

	        if ( empty( $this->choices ) ){ return; }
	 
	        if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif;

	        $html = array();
			$tpl  = '<label class="asw-image-select"><img src="%s"><input type="%s" class="hidden" name="%s" value="%s" %s%s></label>';
			$field = $this->input_attrs;
			foreach ( $this->choices as $value => $image )
			{
				$html[] = sprintf(
					$tpl,
					$image,
					$field['multiple'] ? 'checkbox' : 'radio',
					$this->id,
					esc_attr( $value ),
					$this->get_link(),
					checked( $this->value(), $value, false )
				);
			}
			echo implode(' ', $html); 
	    }
	}

	/**
	 * Multiple select customize control class.
	 */
	class Brookside_Customize_Control_Multiple_Select extends WP_Customize_Control {

	    /**
	     * The type of customize control being rendered.
	     */
	    public $type = 'multiple-select';

	    /**
	     * Displays the multiple select on the customize screen.
	     */
	    public function render_content() {

	    if ( empty( $this->choices ) )
	        return;
	    ?>
	        <label>
	            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	            <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
	                <?php
	                    foreach ( $this->choices as $value => $label ) {
	                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
	                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
	                    }
	                ?>
	            </select>
	        </label>
	    <?php }
	}

	global $google_fonts;
	
	$faces = array( 
		'Arial' => 'Arial',
		'Verdana' => 'Verdana',
		'Trebuchet' => 'Trebuchet',
		'Georgia, sans-serif' => 'Georgia',
		'Times New Roman, sans-serif' => 'Times New Roman',
		'Tahoma' => 'Tahoma',
		'Palatino' => 'Palatino',
		'Helvetica, sans-serif' => 'Helvetica'
	);
	if( is_array($google_fonts) ){
		$google_fonts = array_combine($google_fonts, $google_fonts);
		$faces = array_merge($faces, $google_fonts);
	}
	$font_weights  = array(
		'100' => esc_html__('Thin', 'brookside'),
		'200' => esc_html__('Extra-Light', 'brookside'),
		'300' => esc_html__('Light', 'brookside'),
		'400' => esc_html__('Regular', 'brookside'),
		'500' => esc_html__('Medium', 'brookside'),
		'600' => esc_html__('Semi-Bold', 'brookside'),
		'700' => esc_html__('Bold', 'brookside'),
		'800' => esc_html__('Extra-Bold', 'brookside'),
		'900' => esc_html__('Black', 'brookside')
	);

	$image_sizes = get_intermediate_image_sizes();
	$image_sizes[]= 'full';
	$image_sizes = array_combine($image_sizes, $image_sizes);
	class Brookside_Customize_Control_Title extends WP_Customize_Control {

	    public function render_content(){

	        if ( empty( $this->label ) ){ return; }
	 
	        if ( ! empty( $this->label ) ) : ?>
					<h2><?php echo esc_html( $this->label ); ?>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			</h2><?php endif; 
	    }
	}
	$order = array(
		'DESC'=> esc_html__('From highest to lowest', 'brookside'),
		'ASC' => esc_html__('From lowest to highest', 'brookside')
	);
	$orderby = array(
		'modified' => esc_html__('Last modified date', 'brookside'),
		'comment_count' => esc_html__('Popularity', 'brookside'),
		'title' => esc_html__('Title', 'brookside'),
		'rand' => esc_html__('Random', 'brookside'),
		'date' => esc_html__('Date', 'brookside'),
		'post__in' => esc_html__('Preserve post ID order', 'brookside')

	);
	$show_hide = array(
		'show' => esc_html__('Show', 'brookside'),
		'hide' => esc_html__('Hide', 'brookside')
	);
	$wp_customize->add_panel( 'brookside_theme_options', array(
	    'priority' => 1,
	    'title' => esc_html__( 'Theme Options', 'brookside' ),
	    'description' => esc_html__( 'Options for theme customizing', 'brookside' ),
	) );
	
	$wp_customize->add_section(
	    'brookside_general_options',
	    array(
	        'title'     => esc_html__('General', 'brookside'),
	        'priority'  => 1,
	        'panel' => 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_page_loading',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_page_loading',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Page loading animation','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_smooth_scroll',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_smooth_scroll',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Enable smooth scroll','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_live_search',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_live_search',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Enable live search.','brookside'),
	        'description'     => esc_html__('Enable ajax search in header search form.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_lightbox_enable',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_lightbox_enable',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Enable in-built lightbox feature.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_gdpr_checkbox_consent',
	    array(
	        'default'    =>  'Save my name, email, and website in this browser for the next time I comment.',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_gdpr_checkbox_consent',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Comments cookies opt-in checkbox label','brookside'),
	        'description' => esc_html__('This is checkbox label in comment form','brookside'),
	        'type'      => 'textarea'
	    )
	);
	if(function_exists('brookside_header_meta')){
		$wp_customize->add_setting(
		    'brookside_seo_settings',
		    array(
		        'default'    =>  false,
		        'transport'  =>  'postMessage',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_seo_settings',
		    array(
		        'section'   => 'brookside_general_options',
		        'label'     => esc_html__('Seo settings','brookside'),
		        'description' => esc_html__('Check to disable inbuilt SEO','brookside'),
		        'type'      => 'checkbox'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_meta_keywords',
		    array(
		        'default'            => '',
		        'transport'          => 'postMessage',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_meta_keywords',
		    array(
		        'section'  => 'brookside_general_options',
		        'label'    => esc_html__('Meta Keywords', 'brookside'),
		        'description' => esc_html__('Add relevant keywords separated with commas to improve SEO.','brookside'),
		        'type'     => 'textarea'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_meta_description',
		    array(
		        'default'            => '',
		        'transport'          => 'postMessage',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_meta_description',
		    array(
		        'section'  => 'brookside_general_options',
		        'label'    => esc_html__('Meta Description', 'brookside'),
		        'description' => esc_html__('Enter a short description of the website for SEO.','brookside'),
		        'type'     => 'textarea'
		    )
		);
	}
	$wp_customize->add_setting(
	    'brookside_responsiveness',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_responsiveness',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Responsive Layout','brookside'),
	        'description' => esc_html__('Check to enable responsiveness on your site.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_zoom_mobile',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_zoom_mobile',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Zoom on mobile devices','brookside'),
	        'description' => esc_html__('Check to enable zoom on mobile devices. It will disable responsiveness on mobiles.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_back_to_top',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_back_to_top',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Back to top button','brookside'),
	        'description' => esc_html__('Check to enable {back to top} button.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	/*images crop*/
	$wp_customize->add_setting(
	    'brookside_images_cropping',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_images_cropping',
	        array(
	            'label'      	=> esc_html__( 'Images crop settings', 'brookside' ),
	            'section'		=> 'brookside_general_options',
	            'settings'		=> 'brookside_images_cropping',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_crop_thumbnail',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_crop_thumbnail',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Crop thumbnail','brookside'),
	        'description' => esc_html__('Check to enable cropping for thumbnail image size (160x160).','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_crop_medium',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_crop_medium',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Crop medium','brookside'),
	        'description' => esc_html__('Check to enable cropping for medium image size (570x410).','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_crop_large',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_crop_large',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Crop large','brookside'),
	        'description' => esc_html__('Check to enable cropping for large image size (1170x730).','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_crop_post_thumbnail',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_crop_post_thumbnail',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Crop post-thumbnail','brookside'),
	        'description' => esc_html__('Check to enable cropping for post-thumbnail image size (845x550).','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_extra_medium_crop',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_extra_medium_crop',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Crop brookside-extra-medium','brookside'),
	        'description' => esc_html__('Check to enable cropping for brookside-extra-medium image size (520x410).','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_fullwidth_slider_crop',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_fullwidth_slider_crop',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Crop brookside-fullwidth-slider','brookside'),
	        'description' => esc_html__('Check to enable cropping for brookside-fullwidth-slider image size (1900x650).','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_google_map_api_key',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_google_map_api_key',
	    array(
	        'section'   => 'brookside_general_options',
	        'label'     => esc_html__('Add your google map api key to use it.','brookside'),
	        'description' => esc_html__('Register your api key here https://cloud.google.com/maps-platform/','brookside'),
	        'type'      => 'text'
	    )
	);
	/********************************/
	$wp_customize->add_section(
	    'brookside_search_options',
	    array(
	        'title'     => esc_html__('Search Page', 'brookside'),
	        'priority'  => 6,
	        'panel' => 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_search_style',
	    array(
	        'default'    =>  'style_4',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_search_style',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Search page layout','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'style_1' => esc_html__('Grid', 'brookside'),
	        	'style_6' => esc_html__('Grid Gallery', 'brookside'),
	        	'style_2' => esc_html__( 'Featured', 'brookside' ),
	        	'style_3' => esc_html__( 'Featured even/odd', 'brookside' ),
	        	'style_4' => esc_html__( 'Masonry', 'brookside' ),
	        	'style_5' => esc_html__( 'Masonry 2', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_search_post_count',
	    array(
	        'default'    =>  '8',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_search_post_count',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Search page posts count','brookside'),
	        'description' => esc_html__('Enter posts count for search page.','brookside'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_search_columns',
	    array(
	        'default'    =>  'span6',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_search_columns',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Layout columns count','brookside'),
	        'description'	=> esc_html__('Select columns count for "Grid", "Masonry" layouts', 'brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'span6' => esc_html__('Two columns', 'brookside'),
	        	'span4' => esc_html__( 'Three columns', 'brookside' ),
	        	'span3' => esc_html__( 'Four columns', 'brookside' ),
	        	'span2' => esc_html__( 'Six columns', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_likes_search',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_likes_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Show post likes count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_views_search',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_views_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Show post views count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_comments_search',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_comments_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Show post comments count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_date_search',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_date_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Show post date label','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_read_time_search',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_read_time_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Show estimate time to read post','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_pagination_search',
	    array(
	        'default'    =>  'standard',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_pagination_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Search page pagination','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'standard' => esc_html__('Standard pagination', 'brookside'),
	        	'true' => esc_html__( 'Ajax Load More', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_search_excerpt_count',
	    array(
	        'default'    =>  '15',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_search_excerpt_count',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Search excerpt count','brookside'),
	        'description' => esc_html__('Enter excerpt count for search page.','brookside'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_sidebar_pos_search',
	    array(
	        'default'     => 'sidebar-right',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Control_Image_Select (
	        $wp_customize,
	        'brookside_sidebar_pos_search',
	        array(
	            'label'      	=> esc_html__( 'Search page sidebar', 'brookside' ),
	            'description'	=> esc_html__('Select sidebar position on search page, or disable it.', 'brookside'),
	            'section'		=> 'brookside_search_options',
	            'settings'		=> 'brookside_sidebar_pos_search',
	            'choices'		=> array(
	            	'sidebar-right' => get_template_directory_uri().'/framework/customizer/images/sr.png',
	            	'sidebar-left'	=> get_template_directory_uri().'/framework/customizer/images/sl.png',
	            	'none'	=> get_template_directory_uri().'/framework/customizer/images/none.png',
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_sticky_sidebar_search',
	    array(
	        'default'    =>  'sticky',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_sticky_sidebar_search',
	    array(
	        'section'   => 'brookside_search_options',
	        'label'     => esc_html__('Sidebar sticky','brookside'),
	        'description'     => esc_html__('Select sidebar sticky on scroll or not.','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'sticky' => esc_html__('Sticky', 'brookside'),
	        	'scrolled' => esc_html__( 'Scrolled', 'brookside' ),
	        )
	    )
	);
	/*******************************/
	/********************************/
	$wp_customize->add_section(
	    'brookside_archive_options',
	    array(
	        'title'     => esc_html__('Archive Category/Tag Page', 'brookside'),
	        'priority'  => 5,
	        'panel' => 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_archive_show_title',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_archive_show_title',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Hide category page title','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_archive_style',
	    array(
	        'default'    =>  'style_4',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_archive_style',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Archive page layout','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'style_1' => esc_html__('Grid', 'brookside'),
	        	'style_6' => esc_html__('Grid Gallery', 'brookside'),
	        	'style_2' => esc_html__( 'Featured', 'brookside' ),
	        	'style_3' => esc_html__( 'Featured even/odd', 'brookside' ),
	        	'style_4' => esc_html__( 'Masonry', 'brookside' ),
	        	'style_5' => esc_html__( 'Masonry 2', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_archive_post_count',
	    array(
	        'default'    =>  '8',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_archive_post_count',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Category page posts count','brookside'),
	        'description' => esc_html__('Enter posts count for category/tag page.','brookside'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_archive_columns',
	    array(
	        'default'    =>  'span6',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_archive_columns',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Layout columns count','brookside'),
	        'description'	=> esc_html__('Select columns count for "Grid", "Masonry" layouts', 'brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'span6' => esc_html__('Two columns', 'brookside'),
	        	'span4' => esc_html__( 'Three columns', 'brookside' ),
	        	'span3' => esc_html__( 'Four columns', 'brookside' ),
	        	'span2' => esc_html__( 'Six columns', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_archive_thumbnail_size',
	    array(
	        'default'    =>  'medium',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_archive_thumbnail_size',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Archive post humbnail size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $image_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_likes_archive',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_likes_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Show post likes count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_views_archive',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_views_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Show post views count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_comments_archive',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_comments_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Show post comments count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_date_archive',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_date_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Show post date label','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_read_time_archive',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_read_time_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Show estimate time to read post','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_pagination_archive',
	    array(
	        'default'    =>  'standard',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_pagination_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Archive Posts pagination type','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'standard' => esc_html__('Standard pagination', 'brookside'),
	        	'true' => esc_html__( 'Ajax Load More', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_archive_excerpt_count',
	    array(
	        'default'    =>  '15',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_archive_excerpt_count',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Category excerpt count','brookside'),
	        'description' => esc_html__('Enter excerpt count for category/tag page.','brookside'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_sidebar_pos_archive',
	    array(
	        'default'     => 'sidebar-right',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Control_Image_Select (
	        $wp_customize,
	        'brookside_sidebar_pos_archive',
	        array(
	            'label'      	=> esc_html__( 'Archive page sidebar', 'brookside' ),
	            'description'	=> esc_html__('Select sidebar position on archive page, or disable it.', 'brookside'),
	            'section'		=> 'brookside_archive_options',
	            'settings'		=> 'brookside_sidebar_pos_archive',
	            'choices'		=> array(
	            	'sidebar-right' => get_template_directory_uri().'/framework/customizer/images/sr.png',
	            	'sidebar-left'	=> get_template_directory_uri().'/framework/customizer/images/sl.png',
	            	'none'	=> get_template_directory_uri().'/framework/customizer/images/none.png',
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_sticky_sidebar_archive',
	    array(
	        'default'    =>  'sticky',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_sticky_sidebar_archive',
	    array(
	        'section'   => 'brookside_archive_options',
	        'label'     => esc_html__('Sidebar sticky','brookside'),
	        'description'     => esc_html__('Select sidebar sticky on scroll or not.','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'sticky' => esc_html__('Sticky', 'brookside'),
	        	'scrolled' => esc_html__( 'Scrolled', 'brookside' ),
	        )
	    )
	);
	/*******************************/
	$wp_customize->add_section(
	    'brookside_blog_options',
	    array(
	        'title'     => esc_html__('Blog', 'brookside'),
	        'priority'  => 4,
	        'panel' => 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_title_style',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_blog_title_style',
	        array(
	            'label'      	=> esc_html__( 'Blog page style', 'brookside' ),
	            'section'		=> 'brookside_blog_options',
	            'settings'		=> 'brookside_blog_title_style',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_style',
	    array(
	        'default'    =>  'style_4',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_blog_style',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Blog layout','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'style_1' => esc_html__('Grid', 'brookside'),
	        	'style_6' => esc_html__('Grid Gallery', 'brookside'),
	        	'style_2' => esc_html__( 'Featured', 'brookside' ),
	        	'style_3' => esc_html__( 'Featured even/odd', 'brookside' ),
	        	'style_4' => esc_html__( 'Masonry', 'brookside' ),
	        	'style_5' => esc_html__( 'Masonry 2', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_columns',
	    array(
	        'default'    =>  'span4',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_blog_columns',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Layout columns count','brookside'),
	        'description'	=> esc_html__('Select columns count for "Grid", "Masonry" layouts', 'brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'span6' => esc_html__('Two columns', 'brookside'),
	        	'span4' => esc_html__( 'Three columns', 'brookside' ),
	        	'span3' => esc_html__( 'Four columns', 'brookside' ),
	        	'span2' => esc_html__( 'Six columns', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_elements_align',
	    array(
	        'default'    =>  'textleft',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_blog_elements_align',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Select elements alignment','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'textleft' => esc_html__('Left', 'brookside'),
	        	'textcenter' => esc_html__( 'Center', 'brookside' ),
	        	'textright' => esc_html__( 'Right', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_thumbnail_size',
	    array(
	        'default'    =>  'brookside-extra-medium',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_blog_thumbnail_size',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Posts thumbnail size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $image_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_likes',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_likes',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post likes count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_views',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_views',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post views count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_comments',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_comments',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post comments count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_categories',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_categories',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post categories','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_date',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_date',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post date label','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_read_time',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_read_time',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show estimate time to read post','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_ignore_featured_posts',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_ignore_featured_posts',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Ignore featured posts?','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_ignore_sticky_posts',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_ignore_sticky_posts',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Ignore sticky posts?','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_post_pagination',
	    array(
	        'default'    =>  'standard',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_post_pagination',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Posts pagination type','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'standard' => esc_html__('Standard pagination', 'brookside'),
	        	'true' => esc_html__( 'Ajax Load More', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_sidebar_pos',
	    array(
	        'default'     => 'none',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Control_Image_Select (
	        $wp_customize,
	        'brookside_sidebar_pos',
	        array(
	            'label'      	=> esc_html__( 'Blog page sidebar', 'brookside' ),
	            'description'	=> esc_html__('Select sidebar position on blog page, or disable it.', 'brookside'),
	            'section'		=> 'brookside_blog_options',
	            'settings'		=> 'brookside_sidebar_pos',
	            'choices'		=> array(
	            	'sidebar-right' => get_template_directory_uri().'/framework/customizer/images/sr.png',
	            	'sidebar-left'	=> get_template_directory_uri().'/framework/customizer/images/sl.png',
	            	'none'	=> get_template_directory_uri().'/framework/customizer/images/none.png',
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_sticky_sidebar',
	    array(
	        'default'    =>  'sticky',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_sticky_sidebar',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Sidebar sticky','brookside'),
	        'description'     => esc_html__('Select sidebar sticky on scroll or not.','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'sticky' => esc_html__('Sticky', 'brookside'),
	        	'scrolled' => esc_html__( 'Scrolled', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_display_featured_img_preview',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_display_featured_img_preview',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Post format on preview','brookside'),
	        'description' => esc_html__('Check this if you need to display featured image on preview instead of post format (video, gallery, audio, etc.). It will overwrite option globally.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_excerpt_count',
	    array(
	        'default'    =>  '15',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_blog_excerpt_count',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Blog excerpt count','brookside'),
	        'description' => esc_html__('Enter excerpt count for blog page.','brookside'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_hero_slider',
	    array(
	        'default'    =>  'slider',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_hero_slider',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Blog Hero Section','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'slider' => esc_html__('Slider', 'brookside'),
	        	'disable' => esc_html__( 'Disable', 'brookside' )
	        )
	    )
	);
	
	$wp_customize->add_setting(
	    'brookside_home_hero_section_padtop',
	    array(
	        'default'    =>  '0',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_hero_section_padtop',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Hero section top padding','brookside'),
	        'type'      => 'number'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_hero_section_padright',
	    array(
	        'default'    =>  '50',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_hero_section_padright',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Hero section right padding','brookside'),
	        'type'      => 'number'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_hero_section_padbottom',
	    array(
	        'default'    =>  '0',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_hero_section_padbottom',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Hero section bottom padding','brookside'),
	        'type'      => 'number'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_hero_section_padleft',
	    array(
	        'default'    =>  '50',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_hero_section_padleft',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Hero section left padding','brookside'),
	        'type'      => 'number'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_post_slider_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_post_slider_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Blog slider settings', 'brookside' ),
	            'section'		=> 'brookside_blog_options',
	            'settings'		=> 'brookside_post_slider_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slides_count',
	    array(
	        'default'    =>  '3',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slides_count',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Blog page slider slides count','brookside'),
	        'description' => esc_html__('Enter slides count for home page slider.','brookside'),
	        'type'      => 'number'
	    )
	);
	$wp_customize->add_setting( 
		'brookside_home_slider_posts', 
		array(
	    	'default' => '',
	    	'transport'  =>  'refresh',
	    	'sanitize_callback' => 'brookside_sanitize_posts_select'
		) 
	);
	 
	$wp_customize->add_control(
	    new Brookside_Customize_Control_Multiple_Select(
	        $wp_customize,
	        'brookside_home_slider_posts',
	        array(
	            'settings' => 'brookside_home_slider_posts',
	            'label'    => esc_html__('Slider posts IDs','brookside'),
	            'description' => esc_html__('Select posts to show.','brookside'),
	            'section'  => 'brookside_blog_options', // Enter the name of your own section
	            'type'     => 'multiple-select', // The $type in our class
	            'choices'  => brookside_get_all_posts_pages() // Your choices
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_orderby',
	    array(
	        'default'    =>  'date',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_orderby',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Order items by:','brookside'),
	        'type'      => 'select',
	        'choices'	=> $orderby
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_slideshow',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_slideshow',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Slideshow','brookside'),
	        'description' => esc_html__('Check to enable autoplay.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_loop',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_loop',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Loop','brookside'),
	        'description' => esc_html__('Check to enable loop.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_dots',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_dots',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Slider pagination','brookside'),
	        'description' => esc_html__('Check to enable pagination.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_style',
	    array(
	        'default'    =>  'simple',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_style',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Slider layout','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'center' => esc_html__('Centered', 'brookside'),
	        	'simple' => esc_html__( 'Simple', 'brookside' ),
	        	'three_per_row' => esc_html__( 'Three per row', 'brookside' )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_width',
	    array(
	        'default'    =>  'fullwidth',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_width',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Slider width','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'fullwidth' => esc_html__('Fullwidth', 'brookside'),
	        	'container' => esc_html__( 'Container', 'brookside' )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_home_slider_overlay',
	    array(
	        'default'    =>  1,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_overlay',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Slider item overlay','brookside'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
	    'brookside_home_slider_height',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_home_slider_height',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Slider height','brookside'),
	        'description' => esc_html__('Enter slider height in (px)','brookside'),
	        'type'      => 'number'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_post_single_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_post_single_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Single post view', 'brookside' ),
	            'section'		=> 'brookside_blog_options',
	            'settings'		=> 'brookside_post_single_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_layout',
	    array(
	        'default'    =>  'wide',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_layout',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Single post layout','brookside'),
	        'description'     => esc_html__('Select your single post layout by default. Also, you can select "single post layout" for specific post.','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'default' => esc_html__('Standard', 'brookside'),
	        	'wide' => esc_html__( 'Wide', 'brookside' ),
	        	'fullwidth' => esc_html__( 'Fullwidth', 'brookside' ),
	        	'fullwidth-alt' => esc_html__( 'Fullscreen', 'brookside' ),
	        	'sideimage' => esc_html__( 'Side', 'brookside' )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_sidebar',
	    array(
	        'default'     => 'none',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Control_Image_Select (
	        $wp_customize,
	        'brookside_single_post_sidebar',
	        array(
	            'label'      	=> esc_html__( 'Single post sidebar', 'brookside' ),
	            'description'	=> esc_html__('Select sidebar position on single post view, or disable it.', 'brookside'),
	            'section'		=> 'brookside_blog_options',
	            'settings'		=> 'brookside_single_post_sidebar',
	            'choices'		=> array(
	            	'sidebar-right' => get_template_directory_uri().'/framework/customizer/images/sr.png',
	            	'sidebar-left'	=> get_template_directory_uri().'/framework/customizer/images/sl.png',
	            	'none'	=> get_template_directory_uri().'/framework/customizer/images/none.png',
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_title_block',
	    array(
	        'default'    =>  'above',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_title_block',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Select title block position','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'above' => esc_html__('Above featured image', 'brookside'),
	        	'under' => esc_html__( 'Under Featured image', 'brookside' ),
	        	'hide' => esc_html__( 'Hide', 'brookside' )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_meta_date',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_meta_date',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Display date in title block?','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_related',
	    array(
	        'default'    =>  'false',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_related',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Related posts block','brookside'),
	        'description'     => esc_html__('Select show or hide related posts.','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'true' => esc_html__('Show', 'brookside'),
	        	'false' => esc_html__( 'Hide', 'brookside' ),
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_sicky_sharebox',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_sicky_sharebox',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Sticky vertical sharebox','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_likes',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_likes',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post likes count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_views',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_views',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show post views count','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_read_time',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_read_time',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show estimate time to read post','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_meta_sharebox',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_meta_sharebox',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Show sharebox in meta','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_author_info',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_author_info',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Author info','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_post_navigation',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_post_navigation',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Posts navigation','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_single_disable_comments',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_single_disable_comments',
	    array(
	        'section'   => 'brookside_blog_options',
	        'label'     => esc_html__('Disable comments','brookside'),
	        'description'     => esc_html__('Check to disable comments on single post view','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	/*******************************/
	$wp_customize->add_section(
	    'brookside_header_options',
	    array(
	        'title'     => esc_html__('Header', 'brookside'),
	        'priority'  => 2,
	        'panel'		=> 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_variant',
	    array(
	        'default'     => 'header-version1',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new Brookside_Control_Image_Select (
	        $wp_customize,
	        'brookside_header_variant',
	        array(
	            'label'      	=> esc_html__( 'Header layout', 'brookside' ),
	            'description'	=> esc_html__('Select header layout.', 'brookside'),
	            'section'		=> 'brookside_header_options',
	            'settings'		=> 'brookside_header_variant',
	            'choices'		=> array(
	            	'header-version1'	=> get_template_directory_uri().'/framework/customizer/images/h1.png',
	            	'header-version2'	=> get_template_directory_uri().'/framework/customizer/images/h2.png',
	            	'header-version4'	=> get_template_directory_uri().'/framework/customizer/images/h4.png',
	            	'header-version5'	=> get_template_directory_uri().'/framework/customizer/images/h5.png',
	            	'header-version7'	=> get_template_directory_uri().'/framework/customizer/images/h7.png',
	            	'header-version6'	=> get_template_directory_uri().'/framework/customizer/images/h6.png',
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_style',
	    array(
	        'default'    =>  'header-light',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_header_style',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Header color style','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'header-light' => esc_html__('Header Light', 'brookside'),
	        	'header-dark' => esc_html__('Header Dark', 'brookside'),
	        	'header-light header-transparent' => esc_html__('Header Light Transparent', 'brookside'),
	        	'header-dark header-transparent' => esc_html__('Header Dark Transparent', 'brookside'),
	        )
	    )
	);
	$wp_customize->add_setting(
		'brookside_fixed_header', 
		array(
			'default' => true, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'brookside_fixed_header',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Fixed Header','brookside'),
	        'description' => esc_html__('Check to fix your header at the top of the page.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_grid',
	    array(
	        'default'    =>  'container header-fullwidth',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_header_grid',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Strech header','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'container' => esc_html__('Do not strech', 'brookside'),
	        	'container header-fullwidth' => esc_html__('Strech header', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_bottom_border_width',
	    array(
	        'default'    =>  '1',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_header_bottom_border_width',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Header bottom border width','brookside'),
	        'description' => esc_html__('Use this field to set border width. Do not set (px).', 'brookside'),
	        'type'      => 'text',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_media_logo',
	    array(
	        'default'      => '',
	        'transport'    => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_media_logo',
	        array(
	            'label'    => esc_html__('Logo Image','brookside'),
	            'settings' => 'brookside_media_logo',
	            'section'  => 'brookside_header_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_media_logo_width',
	    array(
	        'default'    =>  '75',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_media_logo_width',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Logo size','brookside'),
	        'description' => esc_html__('Use this field to set image width or for text font size. Do not set (px).', 'brookside'),
	        'type'      => 'text',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_logo_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_logo_font_family',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_logo_color',
	    array(
	        'default'     => '',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_logo__color',
	        array(
	            'label'      => esc_html__( 'Logo text color', 'brookside' ),
	            'section'    => 'brookside_header_options',
	            'settings'   => 'brookside_logo_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_logo_font_weight',
	    array(
	        'default'     => '800',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_logo_font_weight',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Logo font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'brookside_logo_transform',
	    array(
	        'default'    =>  'lowercase',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_logo_transform',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Logo text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside'),
	        	'lowercase' => esc_html__('Lowercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_logo_title_letter_spacing',
	    array(
	        'default'     => '1.5',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_logo_title_letter_spacing',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Logo title letter-spacing','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 10, 'step'  => 0.1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_mobile_logo_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_mobile_logo_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Mobile logo', 'brookside' ),
	            'section'		=> 'brookside_header_options',
	            'settings'		=> 'brookside_mobile_logo_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_media_logo_mobile',
	    array(
	        'default'      => '',
	        'transport'    => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_media_logo_mobile',
	        array(
	            'label'    => esc_html__('Mobile Logo Image','brookside'),
	            'settings' => 'brookside_media_logo_mobile',
	            'section'  => 'brookside_header_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_media_logo_mobile_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_media_logo_mobile_width',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Mobile Logo size','brookside'),
	        'description' => esc_html__('Use this field to set image width or for text font size. Do not set (px).', 'brookside'),
	        'type'      => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'brookside_nav_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_nav_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Navigation Settings', 'brookside' ),
	            'section'		=> 'brookside_header_options',
	            'settings'		=> 'brookside_nav_settings_title',
	        )
	    )
	);
	$font_sizes = array();
	$font_sizes_px_none = array();
	for ($i = 9; $i <= 50; $i++){ 
		$font_sizes[$i.'px'] = $i.'px';
		$font_sizes_px_none[$i] = $i.'px';
	}
    $wp_customize->add_setting(
	    'brookside_menu_font_size',
	    array(
	        'default'     => '12px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_menu_font_size',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	
	$wp_customize->add_setting(
	    'brookside_menu_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_menu_font_family',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_menu_font_weight',
	    array(
	        'default'     => '700',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_menu_font_weight',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'brookside_menu_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_menu_transform',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => esc_html__('Menu text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_menu_item_padding',
	    array(
	        'default'    =>  '42',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_menu_item_padding',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => __('Space between items','brookside'),
	        'description' => __('Space between menu items.','brookside'),
	        'type'      => 'range',
	        'input_attrs' => array( 'min' => 10, 'max' => 80, 'step'  => 2 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_hidden_navigation_bg',
	    array(
	        'default'      => '',
	        'transport'    => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_hidden_navigation_bg',
	        array(
	            'label'    => esc_html__('Hidden navigation Background Image','brookside'),
	            'settings' => 'brookside_hidden_navigation_bg',
	            'section'  => 'brookside_header_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_elements_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_header_elements_title',
	        array(
	            'label'      	=> esc_html__( 'Header elements', 'brookside' ),
	            'section'		=> 'brookside_header_options',
	            'settings'		=> 'brookside_header_elements_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_hidden_nav',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_header_hidden_nav',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => __('Hidden navigation button','brookside'),
	        'description' => __('Check to enable hidden navigation button in header.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_header_search_button',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_header_search_button',
	    array(
	        'section'   => 'brookside_header_options',
	        'label'     => __('Search button','brookside'),
	        'description' => __('Check to enable search button in header.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	if(function_exists('brookside_get_social_links')) {
		$wp_customize->add_setting(
		    'brookside_header_socials',
		    array(
		        'default'    =>  true,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_header_socials',
		    array(
		        'section'   => 'brookside_header_options',
		        'label'     => esc_html__('Socials','brookside'),
		        'description' => esc_html__('Check to enable socials in header.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
	}
	if( class_exists('WooCommerce')){
		$wp_customize->add_setting(
		    'brookside_header_shopping_cart',
		    array(
		        'default'    =>  false,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_header_shopping_cart',
		    array(
		        'section'   => 'brookside_header_options',
		        'label'     => __('Shopping cart icon','brookside'),
		        'description' => __('Check to enable shopping cart icon.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
	}
	$wp_customize->add_section(
	    'brookside_footer_options',
	    array(
	        'title'     => esc_html__('Footer', 'brookside'),
	        'priority'  => 3,
	        'panel'		=> 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_layout',
	    array(
	        'default'     => 'widgetized',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_footer_layout',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer layout','brookside'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'widgetized' => esc_html__('Widgetized','brookside'),
	        	'simple' => esc_html__('Simple','brookside'),
	        	'disable' => esc_html__('Disable footer','brookside')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'brookside_footer_bg_image',
	    array(
	        'default'      => '',
	        'transport'    => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_footer_bg_image',
	        array(
	            'label'    => esc_html__('Footer Background Image','brookside'),
	            'settings' => 'brookside_footer_bg_image',
	            'section'  => 'brookside_footer_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_bg_size',
	    array(
	        'default'    =>  'auto',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_bg_size',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Background size','brookside'),
	        'type'      => 'radio',
	        'choices'	=> array(
	        	'auto' => esc_html__('Auto', 'brookside'),
	        	'cover' => esc_html__('Cover', 'brookside'),
	        	'contain' => esc_html__('Contain', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_bg_position',
	    array(
	        'default'    =>  'center bottom',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_bg_position',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Background position','brookside'),
	        'type'      => 'radio',
	        'choices'	=> array(
	        	'center top' => esc_html__('Center Top', 'brookside'),
	        	'center center' => esc_html__('Center Center', 'brookside'),
	        	'center bottom' => esc_html__('Center Bottom', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_bg_color',
	    array(
	        'default'     => '#fff',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_footer_bg_color',
	        array(
	            'label'      => esc_html__( 'Footer background color', 'brookside' ),
	            'section'    => 'brookside_footer_options',
	            'settings'   => 'brookside_footer_bg_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_top_padding',
	    array(
	        'default'    =>  '45',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_top_padding',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer top padding','brookside'),
	        'description' => esc_html__('Do not set (px).', 'brookside'),
	        'type'      => 'text',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_bottom_padding',
	    array(
	        'default'    =>  '90',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_bottom_padding',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer bottom padding','brookside'),
	        'description' => esc_html__('Do not set (px).', 'brookside'),
	        'type'      => 'text',
	    )
	);

	$wp_customize->add_setting(
	    'brookside_footer_map_block',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_footer_map_block',
	        array(
	            'label'      	=> esc_html__( 'Footer Map Section', 'brookside' ),
	            'section'		=> 'brookside_footer_options',
	            'settings'		=> 'brookside_footer_map_block',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_map',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_map',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Show map?','brookside'),
	        'description' => esc_html__('Check to enable map in the footer.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_map_markers',
	    array(
	        'default'    		=>  "37%:70%|Los Angeles|https://brookside.artstudioworks.net/tag/los-angeles",
	        'transport'  		=>  'refresh',
	        'sanitize_callback' => 'sanitize_textarea_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_map_markers',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Add Markers','brookside'),
	        'description' => esc_html__('Add map marker of location. Every marker location start from new line. Separate position and description and URL "|"; Position X and Y by ":", e.g. 30%:50%|Los Angeles|https://brookside.artstudioworks.net/tag/los-angeles','brookside'),
	        'type'      => 'textarea',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_map_marker_image',
	    array(
	        'default'      => get_template_directory_uri().'/images/map-marker.png',
	        'transport'    => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_footer_map_marker_image',
	        array(
	            'label'    => esc_html__('Footer Map marker image','brookside'),
	            'settings' => 'brookside_footer_map_marker_image',
	            'section'  => 'brookside_footer_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_copy_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_footer_copy_title',
	        array(
	            'label'      	=> esc_html__( 'Copyright Section settings', 'brookside' ),
	            'section'		=> 'brookside_footer_options',
	            'settings'		=> 'brookside_footer_copy_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	'brookside_footer_copyright_border',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_copyright_border',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer copyright section border','brookside'),
	        'description' => esc_html__('Check to enable border for copyright footer section.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_copyright',
	    array(
	        'default'    		=>  '2020 © All rights reserved',
	        'transport'  		=>  'refresh',
	        'sanitize_callback' => 'brookside_sanitize_text_html',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_copyright',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Copyright text','brookside'),
	        'description' => esc_html__('Add copyright text to footer area.','brookside'),
	        'type'      => 'textarea',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_copyright_font_size',
	    array(
	        'default'     => '15px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_footer_copyright_font_size',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Copyright text font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_copyright_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_footer_copyright_font_family',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Copyright text font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_copyright_color',
	    array(
	        'default'     => '#201f22',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_footer_copyright_color',
	        array(
	            'label'      => esc_html__( 'Copyright text color', 'brookside' ),
	            'section'    => 'brookside_footer_options',
	            'settings'   => 'brookside_footer_copyright_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	'brookside_footer_logo',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_logo',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer logo','brookside'),
	        'description' => esc_html__('Check to enable logo in copyright footer section.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_logo_img',
	    array(
	        'default'      => '',
	        'transport'    => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_footer_logo_img',
	        array(
	            'label'    => esc_html__('Footer Logo Image','brookside'),
	            'settings' => 'brookside_footer_logo_img',
	            'section'  => 'brookside_footer_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_logo_size',
	    array(
	        'default'     => '18',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_footer_logo_size',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Logo size','brookside'),
	        'description' => esc_html__('Logo width for image or font size for text logo. Do not set (px)','brookside'),
	        'type'      => 'text',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_logo_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_footer_logo_font_family',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer Logo font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_logo_color',
	    array(
	        'default'     => '#151516',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
	 $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_footer_logo_color',
	        array(
	            'label'      => esc_html__( 'Footer text logo color', 'brookside' ),
	            'section'    => 'brookside_footer_options',
	            'settings'   => 'brookside_footer_logo_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_logo_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_footer_logo_transform',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('Footer logo text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_footer_logo_font_weight',
	    array(
	        'default'     => '400',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_footer_logo_font_weight',
	    array(
	        'section'   => 'brookside_footer_options',
	        'label'     => esc_html__('font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	/*--------------------------------------------------*/
	$wp_customize->add_section(
	    'brookside_headings_options',
	    array(
	        'title'     => esc_html__('Headings', 'brookside'),
	        'priority'  => 6,
	        'panel'		=> 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_blog_head_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_blog_head_title',
	        array(
	            'label'      	=> esc_html__( 'Posts headings', 'brookside' ),
	            'section'		=> 'brookside_headings_options',
	            'settings'		=> 'brookside_blog_head_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_posts_headings_font_size',
	    array(
	        'default'     => '39',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_posts_headings_font_size',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes_px_none
	    )
	);
	$wp_customize->add_setting(
	    'brookside_posts_headings_font_weight',
	    array(
	        'default'     => '800',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_posts_headings_font_weight',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'brookside_posts_headings_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_posts_headings_font_family',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_posts_headings_letter_spacing',
	    array(
	        'default'     => '0',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_posts_headings_letter_spacing',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('Post title letter-spacing','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 10, 'step'  => 0.1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_post_headings_transform',
	    array(
	        'default'    =>  'capitalize',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_post_headings_transform',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('Title text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside'),
	        	'lowercase' => esc_html__('Lowercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_posts_headings_item_color',
	    array(
	        'default'     => '#1c1d1f',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_posts_headings_item_color',
	        array(
	            'label'      => esc_html__( 'items color (initial)', 'brookside' ),
	            'section'    => 'brookside_headings_options',
	            'settings'   => 'brookside_posts_headings_item_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_posts_headings_item_color_active',
	    array(
	        'default'     => '#ba5c23',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_posts_headings_item_color_active',
	        array(
	            'label'      => esc_html__( 'items color (hover)', 'brookside' ),
	            'section'    => 'brookside_headings_options',
	            'settings'   => 'brookside_posts_headings_item_color_active'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_head_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_widgets_head_title',
	        array(
	            'label'      	=> esc_html__( 'Widgets headings', 'brookside' ),
	            'section'		=> 'brookside_headings_options',
	            'settings'		=> 'brookside_widgets_head_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_font_size',
	    array(
	        'default'     => '11px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_widgets_headings_font_size',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_font_weight',
	    array(
	        'default'     => '400',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_widgets_headings_font_weight',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_widgets_headings_font_family',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_letter_spacing',
	    array(
	        'default'     => '1',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_widgets_headings_letter_spacing',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('Widget title letter-spacing','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 10, 'step'  => 0.1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_widgets_headings_transform',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('Widget title text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_item_color',
	    array(
	        'default'     => '#1c1d1f',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_widgets_headings_item_color',
	        array(
	            'label'      => esc_html__( 'color', 'brookside' ),
	            'section'    => 'brookside_headings_options',
	            'settings'   => 'brookside_widgets_headings_item_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_widgets_headings_separator',
	    array(
	        'default'    =>  true,
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_widgets_headings_separator',
	    array(
	        'section'   => 'brookside_headings_options',
	        'label'     => esc_html__('Widget heading separator','brookside'),
	        'description' => esc_html__('Check to enable heading separator line.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_section(
		    'brookside_subscribe_options',
		    array(
		        'title'     => esc_html__('Subscribe popup', 'brookside'),
		        'description' => esc_html__('Use options below to customize subscribe popup.','brookside'),
		        'priority'  => 7,
		        'panel'		=> 'brookside_theme_options'
		    )
		);
	$wp_customize->add_setting(
	    'brookside_subscribe_enable',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_subscribe_enable',
	    array(
	        'section'   => 'brookside_subscribe_options',
	        'label'     => esc_html__('Subscribe button','brookside'),
	        'description' => esc_html__('Check to show subscribe button in the header.','brookside'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_subscribe_popup_bg',
	    array(
	        'default'      => '',
	        'transport'    => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'brookside_subscribe_popup_bg',
	        array(
	            'label'    => esc_html__('Subscribe popup background image.','brookside'),
	            'settings' => 'brookside_subscribe_popup_bg',
	            'section'  => 'brookside_subscribe_options'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_subscribe_popup_bg_color',
	    array(
	        'default'     => '#ffffff',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_subscribe_popup_bg_color',
	        array(
	            'label'      => esc_html__( 'Subscribe popup background color.', 'brookside' ),
	            'section'    => 'brookside_subscribe_options',
	            'settings'   => 'brookside_subscribe_popup_bg_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_subscribe_popup_title',
	    array(
	        'default'    => esc_html__('Subscribe', 'brookside'),
	        'transport'  =>  'refresh',
        	'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_subscribe_popup_title',
	    array(
	        'section'   => 'brookside_subscribe_options',
	        'label'     => esc_html__('Your popup subscribe title','brookside'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_subscribe_popup_subtitle',
	    array(
	        'default'    => esc_html__('Get updates on my travels', 'brookside'),
	        'transport'  =>  'refresh',
        	'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_subscribe_popup_subtitle',
	    array(
	        'section'   => 'brookside_subscribe_options',
	        'label'     => esc_html__('Your popup subscribe subtitle','brookside'),
	        'type'      => 'text'
	    )
	);
	if(function_exists('brookside_get_social_links')) {
		$wp_customize->add_section(
		    'brookside_socials_options',
		    array(
		        'title'     => esc_html__('Socials', 'brookside'),
		        'description' => esc_html__('Add your social links, otherwise leave blank if you need not some links.','brookside'),
		        'priority'  => 7,
		        'panel'		=> 'brookside_theme_options'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_sharing_facebook',
		    array(
		        'default'    =>  true,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_sharing_facebook',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show Facebook in share box.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_sharing_twitter',
		    array(
		        'default'    =>  true,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_sharing_twitter',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show Twitter in share box.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_sharing_pinterest',
		    array(
		        'default'    =>  true,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_sharing_pinterest',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show Pinterest in share box.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_sharing_linkedin',
		    array(
		        'default'    =>  false,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_sharing_linkedin',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show Linkedin in share box.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_sharing_googleplus',
		    array(
		        'default'    =>  false,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_sharing_googleplus',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show Google+ in share box.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_sharing_email',
		    array(
		        'default'    =>  false,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_sharing_email',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show Email in share box.','brookside'),
		        'type'      => 'checkbox'
		    )
		);
	
		$socials = array('vkontakte', 'facebook', 'twitter', 'instagram', 'pinterest', 'google_plus', 'forrst', 'dribbble', 'flickr', 'linkedin', 'digg', 'vimeo', 'yahoo', 'tumblr', 'youtube', 'deviantart', 'behance', 'paypal', 'delicious');
		foreach ($socials as $social) {
			$def_value = '';
			if(in_array($social, array('facebook', 'twitter', 'instagram'))){
				$def_value = '#';
			}
			$wp_customize->add_setting(
			    'brookside_social_'.$social,
			    array(
			        'default'    =>  $def_value,
			        'transport'  =>  'refresh',
		        	'sanitize_callback' => 'sanitize_text_field',
			    )
			);
			$wp_customize->add_control(
			    'brookside_social_'.$social,
			    array(
			        'section'   => 'brookside_socials_options',
			        'label'     => esc_html__(ucfirst(str_replace('_', ' ', $social)).' url','brookside'),
			        'type'      => 'text'
			    )
			);
		}
		$wp_customize->add_setting(
		    'brookside_social_skype',
		    array(
		        'default'    =>  '',
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_social_skype',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Skype account','brookside'),
		        'type'      => 'text'
		    )
		);
		$wp_customize->add_setting(
		    'brookside_social_rss',
		    array(
		        'default'    =>  false,
		        'transport'  =>  'refresh',
		        'sanitize_callback' => 'sanitize_text_field',
		    )
		);
		$wp_customize->add_control(
		    'brookside_social_rss',
		    array(
		        'section'   => 'brookside_socials_options',
		        'label'     => esc_html__('Show rss','brookside'),
		        'type'      => 'checkbox'
		    )
		);
	}
	$wp_customize->add_section(
	    'brookside_styling_options',
	    array(
	        'title'     => esc_html__('Styling', 'brookside'),
	        'priority'  => 8,
	        'panel'		=> 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
	    'brookside_accent_color',
	    array(
	        'default'     => '#ba5c23',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_accent_color',
	        array(
	            'label'      => esc_html__( 'Theme main color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_accent_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_font_size',
	    array(
	        'default'     => '13px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_body_font_size',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Body font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_line_height',
	    array(
	        'default'     => '28px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_body_line_height',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Body text line height','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_font_family',
	    array(
	        'default'     => 'Open Sans',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_body_font_family',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Body font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_color',
	    array(
	        'default'     => '#444b4d',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_body_color',
	        array(
	            'label'      => esc_html__( 'Body text color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_body_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_links_color',
	    array(
	        'default'     => '#ba5c23',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_top_padding',
	    array(
	        'default'     => '0',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_body_top_padding',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Body top padding','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 150, 'step'  => 1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_right_padding',
	    array(
	        'default'     => '0',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_body_right_padding',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Body right padding','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 150, 'step'  => 1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_bottom_padding',
	    array(
	        'default'     => '0',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_body_bottom_padding',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Body bottom padding','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 150, 'step'  => 1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_body_left_padding',
	    array(
	        'default'     => '0',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_body_left_padding',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Body left padding','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 150, 'step'  => 1 )
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_links_color',
	        array(
	            'label'      => esc_html__( 'Links color (initial)', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_links_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_links_color_hover',
	    array(
	        'default'     => '#1c1d1f',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_links_color_hover',
	        array(
	            'label'      => esc_html__( 'Links color (hover)', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_links_color_hover'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_title_style',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_meta_title_style',
	        array(
	            'label'      	=> esc_html__( 'Meta Categories styling', 'brookside' ),
	            'section'		=> 'brookside_styling_options',
	            'settings'		=> 'brookside_meta_title_style',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_font_size',
	    array(
	        'default'     => '12px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_meta_categories_font_size',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta categories font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_meta_categories_font_family',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta categories font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_meta_categories_transform',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta ctegories text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside'),
	        	'lowercase' => esc_html__('Lowercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_font_weight',
	    array(
	        'default'     => '500',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_meta_categories_font_weight',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta categories font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_letter_spacing',
	    array(
	        'default'     => '1',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_meta_categories_letter_spacing',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Meta categories letter spacing','brookside'),
	        'type'      => 'range',
	        'input_attrs' => array( 'min' => 0, 'max' => 5, 'step'  => 0.1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_color',
	    array(
	        'default'     => '#ba5c23',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_meta_categories_color',
	        array(
	            'label'      => esc_html__( 'Meta categories color initial', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_meta_categories_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_categories_color_hover',
	    array(
	        'default'     => '#ccc',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_meta_categories_color_hover',
	        array(
	            'label'      => esc_html__( 'Meta categories color hover', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_meta_categories_color_hover'
	        )
	    )
	);
    $wp_customize->add_setting(
	    'brookside_meta_info_title_style',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_meta_info_title_style',
	        array(
	            'label'      	=> esc_html__( 'Meta Info (likes, views, etc.) styling', 'brookside' ),
	            'section'		=> 'brookside_styling_options',
	            'settings'		=> 'brookside_meta_info_title_style',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_info_font_size',
	    array(
	        'default'     => '11px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_meta_info_font_size',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_info_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_meta_info_font_family',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta info font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_info_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_meta_info_transform',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Meta info text transform','brookside'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'brookside'),
	        	'capitalize' => esc_html__('Capitalize', 'brookside'),
	        	'uppercase' => esc_html__('Uppercase', 'brookside')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_meta_info_color',
	    array(
	        'default'     => '#888c8e',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_meta_info_color',
	        array(
	            'label'      => esc_html__( 'Meta info color initial', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_meta_info_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_buttons_title_style',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new Brookside_Customize_Control_Title (
	        $wp_customize,
	        'brookside_buttons_title_style',
	        array(
	            'label'      	=> esc_html__( 'Buttons styling', 'brookside' ),
	            'section'		=> 'brookside_styling_options',
	            'settings'		=> 'brookside_buttons_title_style',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_font_size',
	    array(
	        'default'     => '12px',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_button_font_size',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Button font size','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_font_family',
	    array(
	        'default'     => 'Montserrat',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_button_font_family',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Button font family','brookside'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_letter_spacing',
	    array(
	        'default'     => '1',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_button_letter_spacing',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Default button letter spacing','brookside'),
	        'type'      => 'range',
	        'input_attrs' => array( 'min' => 0, 'max' => 5, 'step'  => 0.1 )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_font_weight',
	    array(
	        'default'     => '500',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'brookside_button_font_weight',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => esc_html__('Default button font weight','brookside'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_default_bg_color',
	    array(
	        'default'     => '#1d1f20',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_button_default_bg_color',
	        array(
	            'label'      => esc_html__( 'Button default background color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_button_default_bg_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_default_text_color',
	    array(
	        'default'     => '#ffffff',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_button_default_text_color',
	        array(
	            'label'      => esc_html__( 'Button default text color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_button_default_text_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_default_border_color',
	    array(
	        'default'     => '#1d1f20',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_button_default_border_color',
	        array(
	            'label'      => esc_html__( 'Button default border color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_button_default_border_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'brookside_button_border_radius',
	    array(
	        'default'     => '0',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_button_border_radius',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Default button border radius','brookside'),
	        'type'      => 'range',
	        'input_attrs' => array( 'min' => 0, 'max' => 50, 'step'  => 1 )
	    )
	);

	$wp_customize->add_setting(
	    'brookside_button_vertical_padding',
	    array(
	        'default'     => '19',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_button_vertical_padding',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Default button top/bottom padding','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step'  => 1 )
	    )
	);

	$wp_customize->add_setting(
	    'brookside_button_horizontal_padding',
	    array(
	        'default'     => '41',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'brookside_button_horizontal_padding',
	    array(
	        'section'   => 'brookside_styling_options',
	        'label'     => __('Default button left/right padding','brookside'),
	        'type'      => 'number',
	        'input_attrs' => array( 'min' => 0, 'max' => 64, 'step'  => 1 )
	    )
	);

	$wp_customize->add_setting(
	    'brookside_button_loadmore_bg_color',
	    array(
	        'default'     => '#141516',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_button_loadmore_bg_color',
	        array(
	            'label'      => esc_html__( 'Button loadmore background color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_button_loadmore_bg_color'
	        )
	    )
	);
    $wp_customize->add_setting(
	    'brookside_button_loadmore_border_color',
	    array(
	        'default'     => '#141516',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_button_loadmore_border_color',
	        array(
	            'label'      => esc_html__( 'Button loadmore border color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_button_loadmore_border_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'brookside_button_loadmore_text_color',
	    array(
	        'default'     => '#fff',
	        'transport'   => 'postMessage',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);

    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'brookside_button_loadmore_text_color',
	        array(
	            'label'      => esc_html__( 'Button loadmore text color', 'brookside' ),
	            'section'    => 'brookside_styling_options',
	            'settings'   => 'brookside_button_loadmore_text_color'
	        )
	    )
	);

	$wp_customize->add_section(
	    'brookside_google_fonts_options',
	    array(
	        'title'     => esc_html__('Google fonts ext.', 'brookside'),
	        'description' => esc_html__('Select google fonts extensions to load. It allows to reduce load speed.','brookside'),
	        'priority'  => 9,
	        'panel'		=> 'brookside_theme_options'
	    )
	);
	$wp_customize->add_setting(
        'brookside_google_font_subset',
        array(
            'default'           => 'latin',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        new Brookside_Customize_Control_Checkbox_Multiple(
            $wp_customize,
            'brookside_google_font_subset',
            array(
                'section' => 'brookside_google_fonts_options',
                'label'   => esc_html__( 'Languages subset', 'brookside' ),
                'choices' => array(
                	'latin' => esc_html__( 'Latin', 'brookside' ),
                    'cyrillic' => esc_html__( 'Cyrillic', 'brookside' ),
                    'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'brookside' ),
                    'greek' => esc_html__( 'Greek', 'brookside' ),
                    'greek-ext' => esc_html__( 'Greek Extended', 'brookside' ),
                    'latin-ext' => esc_html__( 'Latin Extended', 'brookside' ),
                    'vietnamese' => esc_html__( 'Vietnamese', 'brookside' ),
                )
            )
        )
    );
    $google_fonts = brookside_get_used_google_fonts();
    foreach ( $google_fonts as $font ) {
    	$font_l = strtolower(str_replace(' ', '-', $font));
    	$wp_customize->add_setting(
	        'brookside_google_font_'.$font_l,
	        array(
	            'default'           => '400',
	            'sanitize_callback' => 'sanitize_text_field'
	        )
	    );
	    $wp_customize->add_control(
	        new Brookside_Customize_Control_Checkbox_Multiple(
	            $wp_customize,
	            'brookside_google_font_'.$font_l,
	            array(
	                'section' => 'brookside_google_fonts_options',
	                'label'   => $font,
	                'choices' => brookside_get_google_font_styles()
	            )
	        )
	    );
    }
}
add_action( 'customize_register', 'brookside_register_theme_customizer', 110 );
function brookside_sanitize_multiple_checkbox( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}
/* Register Customizer Scripts */
add_action( 'customize_controls_enqueue_scripts', 'brookside_share_customize_register_scripts', 0 );
/**
 * Register Scripts
 * so we can easily load this scripts multiple times when needed (?)
 */
function brookside_share_customize_register_scripts(){
	/* CSS */
	wp_register_style( 'css-for-customize', get_template_directory_uri() . '/framework/customizer/css/customizer-control.css' );
	/* JS */
	wp_register_script( 'js-for-customize', get_template_directory_uri() . '/framework/customizer/js/customizer-control.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );
}

add_action( 'customize_preview_init', 'brookside_customizer_live_preview' );
function brookside_customizer_live_preview() {
     wp_enqueue_script(
        'asw-theme-customizer',
        get_template_directory_uri() . '/framework/customizer/js/theme-customizer.js',
        array( 'jquery', 'customize-preview' ),
        '1.0',
        true
    );
}
function brookside_get_used_google_fonts(){
	$googlefonts = array_unique(
		array(
			get_theme_mod('brookside_menu_font_family', 'Montserrat'),
			get_theme_mod('brookside_logo_font_family', 'Montserrat'),
			get_theme_mod('brookside_posts_headings_font_family', 'Montserrat'),
			get_theme_mod('brookside_widgets_headings_font_family', 'Montserrat'),
			get_theme_mod('brookside_body_font_family', 'Open Sans'),
			get_theme_mod('brookside_button_font_family', 'Montserrat'),
			get_theme_mod('brookside_footer_copyright_font_family', 'Montserrat'),
			get_theme_mod('brookside_meta_categories_font_family', 'Dancing Script'),
			get_theme_mod('brookside_footer_logo_font_family', 'Montserrat'),
		)
	);
	return $googlefonts;
}
function brookside_get_google_font_styles(){
	$google_style = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
	$google_style = explode(',', $google_style);
	return array_combine($google_style, $google_style);
}
if (!function_exists('brookside_google_fonts')){
	add_action( 'wp_enqueue_scripts', 'brookside_google_fonts' );
	add_action( 'enqueue_block_editor_assets', 'brookside_google_fonts' );
	function brookside_google_fonts() {
		$default = array(
				'Arial',
				'Verdana',
				'Trebuchet',
				'Georgia, sans-serif',
				'Times New Roman, sans-serif',
				'Tahoma',
				'Palatino',
				'Helvetica, sans-serif'
		);

		$googlefonts = brookside_get_used_google_fonts();	
		$customfont = '';
		$googlefonts = array_unique($googlefonts);
		$google_style = ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
		$fonts_set = '';
		$subset = get_theme_mod('brookside_google_font_subset');
		$subset_str = '';
		if(is_array($subset)){
			$subset = array_unique($subset);
			if(!empty($subset)){
				$subset_str = implode(',', $subset);
			}
		} else {
			$subset_str = $subset;
		}
		if($subset_str == '' || $subset_str == 'latin'){
			$subset_str = '';
		} else {
			$subset_str = '&amp;subset='.$subset_str;
		}
		$count = 1;	
		foreach($googlefonts as $getfonts) {
			if(!in_array($getfonts, $default)) {
				$font_l = strtolower(str_replace(' ', '-', $getfonts));
				$google_style_t = get_theme_mod('brookside_google_font_'.$font_l);
				if(is_array($google_style_t)){
					$google_style_t = array_unique($google_style_t);
					if(!empty($google_style_t)){
						$google_style = ':'.implode(',', $google_style_t);
					}
				} else {
					if($google_style_t != ''){
						$google_style = ':'.$google_style_t;
					}
				}
				$customfont = str_replace(' ', '+', $getfonts).$google_style;
				if($customfont != ''){
					$font_name = strtolower(str_replace(' ', '-', $getfonts));
					if($count == 1) {
						$divider = '';
					} else {
						$divider = '|';
					}
				    $fonts_set .= $divider.$customfont;
				}
				$count++;
			}
		}
		if( $fonts_set != '' ){
			wp_enqueue_style( 'google-fonts-brookside', esc_url("//fonts.googleapis.com/css?family=".$fonts_set.$subset_str), array(), NULL, 'all' );
		}
	}
}