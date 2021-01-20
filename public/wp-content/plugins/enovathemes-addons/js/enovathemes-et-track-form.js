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

    $('.et-track-form').each(function(){

        var $this = $(this);

        $this.submit(function(event) {

            event.preventDefault();

            var formData = $this.serialize();

            var email  = $this.find(".et-track-form-email").val();
            var number  = $this.find(".et-track-form-number").val();
            var recipient = $this.find(".et-track-form-recipient").val();

            var emailPlaceholder  = $this.find(".et-track-form-email").attr('placeholder');
            var numberPlaceholder = $this.find(".et-track-form-number").attr('placeholder');

            validateValue(email, $this.find(".et-track-form-email-valid"), true);
            validateValue(number, $this.find(".et-track-form-number-valid"));

            if (email === emailPlaceholder || number === numberPlaceholder) {
                event.preventDefault();
            }

            if (email != "" && number != ""){

                $this.find(".sending").addClass('visible');

                $.ajax({
                    type: 'POST',
                    url: $this.attr('action'),
                    data: formData
                })
                .done(function(response) {
                    
                    setTimeout(function(){
                        $this.find(".sending").removeClass('visible');
                        $this.find(".et-track-form-submit-success").addClass('visible');
                        // Clear the form.
                        $this.find(".et-track-form-email").val('');
                        $this.find(".et-track-form-number").val('');

                        setTimeout(function(){
                            $this.find(".et-track-form-submit-success").removeClass('visible');
                        },3000);

                    },3000);
                })
                .fail(function(data) {
                    setTimeout(function(){
                        $this.find(".sending").removeClass('visible');
                        $this.find(".et-track-form-submit-error").addClass('visible');

                        // Clear the form.
                        $this.find(".et-track-form-email").val('');
                        $this.find(".et-track-form-number").val('');

                        setTimeout(function(){
                            $this.find(".et-track-form-submit-error").removeClass('visible');
                        },3000);

                    },3000);
                });

            }
        });
    });

})(jQuery);