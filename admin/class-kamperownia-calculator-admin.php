<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * The option name of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $option_name The option name of the plugin.
     */
    protected $option_name;

    private $tables;

    /**
     * Pass to js
     *
     * @var $line
     */
    private $line;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     * @param      string $option_name The version of this plugin.
     */
    public function __construct($plugin_name, $version, $option_name)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->option_name = $option_name;
//        register_setting($this->plugin_name . '_rates', $this->option_name . '_rates');
        register_setting($this->plugin_name . '_mail', $this->option_name . '_mail');
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style("kamperownia-calculator-admin.css", plugin_dir_url(__FILE__) . 'css/kamperownia-calculator-admin.css', array(), $this->version, 'all');
        wp_enqueue_style("jquery.dataTables.min.css", plugin_dir_url(__FILE__) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all');
        wp_enqueue_style("bootstrap.min.css", plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name . 'jquery', plugin_dir_url(__FILE__) . 'js/jquery-3.4.1.min.js', array('jquery'), $this->version, false);

        wp_enqueue_script("jquery.dataTables.min.js", plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script("jquery.notifyBar.js", plugin_dir_url(__FILE__) . 'js/jquery.notifyBar.js', array('jquery'), $this->version, false);
        wp_enqueue_script("validate.min.js", plugin_dir_url(__FILE__) . 'js/validate.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script("bootstrap.min.js", plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . 'jquery-datepicer', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . 'popperjs', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), $this->version, true);

        wp_enqueue_script("kamperownia-calculator-admin.js", plugin_dir_url(__FILE__) . 'js/kamperownia-calculator-admin.js', array('jquery'), $this->version, true);
        wp_localize_script("kamperownia-calculator-admin.js", "boiler_ajax_url", admin_url("admin-ajax.php"));
    }

    public function add_options_page()
    {
        global $wpdb;

        add_menu_page(
            "Calculator",
            "Calculator",
            "manage_options",
            $this->plugin_name,
            array($this, "kamperowniacalculator_calculate"),
            "dashicons-products",
            55
        );
    }

    public function register_setting()
    {
        add_settings_section(
            $this->option_name . '_rates',
            __('Rates', 'calculator'),
            array($this, $this->option_name . '_rates_cb_info'),
            $this->plugin_name . '_rates'
        );

        add_settings_field(
            $this->option_name . '_rates',
            __('Rates settings', 'calculator'),
            array($this, $this->option_name . '_rates_render_cb'),
            $this->plugin_name . '_rates',
            $this->option_name . '_rates',
            array('label_for' => $this->option_name . '_rates')
        );

        add_settings_section(
            $this->option_name . '_cars',
            __('Cars', 'calculator'),
            array($this, $this->option_name . '_cars_cb_info'),
            $this->plugin_name . '_cars'
        );

        add_settings_field(
            $this->option_name . '_cars',
            __('Add cars', 'calculator'),
            array($this, $this->option_name . '_cars_render_cb'),
            $this->plugin_name . '_cars',
            $this->option_name . '_cars',
            array('label_for' => $this->option_name . '_cars')
        );

        add_settings_section(
            $this->option_name . '_mail',
            __('Mail', 'calculator'),
            array($this, $this->option_name . '_mail_cb_info'),
            $this->plugin_name . '_mail'
        );

        add_settings_field(
            $this->option_name . '_mail',
            __('Mail settings', 'calculator'),
            array($this, $this->option_name . '_mail_render_cb'),
            $this->plugin_name . '_mail',
            $this->option_name . '_mail',
            array('label_for' => $this->option_name . '_mail')
        );
    }

    /**
     * Render the text for the general section
     *
     * @since  1.0.0
     */
    public function calculator_rates_cb_info()
    {
        echo '<p>' . __('Please change the settings accordingly', 'calculator') . '</p>';
        echo '<p >' . __('For now its possible to add only one line for every submit', 'calculator') . '</p>';
    }

    /**
     * Render the text for the cars section
     *
     * @since  1.0.0
     */
    public function calculator_cars_cb_info()
    {
        echo '<p>' . __('Add cars', 'calculator') . '</p>';
    }

    /**
     * Render the text for the contact section
     *
     * @since  1.0.0
     */
    public function calculator_mail_cb_info()
    {
        echo '<p>' . __('Write e-mail address on which information will be send', 'calculator') . '</p>';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function calculator_rates_render_cb()
    {
        $cars = get_option($this->option_name . '_cars');
        $option = get_option($this->option_name . '_rates');

        $list = json_decode($option);
        $cars_list = json_decode($cars);

        $option_calclist = $list;


        ?>
        <input type="hidden" name="action" value="rates_update">
        <?php foreach ($cars_list as $cKey => $cValue): ?>
        <table id="<?php echo $cValue->shortname ?>" class="form-table">
            <thead>
            <th scope="row"><?php echo __('Date from', 'calculator'); ?></th>
            <th scope="row"><?php echo __('Date to', 'calculator'); ?></th>
            <th scope="row"><?php echo __('Price ExTAX', 'calculator'); ?></th>
            </thead>
            <tbody>
            <h3><?php echo $cValue->fullname?></h3>
            <?php if ($option_calclist != ""):$line = 0;$currKey = $cValue->shortname;
                foreach ($option_calclist->{$currKey} as $key => $value): ?><?php  ?>
                    <tr valign="top">
                        <td><input type="date" class="datepicker"
                                   id="<?php echo($this->option_name . '_rates_date_from_' . $line. $cValue->shortname); ?>"
                                   name="<?php echo('rates[' . $cValue->shortname . '][' . $line . '][date_start]' . $this->option_name . '_rates_date_from[]'); ?>"
                                   value="<?php echo esc_attr($value->date_start); ?>"/></td>


                        <td><input type="date" class="datepicker"
                                   id="<?php echo($this->option_name . '_rates_date_to_' . $line. $cValue->shortname); ?>"
                                   name="<?php echo('rates[' . $cValue->shortname . '][' . $line . '][date_end]' . $this->option_name . '_rates_date_to[]'); ?>"
                                   value="<?php echo esc_attr($value->date_end); ?>"/></td>


                        <td><input type="text"
                                   id="<?php echo($this->option_name . '_rates_date_price_' . $line. $cValue->shortname); ?>"
                                   name="<?php echo('rates[' . $cValue->shortname . '][' . $line . '][price]' . $this->option_name . '_rates_date_price[]'); ?>"
                                   value="<?php echo esc_attr($value->price); ?>"/></td>
                    </tr>
                    <?php $line++;
                    $this->line = $line; endforeach;

            else:?>
                <tr valign="top" name="">
                    <td><input type="date" class="datepicker"
                               id="<?php echo $this->option_name . '_rates_date_from'; ?>"
                               name="<?php echo 'rates[' . $cValue->shortname . '][0][date_start]' . $this->option_name . '_rates_date_from[]'; ?>"
                               value=""/></td>


                    <td><input type="date" class="datepicker"
                               id="<?php echo $this->option_name . '_rates_date_to'; ?>"
                               name="<?php echo 'rates[' . $cValue->shortname . '][0][date_end]' . $this->option_name . '_rates_date_to[]'; ?>"
                               value=""/></td>


                    <td><input type="text"
                               id="<?php echo $this->option_name . '_rates_price'; ?>"
                               name="<?php echo 'rates[' . $cValue->shortname . '][0][price]' . $this->option_name . '_rates_price[]'; ?>"
                               value=""/></td>
                </tr>
            <?php
            endif;

            ?>
            <span id="<?php echo $cValue->shortname ?>_add_line" class="btn btn-primary add_new_line" name="add_line" value="<?php echo $cValue->shortname ?>">
                <?php _e('Add line', 'calculator'); ?>
            </span>
            </tbody>
        </table>

    <?php endforeach;
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function calculator_cars_render_cb()
    {
        $option = get_option($this->option_name . '_cars');
        $list = json_decode($option);
        $option_cars = $list;


        ?>
        <input type="hidden" name="action" value="cars_update">

        <table id="rates" class="form-table">
            <thead>
            <th scope="row"><?php echo __('Short Name', 'calculator'); ?></th>
            <th scope="row"><?php echo __('Name', 'calculator'); ?></th>
            <th scope="row"><?php echo __('Service price', 'calculator'); ?></th>
            <th scope="row"><?php echo __('Deposit price', 'calculator'); ?></th>
            <th scope="row"><?php echo __('Placing the trailer', 'calculator'); ?></th>
            </thead>
            <tbody>
            <?php if ($option_cars != ""):$line = 0;
                foreach ($option_cars as $key => $value): ?>
                    <tr valign="top">
                        <td><input type="text"
                                   id="<?php echo($this->option_name . '_shortname_' . $key); ?>"
                                   name="<?php echo('cars[' . $key . '][shortname]' . $this->option_name . '_shortname[]'); ?>"
                                   value="<?php echo esc_attr($value->shortname); ?>"/></td>

                        <td><input type="text"
                                   id="<?php echo($this->option_name . '_fullname_' . $key); ?>"
                                   name="<?php echo('cars[' . $key . '][fullname]' . $this->option_name . '_fullname[]'); ?>"
                                   value="<?php echo esc_attr($value->fullname); ?>"/></td>
                        <td><input type="text"
                                   id="<?php echo($this->option_name . '_service_price_' . $key); ?>"
                                   name="<?php echo('cars[' . $key . '][service_price]' . $this->option_name . '_service_price[]'); ?>"
                                   value="<?php echo esc_attr($value->service_price); ?>"/></td>
                        <td><input type="text"
                                   id="<?php echo($this->option_name . '_deposit_price_' . $key); ?>"
                                   name="<?php echo('cars[' . $key . '][deposit_price]' . $this->option_name . '_deposit_price[]'); ?>"
                                   value="<?php echo esc_attr($value->deposit_price); ?>"/></td>
                        <td><input type="text"
                                   id="<?php echo($this->option_name . '_placing_trailer_' . $key); ?>"
                                   name="<?php echo('cars[' . $key . '][placing_trailer]' . $this->option_name . '_placing_trailer[]'); ?>"
                                   value="<?php echo esc_attr($value->placing_trailer); ?>"/></td>
                    </tr>
                    <?php $line++;
                    $this->line = $line; endforeach;

            else:?>
                <tr valign="top" name="">
                    <td><input type="text"
                               id="<?php echo $this->option_name . '_shortname'; ?>"
                               name="<?php echo 'cars[0][shortname]' . $this->option_name . '_shortname[]'; ?>"
                               value=""/></td>
                    <td><input type="text"
                               id="<?php echo $this->option_name . '_fullname'; ?>"
                               name="<?php echo 'cars[0][fullname]' . $this->option_name . '_fullname[]'; ?>"
                               value=""/></td>
                    <td><input type="text"
                               id="<?php echo $this->option_name . '_service_price'; ?>"
                               name="<?php echo 'cars[0][service_price]' . $this->option_name . '_service_price[]'; ?>"
                               value=""/></td>
                    <td><input type="text"
                               id="<?php echo $this->option_name . '_deposit_price'; ?>"
                               name="<?php echo 'cars[0][deposit_price]' . $this->option_name . '_deposit_price[]'; ?>"
                               value=""/></td>
                    <td><input type="text"
                               id="<?php echo $this->option_name . '_placing_trailer'; ?>"
                               name="<?php echo 'cars[0][placing_trailer]' . $this->option_name . '_placing_trailer[]'; ?>"
                               value=""/></td>
                </tr>
            <?php
            endif;

            ?>
            <span id="add_new_line_cars" class="btn btn-primary" name="add_line">
                <?php _e('Add line', 'calculator'); ?>
            </span>
            </tbody>
        </table>

        <?php
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function calculator_mail_render_cb()
    {
        $option_mail = get_option($this->option_name . '_mail');

        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo __('E-mail', 'calculator'); ?></th>
                <td><input type="text" id="<?php echo $this->option_name . '_mail'; ?>"
                           name="<?php echo $this->option_name . '_mail'; ?>"
                           value="<?php echo esc_attr($option_mail) ?>"/></td>
            </tr>


        </table>
        <?php
    }

    public function kamperowniacalculator_calculate()
    {
        include_once KAMPEROWNIACALCULATOR_PLUGIN_DIR . "/admin/partials/kamperownia-calculator-admin-display.php";
    }

    public function kamperowniacalculator_ajax_fnc()
    {
        $param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";
        global $wpdb;
        $input_niski_price = isset($_REQUEST['input_niski_price']) ? $_REQUEST['input_niski_price'] : "";
        $input_sredni_price = isset($_REQUEST['input_sredni_price']) ? $_REQUEST['input_sredni_price'] : "";
        $input_wysoki_price = isset($_REQUEST['input_wysoki_price']) ? $_REQUEST['input_wysoki_price'] : "";

        if (!empty($param) && $param == 'save_prices') {
            $input_niski_price !== "" ? $wpdb->update($this->tables->kamperowanicalculatortable(), array("price" => $input_niski_price), array("description" => "input_niski_price")) : "";
            $input_sredni_price !== "" ? $wpdb->update($this->tables->kamperowanicalculatortable(), array("price" => $input_sredni_price), array("description" => "input_sredni_price")) : "";
            $input_wysoki_price !== "" ? $wpdb->update($this->tables->kamperowanicalculatortable(), array("price" => $input_wysoki_price), array("description" => "input_wysoki_price")) : "";

        }

        wp_die();
    }

}
