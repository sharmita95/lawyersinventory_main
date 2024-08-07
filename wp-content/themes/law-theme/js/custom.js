jQuery(document).ready(function ($) {
    
    console.log('LYI');

    $(document).on('submit','#lyi_registration_form', function (e) {
        e.preventDefault();
        var _data = $(this).serialize();
        $.post(Front.ajaxurl, _data, function (resp) {
            if(resp.flag == true) {
                // $('.success-msg').show();
                // $('.success-msg').append('<span class="smessage" style="color: green;">' + resp.msg + '</span>');
                // $('#ft_contact_form').trigger("reset");
                // setTimeout(function() {
                //   $('span.smessage').remove();
                //   $('.success-msg').hide();
                // }, 6000);
                console.log(resp);
            } else {
                // $('.error-msg').show();
                // $('.error-msg').append('<span class="emessage" style="color: red;">' + resp.msg + '</span>');
                // setTimeout(function() {
                //   $('span.emessage').remove();
                //   $('.error-msg').hide();
                // }, 6000);
                console.log(resp);
            }
        }, 'json');

    });

    //Get State depending on the Country
    $(document).on('change', '#country', function(e) {
        e.preventDefault();

        $('button[type="submit"]').addClass('disabled');

        var data = {
            action: 'registration_get_state', // This is the PHP function to call - note it must be hooked to AJAX
            country: $(this).val(),
        };
        $.post(Front.ajaxurl, data, function (resp) {
            $('button[type="submit"]').removeClass('disabled');
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
    $(document).on('change', '#state', function(e) {
        e.preventDefault();
        $('button[type="submit"]').addClass('disabled');
        var data = {
            action: 'registration_get_city', // This is the PHP function to call - note it must be hooked to AJAX
            state: $(this).val(),
        };
        $.post(Front.ajaxurl, data, function (resp) {
            $('button[type="submit"]').removeClass('disabled');
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
    
    



    ////////////////// Lawyers Listing Form /////////////////////////
    $("#find-lawyers-by-location").submit(function(e) {
        e.preventDefault();

        var _data = $(this).serialize();
        console.log(_data);        

        var co_slug = $(this).find('#country option:selected').attr('slug');
        if(!co_slug || co_slug === 'undefined') {
            co_slug = '';            
        } else {
            co_slug = '/'+co_slug;  
        }
        var s_slug = $(this).find('#state option:selected').attr('slug');
        if(!s_slug || s_slug === 'undefined') {
            s_slug = '';            
        } else {
            s_slug = '/'+s_slug;  
        }
        var ct_slug = $(this).find('#city option:selected').attr('slug');
        if(!ct_slug || ct_slug === 'undefined') {
            ct_slug = '';            
        } else {
            ct_slug = '/'+ct_slug;  
        }   
        
        var issue_slug = $(this).find('#issue option:selected').attr('slug');
        if(!issue_slug || issue_slug === 'undefined') {
            issue_slug = '';            
        } else {
            issue_slug = '?issue='+issue_slug;  
        }

        window.location = 'http://localhost/lawyersinventory_main/find-lawyers'+co_slug+s_slug+ct_slug+issue_slug;
        
    });


    ///////////////////////////////////////////
    ///////////////////////////////////////////
    ///////////////////////////////////////////
    //External links open into new tab
    $('a').each(function() {
        var a = new RegExp('/' + window.location.host + '/');
        if(this.href && !a.test(this.href)) {
            $(this).click(function(event) {
                event.preventDefault();
                event.stopPropagation();
                window.open(this.href, '_blank');
            });
        }
    });
     
    let images = document.getElementsByTagName("img");
 
    for (var i = 0; i < images.length; i++) addAlt(images[i]);
     
    //adds alt value from file name
    function addAlt(el) {
         if(el.getAttribute("alt")) return;
         
         url = el.src;
         let filename = url.substring(url.lastIndexOf("/") + 1);
         filename = filename
           .split(".")
           .slice(0, -1)
           .join(".");
         
         //console.log(filename);
         
         el.setAttribute("alt", filename);
         console.log("added alt: " + filename);
    }
	
});