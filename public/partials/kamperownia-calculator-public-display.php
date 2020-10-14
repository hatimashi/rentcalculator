<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<button class="header-btn btn btn-default" id="calculator">Rezerwacja</button>
<div class="popup-calculator">
    <div class="popup-content ">
        <button class="icon close-popup-calculator">
            <span class="dashicons dashicons-no-alt"></span>
        </button>
        <form id="formCalculate" action="javascript:void(0)">
            <div class="kalkulator">
                <div>
                    <label class="kamp-label">Wybierz termin wynajmu
                        <span class="kamp-required-char">*</span>
                    </label>
                </div>
                <div class="form-elements">
                    <input id="StartDate" readonly="readonly" name="start_date" class="hasDatepicker" required
                           placeholder="od">
                    <input id="EndDate" readonly="readonly" name="end_date" class="hasDatepicker" required
                           placeholder="do">
                </div>
                <div class="form-info">
                    <label class="d-flex flex-row m-0">
                        <span class="kamp-text-before">Suma:</span>
                        <span class="wynik"></span>
                        <span class="kamp-text-currency">zł</span>
                        <span class="kamp-text-before">brutto</span>
                        <span id="opis"></span>
                        <p class="desc"></p>
                        <div class="error">
                            <span></span>
                        </div>
                        <input type="hidden" id="type" name="type" value="<?php print_r($atts['type']); ?>">
                        <input type="hidden" id="car" name="car" value="<?php print_r($atts['car']); ?>">
                    </label>
                </div>
                <p class="kamp-element-description-below-input">+ opłata serwisowa: <?php echo $thecar['service_pay_netto']; ?> PLN <br>
                    + zwrotna kaucja: <?php echo $thecar['deposit_price']; ?>PLN <br>
                    + podstawienie przyczepy <?php echo $thecar['placing_trailer']; ?>zł/km<br></p>
                <button type="submit" class="button-post my-2" id="calc">REZERWUJE !</button>


            </div>
        </form>
    </div>
</div>
<div class="popup-calc" style="">
    <div class="popup-content product-offer-page">
        <button class="icon close-popup-calc">
            <span class="dashicons dashicons-no-alt"></span>
        </button>
        <h2>Formularz kontaktowy</h2>
        <div role="form" class="wpcf7" id="wpcf7-f322-o1" lang="pl-PL" dir="ltr">
            <div class="screen-reader-response"></div>
            <form id="contactForm" action="javascript:void(0)" class="wpcf7-form">
                <div style="display: none;">
                    <input type="hidden" name="_wpcf7" value="322">
                    <input type="hidden" name="_wpcf7_version" value="5.0.1">
                    <input type="hidden" name="_wpcf7_locale" value="pl_PL">
                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f322-o1">
                    <input type="hidden" name="_wpcf7_container_post" value="0"></div>
                <div class="row form-content-popup">
                    <label class="col-12 col-sm-6"> 
                        <span class="wpcf7-form-control-wrap <?php print_r($atts['type']); ?>">
                            <input type="text" name="type-description" value="<?php the_title_attribute(); ?>" size="40"
                                   class="wpcf7-form-control wpcf7-text" id="reserved" readonly="readonly"
                                   aria-invalid="false">
                        </span>
                    </label>
                    <label class="col-12 col-sm-6"> 
                        <span class="wpcf7-form-control-wrap your-name">
                            <input type="text" name="your-name" value="" size="40"
                                   class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                   aria-required="true" aria-invalid="false" placeholder="Imię lub nazwa firmy"
                                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;"
                                   required>
                        </span>
                    </label>
                    <br>
                    <label class="col-12 col-sm-6"> 
                        <span class="wpcf7-form-control-wrap your-email">
                            <input type="email" name="your-email" value="" size="40"
                                   class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                   aria-required="true" aria-invalid="false" placeholder="Twój adres email" required>
                        </span>
                    </label>
                    <br>
                    <label class="col-12 col-sm-6">
                        <span class="wpcf7-form-control-wrap nr-tel">
                            <input type="tel" name="nr-tel" value="" size="40"
                                   class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel"
                                   aria-required="true" aria-invalid="false" placeholder="Twój numer telefonu" required>
                        </span>
                    </label>
                    <br>
                    <label class="col-12 col-sm-6">
                        <span class="wpcf7-form-control-wrap your-subject">
                            <input type="text" name="your-subject"
                                   value="Wynajem/Rezerwacja: <?php print_r($atts['type']); ?>" size="40"
                                   class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholderr="Temat">
                        </span>
                    </label>
                    <br>
                    <label class="col-12 col-sm-6">
                       <span class="wpcf7-form-control-wrap data-od">
                            <input type="date" name="data-od" value=""
                                   class="wpcf7-form-control wpcf7-date wpcf7-validates-as-date" id="DateStartPop"
                                   readonly="readonly" aria-invalid="false">
                        </span>
                        <span class="wpcf7-form-control-wrap data-do">
                            <input type="date" name="data-do" value=""
                                   class="wpcf7-form-control wpcf7-date wpcf7-validates-as-date" id="DateEndPop"
                                   readonly="readonly" aria-invalid="false">
                        </span>
                    </label>
                    <br>
                    <label class="col-12 col-sm-6">

                    </label>
                    <br>
                    <label class="col-12"> 
                        <span class="wpcf7-form-control-wrap your-message">
                            <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea"
                                      aria-invalid="false" placeholder="Wpisz treść wiadomości" required>
                                
                            </textarea>
                        </span>
                    </label>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <input type="submit" value="Wyślij wiadomość" class="wpcf7-form-control wpcf7-submit">
                        <span class="ajax-loader">

                        </span>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <span class="price-popup">SUMA: <span class="wynik" name="wynik"></span> PLN</span>
                        <p></p>
                        <p class="m-0">+ opłata serwisowa: 180 PLN</p>
                        <p class="m-0">+ zwrotna kaucja: 2000 PLN</p>
                        <p class="m-0">+ podstawienie przyczepy 2zł/km</p>
                    </div>
                </div>
                <div class="wpcf7-response-output wpcf7-display-none">

                </div>
            </form>
        </div>
    </div>
</div>