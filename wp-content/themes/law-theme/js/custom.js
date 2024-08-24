jQuery(document).ready(function ($) {

    //Get country on registration form
    $(document).on('change', 'input[name="user_type"]', function(e) {
        e.preventDefault();

        $('button[type="submit"]').addClass('disabled');
        var userType = $(this).val();
        if(userType == 'lawyers') {
            $('#type').val('lawyers');
            $('#tax-type').val('lawyers-location');
        } else {
            $('#type').val('law-firms');
            $('#tax-type').val('lawfirms-location');
        }

        var data = {
            action: 'registration_get_country', // This is the PHP function to call - note it must be hooked to AJAX
            tax: $('#tax-type').val()
        };
        console.log(data);
        $.post(Front.ajaxurl, data, function (resp) {
            $('button[type="submit"]').removeClass('disabled');
            if(resp.flag === true) {
                $('#country').find('option')
                .remove()
                .end()
                .append(resp.data);                
                console.log({success: resp.data});
            } else {
                console.log({error: resp.data});
            }
        }, 'json');
    });

    $(document).on('submit','#lyi_registration_form', function (e) {
        e.preventDefault();
        var _data = $(this).serialize();
        $.post(Front.ajaxurl, _data, function (resp) {
            if(resp.flag == true) {
                $('.success-msg').show().empty();
                $('.success-msg').append('<span class="smessage" style="color: green;">' + resp.msg + '</span>');
                $('#ft_contact_form').trigger("reset");
                setTimeout(function() {
                  $('span.smessage').remove();
                  $('.success-msg').hide();
                }, 6000);
                console.log(resp);
            } else {
                $('.error-msg').show().empty();
                $('.error-msg').append('<span class="emessage" style="color: red;">' + resp.msg + '</span>');
                setTimeout(function() {
                  $('span.emessage').remove();
                  $('.error-msg').hide();
                }, 6000);
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
            type: $('#tax-type').val()
        };
        console.log(data);
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
            type: $('#tax-type').val(),
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



    //Practice/issue page filter form
    $('#find-by-issue').submit(function(e) {
        e.preventDefault();
        $('button[type="submit"]').addClass('disabled');        
        var _data = $(this).serialize();

        $.post(Front.ajaxurl, _data, function (resp) {
            $('button[type="submit"]').removeClass('disabled');
            $('#result-container').html(resp);
            
        });
    });

    //Practice Page Search
    $('.lawyers-filter-search-from input').keyup(function (e) {
        console.log('Time elapsed!');

        clearTimeout(keyupTimer);
        keyupTimer = setTimeout(function () {
            console.log('Time expired!');
        }, 800);
    });


    ////////////////// Firms Listing Form /////////////////////////
    $("#find-firms-by-location").submit(function(e) {
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

        window.location = 'http://localhost/lawyersinventory_main/find-lawfirms'+co_slug+s_slug+ct_slug+issue_slug;
        
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

















    //For designing
    $('.custom-pagination a.page-numbers').addClass('pagination-btn');
    $('.custom-pagination a.page-numbers.current').addClass('pagination-btn p-b-active');




    //Blog page pagination
    $('body').on('click','.pagination-btn',function(e){
        e.preventDefault();
        var category = $('#category_filter').val();
        var dateSort = $('#date_sort').val();
        var searchQuery = $('.lawyers-filter-search-from-input').val();
        var href = $(this).attr('href');
        $('form.pagination-wrapper').attr('action',href);
        $('input[name="input_category"]').val(category);
        $('input[name="input_order"]').val(dateSort);
        $('input[name="input_search"]').val(searchQuery);
        $('form.pagination-wrapper').submit();
    });


    $('#category_filter, #date_sort, .lawyers-filter-search-from-input').on('change keyup', function() {
        var category = $('#category_filter').val();
        var dateSort = $('#date_sort').val();
        var searchQuery = $('.lawyers-filter-search-from-input').val();
        $.ajax({
            url: Front.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_posts',
                category: category,
                date_sort: dateSort,
                s: searchQuery
            },
            success: function(response) {
                $('#posts-container').html(response);
            }
        });
    });






    ///////////////////////////////////////////////
    $('#default-search').keyup('on', function(e) {
        e.preventDefault();
        console.log('okay');
        var searchQuery = $(this).val();
        performSearch(searchQuery);    
    });

    var sidebarSearchForm = $('.side-search-from');
    var sidebarSearchInput = $('.side-search-input');
    var modal = $('#myModal');
    var modalSearchInput = modal.find('.search-input-field');

    sidebarSearchForm.on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        modal.show(); // Open the modal
        modalSearchInput.val(sidebarSearchInput.val()); // Pass the input value to the modal search field
        performSearch(sidebarSearchInput.val()); // Perform the search
    });

    // function for ajax search.
    function performSearch(query){
        $.ajax({
            type: 'POST',
            url: Front.ajaxurl,
            data: {
                //function
                action: 'ajax_search',
                search_query: query
            },
            success: function(response) {
                $('.modal-body').html(response);
            }
        });
    }
	
});










