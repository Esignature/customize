<script type="text/javascript">
$j(document).ready(function(){
    $j('.loginform button').hover(function(){
        $j(this).stop().switchClass('default','hover');
    },function(){
        $j(this).stop().switchClass('hover','default');
    });
    
    //FORM VALIDATION
    $j("#login").validate({
        rules: {
            email: {
                required: true,
                email: true
            },            
            password: {
                required: true,
                minlength: 6,
                maxlength: 20   
            },
            cpassword: {
                required: true,
                equalTo: '#password'
            },
            website: {
                required: true,
                url: true
            },
            fname: "required",
            lname: "required",
            company: 'required',
            phone: "required",
            country_id: "required",
            tz_id: "required",
            captcha: {
                required: true,
                remote: 'application/views/site/val_captcha.php?_t=rgst'   
            }
        },
        messages: {
            email: {
                required:"Please enter your email address.",
                email: "Please enter your valid email address.", 
            },           
            password: {
                required: "Please enter a password (6-20 character).",
                minlength: "Password must be atleast 6 characters in length.",
                maxlength: "Password must not exceed 20 characters."
            },
            cpassword: {
                required: 'Please confirm your password.',
                equalTo: 'Password did not match.'
            },
            website: {
                required: 'Please specify your valid website url. e.g. http://www.somesite.com',
                url: 'The url you specified is not in valid format.'
            },
            fname: "Please enter your first name.",
            lname: "Please enter your last name",
            company: 'Please enter your company name.',
            phone: "Please enter your phone number.",
            country_id: "Please select your country.",
            tz_id: "Please select a timezone.",
            captcha: {
                required: 'Please enter the word you see alongside.',
                remote: 'Invalid captcha word entered.'   
            }
        },
        submitHandler: function(form) { 
            if(!$j('#agree').is(':checked')){
               alert('You must agree to the Terms & Condition and Privacy Policy in order to continue.');
               return false;
            }
            else
                form.submit();
       }
    });

    //for checkbox
    $j('input[type=checkbox]').each(function(){
        var t = $j(this);
        t.wrap('<span class="checkbox"></span>');
        t.click(function(){
            if($j(this).is(':checked')) {
                t.attr('checked',true);
                t.parent().addClass('checked');
            } else {
                t.attr('checked',false);
                t.parent().removeClass('checked');
            }
        });
    }); 
    
  
});

</script>
