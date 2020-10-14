<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */
?>
<h1>calculator settings</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
           aria-selected="true">Ustawienie sezonów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
           aria-selected="false">Kampery</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
           aria-selected="false">Kontakt</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
            <?php
            settings_fields($this->plugin_name . '_rates');
            do_settings_sections($this->plugin_name . '_rates');
            submit_button(__('Submit', 'calculator'), 'primary', 'submit', true, array('id' => 'rates'));
            ?>
        </form>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
            <?php
            settings_fields($this->plugin_name . '_cars');
            do_settings_sections($this->plugin_name . '_cars');
            submit_button(__('Submit', 'calculator'), 'primary', 'submit', true, array('id' => 'cars'));
            ?>
        </form>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <form action="options.php" method="post">
            <?php
            settings_fields($this->plugin_name . '_mail');
            do_settings_sections($this->plugin_name . '_mail');
            submit_button(__('Submit', 'calculator'), 'primary', 'submit', true, array('id' => 'mail'));
            ?>
        </form>
    </div>
</div>
<script>
    jQuery(function () {
        // jQuery(".datepicker").datepicker({
        //     dateFormat: "yy-mm-dd"
        // });
    });
    $(document).ready(function () {

    });
    var option_name = "<?php echo $this->option_name; ?>";



    jQuery(".add_new_line").click(function () {
        var car_name = $(this).attr('value');

        var key = "<?php echo $this->line; ?>";
    if (key = <?php echo $this->line; ?>) {
        key++;
    }
    var newRowContent = "<tr valign=\"top\" name=\"\">\n" +
        "                    <td><input type=\"date\" class=\"datepicker\"\n" +
        "                               id=\"" + option_name + "_rates_date_from_" + key + car_name +"\"\n" +
        "                               name=\"rates[\" + car_name + \"][" + key + "][date_start]" + option_name + "_rates_date_from[]\"\n" +
        "                               value=\"\"/></td>\n" +
        "\n" +
        "\n" +
        "                    <td><input type=\"date\" class=\"datepicker\"\n" +
        "                               id=\"" + option_name + "_rates_date_to_" + key + car_name+"'\"\n" +
        "                               name=\"rates[\" + car_name + \"][" + key + "][date_end]" + option_name + "_rates_date_to[]\"\n" +
        "                               value=\"\"/></td>\n" +
        "\n" +
        "\n" +
        "                    <td><input type=\"text\"\n" +
        "                               id=\"" + option_name + "_rates_price_" + key + car_name+"\"\n" +
        "                               name=\"rates[\" + car_name + \"][" + key + "][price]" + option_name + "_rates_price[]\"\n" +
        "                               value=\"\"/></td>\n" +
        "                </tr>";

        jQuery("#"+car_name+" tbody").append(newRowContent);

        jQuery("#"+car_name+"_add_line").hide();

    });

    // jQuery("#add_new_line").click(function(){
    //     jQuery(newRowContent).appendTo($("#rates"));
    // });

    jQuery("#add_new_line_cars").click(function () {
        var key = "<?php echo $this->line; ?>";
        if (key = <?php echo $this->line; ?>) {
            key++;
        }
        var newRowContentCars = "<tr valign=\"top\" name=\"\">\n" +
            "                    <td><input type=\"text\"\n" +
            "                               id=\"" + option_name + "_shortname_" + key + "\"\n" +
            "                               name=\"cars[" + key + "][shortname]" + option_name + "_shortname[]\"\n" +
            "                               value=\"\"/></td>\n" +
            "                    <td><input type=\"text\"\n" +
            "                               id=\"" + option_name + "_fullname_" + key + "\"\n" +
            "                               name=\"cars[" + key + "][fullname]" + option_name + "_fullname[]\"\n" +
            "                               value=\"\"/></td>\n" +
            "                    <td><input type=\"text\"\n" +
            "                               id=\"" + option_name + "_service_price_" + key + "\"\n" +
            "                               name=\"cars[" + key + "][service_price]" + option_name + "_service_price[]\"\n" +
            "                               value=\"\"/></td>\n" +
            "                    <td><input type=\"text\"\n" +
            "                               id=\"" + option_name + "_deposit_price_" + key + "\"\n" +
            "                               name=\"cars[" + key + "][deposit_price]" + option_name + "_deposit_price[]\"\n" +
            "                               value=\"\"/></td>\n" +
            "                    <td><input type=\"text\"\n" +
            "                               id=\"" + option_name + "_placing_trailer_" + key + "\"\n" +
            "                               name=\"cars[" + key + "][placing_trailer]" + option_name + "_placing_trailer[]\"\n" +
            "                               value=\"\"/></td>\n" +
            "                </tr>";
        jQuery("#rates tbody").append(newRowContentCars);

        jQuery("#add_new_line_cars").hide();
    });

</script>
