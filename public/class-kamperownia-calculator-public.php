<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Kamperownia_calculator
 * @subpackage Kamperownia_calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $kamperownia_calculator The ID of this plugin.
     */
    private $kamperownia_calculator;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /*
     * name of table
     */
    private $tables;

    /*
     * shortcode attribute
     */
    private $atts;

    /**
     * The option name of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $option_name The option name of the plugin.
     */
    protected $option_name;

    /*
     * Main Email
     */
    private $email = 'kontakt@soyokaze.pl';

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $kamperownia_calculator The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($kamperownia_calculator, $version)
    {

        $this->kamperownia_calculator = $kamperownia_calculator;
        $this->version = $version;
        if (defined('PLUGIN_OPTION_NAME')) {
            $this->option_name = PLUGIN_OPTION_NAME;
        } else {
            $this->option_name = 'calculator';
        }

        $this->email = get_option($this->option_name . '_mail');

        require_once KAMPEROWNIACALCULATOR_PLUGIN_DIR . 'includes/class-kamperownia-calculator-tables.php';

    }

    public static function kamperownia_calculator_show($atts, $content = "", $car = "")
    {
        $cars = json_decode(get_option('calculator_cars'));
        foreach ($cars as $value){
//            var_dump($value);var_dump($atts['car']);
            if($value->shortname == $atts['car'] ) {
                $thecar['service_pay_netto'] =  $value->service_price;
                $thecar['service_pay_brutto'] = ($value->service_price * 1.23);
                $thecar['deposit_price'] = $value->deposit_price;
                $thecar['placing_trailer'] =$value->placing_trailer;
            }
        }

        include_once KAMPEROWNIACALCULATOR_PLUGIN_DIR . "/public/partials/kamperownia-calculator-public-display.php";
    }

    private static function kamperowniacalculator_view()
    {

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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
        wp_enqueue_style($this->kamperownia_calculator, plugin_dir_url(__FILE__) . 'css/kamperownia-calculator-public.css', array(), $this->version, 'all');
        wp_enqueue_style("jquery-ui.css", plugin_dir_url(__FILE__) . 'css/jquery-ui.css', array(), $this->version, 'all');
        wp_enqueue_style("datepicker.css", plugin_dir_url(__FILE__) . 'css/datepicker.css', array(), $this->version, 'all');
        wp_enqueue_style("form.css", plugin_dir_url(__FILE__) . 'css/form.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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
        wp_enqueue_script("kamperownia-calculator-public.js", plugin_dir_url(__FILE__) . 'js/kamperownia-calculator-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script("jquery-ui.js", plugin_dir_url(__FILE__) . 'js/jquery-ui.js', array('jquery'), $this->version, true);
        wp_enqueue_script("validate.min.js", plugin_dir_url(__FILE__) . 'js/validate.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script("datepicker.js", plugin_dir_url(__FILE__) . 'js/datepicker.js', array('jquery'), $this->version, true);
        wp_enqueue_script("datepicker.pl-PL.js", plugin_dir_url(__FILE__) . 'js/datepicker.pl-PL.js', array('jquery'), $this->version, true);
        wp_localize_script("kamperownia-calculator-public.js", "boiler_ajax_public_url", admin_url("admin-ajax.php"));
    }

    public function kamperowniacalculator_ajax_fnc()
    {

        if (!isset($_REQUEST['start_date']) & !isset($_REQUEST['end_date'])) {
            wp_die();
        }
        global $wpdb;

        $sum = 0;
        $values = array();
        $season = 0;

        $type = $_REQUEST['type'];
        $car = $_REQUEST['car'];
        $start_date = date_create(isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : "");

//        $start_date = date_format($start_date,'Y-m-d');

        $end_date = date_create(isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : "");
//        $end_date = date_format($end_date,'Y-m-d');

        /**
         * Db was deleted. Now is possible to manage prices and dates from settings.
         */
//        $query = $wpdb->get_results(
//            "SELECT * FROM " . $this->tables->kamperowanicalculatortable() . " WHERE type='" . $type . "'"
//        );

        $query = json_decode(get_option($this->option_name . '_rates'));


        $query = $query->{$car};
        foreach ($query as $key => $value) {

//            $startdateyear = date('Y',strtotime($value->date_start));
//            $value->date_start=($startdateyear+1)."-".date('m-d',strtotime($value->date_start));
//            $enddateyear = date('Y',strtotime($value->date_end));
//            $value->date_end=($enddateyear+1)."-".date('m-d',strtotime($value->date_end));
            //$value->date_start = date( strtotime($value->date_start), strtotime('+1 year') );
            //$value->date_end = date_create('Y-m-d', strtotime('+1 year', strtotime($value->date_end)) );

            $value->date_start = date_create($value->date_start);
            $value->date_end = date_create($value->date_end);


            if (($start_date >= $value->date_start) && ($end_date <= $value->date_end)) {

                $days = date_diff($start_date, $end_date);
                $sum = $days->d == 0 ? $days->d + 1 * $value->price : $days->d * $value->price;
                $values['season'] = $value->season;
                $values['days'] = $days;
                $values['sum'] = $sum;
                $values['if1'] = 1;

            } else if (($start_date < $value->date_start) && ($end_date >= $value->date_start)) {
                $days_1 = date_diff($start_date, $value->date_start);
                $days_2 = date_diff($end_date, $value->date_start);
                $sum = ($days_1->d * $query[$key - 1]->price) + ($days_2->d * $query[$key]->price);
                $values['days_first'] = $days_1;
                $values['days_second'] = $days_2;
                $values['sum'] = $sum;
                $values['if2'] = 1;
            }
        }

//        switch ($type){
//            case 'przyczepa':
//                $values['service_pay_netto'] = '300';
//                $values['service_pay_brutto'] = '369';
//                $values['deposit'] = '2000';
//                break;
//            case 'kamper':
//                $values['service_pay_netto'] = '300';
//                $values['service_pay_brutto'] = '369';
//                $values['deposit'] = '5000';
//                break;
//            case 'samochod':
//                $values['service_pay_netto'] = '300';
//                $values['service_pay_brutto'] = '369';
//                $values['deposit'] = '1500';
//                break;
//        }
        print_r(json_encode($values));
        wp_die();
    }

    public function kamperowniacalculator_ajax_email_fnc()
    {

        $message = "<h1>" . $_REQUEST['your-subject'] . " </h1>" . $_REQUEST['type-description']
            . "<h2>Imię i nazwisko: </h2>" . $_REQUEST['your-name'] . ""
            . "<h2>Okres Rezerwacji: </h2> od " . $_REQUEST['data-od'] . " do " . $_REQUEST['data-do'] . ""
            . "<h2>Telefon: </h2>" . $_REQUEST['nr-tel'] . ""
            . "<h2>Cena z kalkulatora: </h2>" . $_REQUEST['wyniknetto'] . " zł netto - " . $_REQUEST['wynikbrutto'] . " zł brutto "
            . "<h2>Wiadomość: </h2>" . $_REQUEST['your-message'];
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $send_email_status = wp_mail($this->email, sanitize_text_field($_REQUEST['your-subject']), $message, $headers);

        print_r($send_email_status);
        wp_die();
    }

}

add_shortcode('kamperowniacalculator', array('Plugin_Name_Public', 'kamperownia_calculator_show'));
