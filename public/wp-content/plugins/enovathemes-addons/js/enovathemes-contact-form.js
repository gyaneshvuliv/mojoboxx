(function($){

    var valid = "invalid";
    function validateValue($value, $target, $email){
        if ($email == true) {
            var n = $value.indexOf("@");
            var r = $value.lastIndexOf(".");
            if (n < 1 || r < n + 2 || r + 2 >= $value.length) {
                valid =  "invalid";
            } else {
                valid = "valid";
            }
            
            if ($value == null || $value == "" || valid == "invalid") {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }

        } else {
            if ($value == null || $value == "") {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }
        }
    };

    $('form.enovathemes-contact-form').each(function(){

        var $this = $(this);


        $this.submit(function(event) {

            event.preventDefault();

            var formData = $this.serialize();

            var name   = $this.find(".enovathemes-contact-form-name").val();
            var email  = $this.find(".enovathemes-contact-form-email").val();
            var msg    = $this.find(".enovathemes-contact-form-mgs").val();

            var namePlaceholder   = $this.find(".enovathemes-contact-form-name").attr('placeholder');
            var msgPlaceholder    = $this.find(".enovathemes-contact-form-msg").attr('placeholder');
            var emailPlaceholder  = $this.find(".enovathemes-contact-form-email").attr('placeholder');

            validateValue(name, $this.find(".enovathemes-contact-form-name-valid"));
            validateValue(msg, $this.find(".enovathemes-contact-form-msg-valid"));
            validateValue(email, $this.find(".enovathemes-contact-form-email-valid"), true);


            if (name === namePlaceholder || email === emailPlaceholder || msg === msgPlaceholder) {
                event.preventDefault();
            }

            if (name != "" && email != "" && msg != "" && valid == "valid"){

                $this.find(".sending").addClass('visible');

                $.ajax({
                    type: 'POST',
                    url: $this.attr('action'),
                    data: formData
                })
                .done(function(response) {
                    
                    setTimeout(function(){
                        $this.find(".sending").removeClass('visible');
                        $this.find(".enovathemes-contact-form-submit-success").addClass('visible');
                        // Clear the form.
                        $this.find(".enovathemes-contact-form-name").val('');
                        $this.find(".enovathemes-contact-form-email").val('');
                        $this.find(".enovathemes-contact-form-mgs").val('');

                        setTimeout(function(){
                            $this.find(".enovathemes-contact-form-submit-success").removeClass('visible');
                        },3000);

                    },3000);
                })
                .fail(function(data) {
                    setTimeout(function(){
                        $this.find(".sending").removeClass('visible');
                        $this.find(".enovathemes-contact-form-submit-error").addClass('visible');

                        // Clear the form.
                        $this.find(".enovathemes-contact-form-name").val('');
                        $this.find(".enovathemes-contact-form-email").val('');
                        $this.find(".enovathemes-contact-form-mgs").val('');

                        setTimeout(function(){
                            $this.find(".enovathemes-contact-form-submit-error").removeClass('visible');
                        },3000);

                    },3000);
                });

            }
        });
      
    });

})(jQuery);