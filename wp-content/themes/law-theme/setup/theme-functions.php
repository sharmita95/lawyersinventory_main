<?php
function get_practice_area() {

    $issuesList = get_terms(array(
        'taxonomy' => 'lawyers-category',
        'hide_empty' => false
    ));
    return $issuesList;
}

function get_country($service_slug) {

    if($service_slug == 'lawyers'):
        $tax = 'lawyers-location';
    else:
        $tax = "lawfirms-location";
    endif;

    $countryList = get_terms(array(
        'taxonomy' => $tax,
        'parent' => 0,
        'hide_empty' => false
    ));	
    return $countryList;
}
function get_state($service_slug, $country_slug) {

	// $gen_state_html = '<option value="" label="">Choose States</option>';

    if($service_slug == 'lawyers'):
        $tax = 'lawyers-location';
    else:
        $tax = "lawfirms-location";
    endif;

	$countryData = get_term_by( 'slug', $country_slug, $tax );
	
    $stateList = get_terms( $tax, array(
        'parent' => $countryData->term_id,
        'hide_empty' => false,                        
    ));
	
	// foreach($stateList as $state) {
	// 	$gen_state_html .= '<option value="'.$state->term_id.'" slug="'.$state->slug.'">'.$state->name.'</option>';
	// }
	return $stateList;
}
function get_city($service_slug, $state_slug){

	// $gen_city_html = '<option value="" label="">Choose City</option>';

	if($service_slug == 'lawyers'):
        $tax = 'lawyers-location';
    else:
        $tax = "lawfirms-location";
    endif;

	$stateData = get_term_by( 'slug', $state_slug, $tax );
	
	$cityList = get_terms( $tax, 
		array(
			'parent' => $stateData->term_id,
			'hide_empty' => false,                        
		)
	);
				
	// foreach($cityList as $city) {
	// 	$gen_city_html .= '<option value="'.$city->term_id.'" slug="'.$city->slug.'">'.$city->name.'</option>';
	// }

	return $cityList;
	
}