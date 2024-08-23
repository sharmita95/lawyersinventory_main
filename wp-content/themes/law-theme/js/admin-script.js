jQuery(document).ready(function ($) {

    $("#country").on('change', function() {
        var url = this.value;
        //window.open(url);
        $('#countryID').val(this.value);

        var data = {
            action: 'registration_get_state', // This is the PHP function to call - note it must be hooked to AJAX
            country: $(this).val(),
            type: $('#tax-type').val()
        };
        // console.log(data);

        $.post(myAjax.ajaxurl, data, function (resp) {
            if(resp.flag === true) {
                $('#state').find('option')
                .remove()
                .end()
                .append(resp.data);                
                console.log({success: resp.data});
            } else {
                console.log({error: resp.data});
            }
        }, 'json');
    });

    //Get city depending on the state
    $("#state").on('change', function(e) {
        e.preventDefault();
        var data = {
            action: 'registration_get_city', // This is the PHP function to call - note it must be hooked to AJAX
            state: $(this).val(),
            type: $('#tax-type').val()
        };
        console.log(data);
        $.post(myAjax.ajaxurl, data, function (resp) {
            if(resp.flag === true) {
                $('#city').find('option')
                .remove()
                .end()
                .append(resp.data);
                console.log({success: resp.data});
            } else {
                console.log({error: resp.data});
            }
        }, 'json');
    });




    $('#pet-vet-location').show();
    $('#pet-trainer-location').hide();
    $('#pet-groomer-location').hide();
    $('#pet-shop-location').hide();
    $('#pet-clinic-location').hide();
    $(document).on('change', '#csv_type', function(e) {
        e.preventDefault();    
        
        var currentVal = $(this).val();
        // $('#'+currentVal+'-location').toggle();
        $('.location select').hide();
        $('#'+currentVal+'-location').show();
        
    });    
    
});