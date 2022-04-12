<php

/*USER META IN FILTRI */

/*through this function i can check on the frontend which meta are related to the logged in user. I used this to check if paid memberhship pro works. */
add_action( 'wp_ajax_app_user_pref', 'app_user_pref');
function app_user_pref() {

        try {
            $user = wp_get_current_user();
           $user_id = $user->ID;
$meta = get_user_meta( $user_id);
// Filter out empty meta data
$meta = array_filter( array_map( function( $a ) {
    return $a[0];
}, $meta ) );
			print_r( $meta );
            die();
        } catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    
}


/*this is the paid membership pro function to generate new custom fields in the checkout page, and see them in user profile page.*/

// We have to put everything in a function called on init, so we are sure Register Helper is loaded.
function my_pmprorh_init() {
	// Don't break if Register Helper is not loaded.
	if ( ! function_exists( 'pmprorh_add_registration_field' ) ) {
		return false;
	}

	// Define the fields.
	$fields = array();
	$fields[] = new PMProRH_Field(
		'azienda',							// input name, will also be used as meta key
		'text',								// type of field
		array(
			'label'		=> 'Azienda',		// custom field label
			'size'		=> 40,				// input size
			'class'		=> 'azienda',		// custom class
			'profile'	=> true,			// show in user profile
			'required'	=> true,			// make this field required
			
		)
	);

	$fields[] = new PMProRH_Field(
		'settore',							// input name, will also be used as meta key
		'checkbox_grouped',							// type of field
		array(
			'options' => array(				// <option> elements for select field
				''		=> '',				// blank option - cannot be selected if this field is required
				'agricoltura'	=> 'Agricoltura',		// <option value="agricoltura">Agricoltura</option>
				'artigianato'	=> 'Artigianato',		
				'commercio'	=> 'Commercio',	
				'cultura'	=> 'Cultura',		
				'industria'	=> 'Industria',		
				'no-profit'	=> 'No Profit',	
				'pubblico'	=> 'Pubblico',	
				'servizi'	=> 'Servizi',	
				'turismo'	=> 'Turismo',
			),
			'label'		=> 'Settore di interesse',		// custom field label
			'size'		=> 40,				// input size
			'class'		=> 'selectm',		// custom class
			'profile'	=> true,			// show in user profile
			'required'	=> true,			// make this field required
			
			
		),
			
		);
		
		$fields[] = new PMProRH_Field(
		'destinatario_agevolazione',							// input name, will also be used as meta key
		'checkbox_grouped',							// type of field
		array(
			'options' => array(				// <option> elements for select field
				''		=> '',				// blank option - cannot be selected if this field is required
				'grande-impresa'	=> 'Grande Impresa',		// <option value="grande_impresa">Grande Impresa</option>
				'pmi-micro-imprese'	=> 'PMI e Micro Imprese',		
				'persona-fisica'	=> 'Persona Fisica',	
				'libero-professionista'	=> 'Libero Professionista',		
				'ass-con-onlus' => 'Associazione, Consorzio, Onlus'
			),
			'label'		=> 'Destinatario Agevolazione',		// custom field label
			'size'		=> 40,				// input size
			'class'		=> 'selectm',		// custom class
			'profile'	=> true,			// show in user profile
			'required'	=> true,			// make this field required
			
			
		),
			
			);
			
			$fields[] = new PMProRH_Field(
		'area-geografica',							// input name, will also be used as meta key
		'checkbox_grouped',							// type of field
		array(
			'options' => array(				// <option> elements for select field
				''		=> '',				// blank option - cannot be selected if this field is required
				'abruzzo'	=> 'Abruzzo',		// <option value="abruzzo">Abruzzo</option>
				'basilicata'	=> 'Basilicata',		
				'calabria'	=> 'Calabria',	
				'campania'	=> 'Campania',		
				'emilia-romagna'	=> 'Emilia Romagna',		
				'friuli-venezia-giulia'	=> 'Friuli Venezia Giulia',		
				'lazio'	=> 'Lazio',	
				'liguria'	=> 'Liguria',		
				'lombardia'	=> 'Lombardia',		
				'marche'	=> 'Marche',		
				'molise'	=> 'Molise',		
				'piemonte'	=> 'Piemonte',	
				'puglia'	=> 'Puglia',		
				'sardegna'	=> 'Sardegna',		
				'sicilia'	=> 'Sicilia',		
				'toscana'	=> 'Toscana',		
				'trentino-alto-adige'	=> 'Trentino Alto Adige',	
				'umbria'	=> 'Umbria',		
				'valle-d-aosta'	=> 'Valle d Aosta',	
				'veneto'	=> 'Veneto',		
			),
			'label'		=> 'Area Geografica',		// custom field label
			'size'		=> 40,				// input size
			'class'		=> 'selectm',		// custom class
			'profile'	=> true,			// show in user profile
			'required'	=> true,			// make this field required
			
			
		),
	
	);

	// Add the fields into a new checkout_boxes are of the checkout page.
	foreach ( $fields as $field ) {
		pmprorh_add_registration_field(
			'checkout_boxes',				// location on checkout page
			$field							// PMProRH_Field object
		);
	}

	
}
add_action( 'init', 'my_pmprorh_init' );

?>
