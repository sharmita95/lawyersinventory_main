jQuery(document).ready(function ($) {

    //Get city depending on the state
    $('#lawyersLocation').show();
    $('#lawfirmsLocation').hide();
    $(document).on('change', '#csv_type', function(e) {
        e.preventDefault();        

        $('#lawfirmsLocation').toggle();
        $('#lawyersLocation').toggle();
        
    });
    
});