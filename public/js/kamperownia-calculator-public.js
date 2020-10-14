(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $(function () {

        $("#EndDate").datepicker({
            language: 'pl-PL'
        });
        $("#StartDate").datepicker({
            language: 'pl-PL'
        });
    });

    jQuery(document).ready(function () {

        jQuery("#formCalculate").on('input', function () {


            var postdata = jQuery("#formCalculate").serialize() + "&action=boiler_public_request&param=calculate_prices";

            jQuery.post(boiler_ajax_public_url, postdata, function (response) {
                // alert(response);
                var data = JSON.parse(response);
                jQuery(".wynik").empty();
                jQuery(".wynik").append(data['sum']);

//                //Popup filling
                var startd = jQuery("#StartDate").val();
                jQuery("#DateStartPop").val(startd);
                var endd = jQuery("#EndDate").val();
                jQuery("#DateEndPop").val(endd);
//                    jQuery("#opis").append(data['season'] + data['days']);
            });

        });

        jQuery("#formCalculate").validate({
            submitHandler: function () {
                jQuery(".popup-calc").css("display", "block");
            }
        });
        jQuery("#contactForm").validate({
            submitHandler: function () {
                var postdata = jQuery("#contactForm").serialize() + "&action=boiler_public_email&param=send_email";
                jQuery.post(boiler_ajax_public_url, postdata, function (response) {
                    jQuery(".popup-calc").css("display", "none");
                    jQuery("#mailInfoPopup").css("display", "block");
                    response = 1 ? jQuery("#mailInfoPopup span").append('Wiadomosc wyslana poprawnie.') : jQuery("#mailInfoPopup span").append("Blad wysylania wiadomosci. Skontaktuj sie z nami telefonicznie");
                });
            },
            invalidHandler: function (event, validator) {
                // 'this' refers to the form
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = errors == 1
                            ? 'Nie uzupenies 1 pola. Pole zostao podsietlone'
                            : 'Uzupenij ' + errors + ' pola. Pola zostay podsietlone';

                    $("div.error span").html(message);

                    $("div.error").show();
                } else {
                    $("div.error").hide();
                }
            }

        });
        jQuery(".close-popup-calc").on("click", function () {
            jQuery(".popup-calc").css("display", "none");
        });
        jQuery("#calculator").on("click", function () {
            jQuery(".popup-calculator").css("display", "block");
            jQuery("#EndDate").datepicker({
                language: 'pl-PL'
            });
            jQuery("#StartDate").datepicker({
                language: 'pl-PL'
            });
        });
        jQuery(".close-popup-calculator").on("click", function () {
            jQuery(".popup-calculator").css("display", "none");
        });
    });
})(jQuery);
