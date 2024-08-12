<?php
function get_country($service) {

    if($service == 'lawyers'):
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
function get_state($service, $country_id){

    if($service == 'lawyers'):
        $tax = 'lawyers-location';
    else:
        $tax = "lawfirms-location";
    endif;
	
    $stateList = get_terms( $tax, array(
        'parent' => $country_id,
        'hide_empty' => false,                        
    ));
}
function get_city($search='',$search_table=''){
	global $wpdb;
	$table = $wpdb->prefix . 'location_city';

	if(is_numeric($search)){
		if($search_table == 'city'){
			$data = $wpdb->get_results( "SELECT * FROM $table  WHERE id = {$search}");
		}elseif($search_table == 'country'){
			$data = $wpdb->get_results( "SELECT * FROM $table  WHERE country_id = {$search}");
		}else{
			$data = $wpdb->get_results("SELECT * FROM $table WHERE state_id = {$search}");
		}
	}else{
		if($search_table == 'city'){
			$data = $wpdb->get_results( "SELECT * FROM $table  WHERE name LIKE '%$search%'");
		}elseif($search_table == 'country'){
			$data = $wpdb->get_results( "SELECT * FROM $table  WHERE (country_name LIKE '%$search%' OR country_code LIKE '%$search%')");
		}else{
			$data = $wpdb->get_results("SELECT * FROM $table WHERE (state_name LIKE '%$search%' OR state_code LIKE '%$search%')");
		}
	}
	if(!empty($data)){
		foreach($data as $row){
			$output[] = (object) [
				'id' => $row->id,
				'name' => $row->name,
				'state_id' => $row->state_id,
				'state_name' => $row->state_name,
				'state_code' => $row->state_code,
				'country_id' => $row->country_id,
				'country_name' => $row->country_name,
				'country_code' => $row->country_code
			];
		}
		return $output;
	}
}