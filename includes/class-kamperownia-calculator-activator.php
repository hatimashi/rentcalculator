<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Kamperownia_Calculator_Activator {

    private $table;

    public function __construct($tables_object) {
        $this->table = $tables_object;
    }

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public function activate() {

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");

//        global $wpdb;
//        if (count($wpdb->get_var("Show tables like '" . $this->table->kamperowanicalculatortable() . "'")) == 0) {
//
//            $sqlQuery = "CREATE TABLE `" . $this->table->kamperowanicalculatortable() . "` (
//                        `id` int(11) NOT NULL AUTO_INCREMENT,
//                        `price` decimal(10,0) NOT NULL,
//                        `type` tinytext NOT NULL,
//                        `description` tinytext NOT NULL,
//                        `season` tinytext NOT NULL,
//                        `date_start` date NOT NULL DEFAULT '0000-00-00',
//                        `date_end` date NOT NULL DEFAULT '0000-00-00',
//                        `last_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//                        PRIMARY KEY (`id`)
//                       ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin2";
//            dbDelta($sqlQuery);
//
//
//        }
//         $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 180,
//                'type' => 'przyczepa',
//                "description" => "input_niski_price",
//                "season" => "niski",
//                "date_start" => "2018-10-01",
//                "date_end" => "2019-04-26"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 225,
//                'type' => 'przyczepa',
//                "description" => "input_sredni_price",
//                "season" => "sredni",
//                "date_start" => "2019-09-01",
//                "date_end" => "2019-09-30"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 225,
//                'type' => 'przyczepa',
//                "description" => "input_sredni_2_price",
//                "season" => "sredni",
//                "date_start" => "2019-05-06",
//                "date_end" => "2019-06-19"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 250,
//                'type' => 'przyczepa',
//                "description" => "input_wysoki_price",
//                "season" => "wysoki",
//                "date_start" => "2019-06-20",
//                "date_end" => "2019-08-31"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 250,
//                'type' => 'przyczepa',
//                "description" => "input_wysoki_2_price",
//                "season" => "wysoki",
//                "date_start" => "2019-04-27",
//                "date_end" => "2019-05-05"
//            ));
//            //Kamper
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 350,
//                'type' => 'kamper',
//                "description" => "input_niski_price",
//                "season" => "niski",
//                "date_start" => "2018-10-01",
//                "date_end" => "2019-04-26"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 450,
//                'type' => 'kamper',
//                "description" => "input_sredni_price",
//                "season" => "sredni",
//                "date_start" => "2019-09-01",
//                "date_end" => "2019-09-30"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 450,
//                'type' => 'kamper',
//                "description" => "input_sredni_2_price",
//                "season" => "sredni",
//                "date_start" => "2019-05-06",
//                "date_end" => "2019-06-19"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 550,
//                'type' => 'kamper',
//                "description" => "input_wysoki_price",
//                "season" => "wysoki",
//                "date_start" => "2019-06-20",
//                "date_end" => "2019-08-31"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 550,
//                'type' => 'kamper',
//                "description" => "input_wysoki_2_price",
//                "season" => "wysoki",
//                "date_start" => "2019-04-27",
//                "date_end" => "2019-05-05"
//            ));
//            //Samochód
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 200,
//                'type' => 'samochod',
//                "description" => "input_niski_price",
//                "season" => "niski",
//                "date_start" => "2018-10-01",
//                "date_end" => "2019-04-26"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 200,
//                'type' => 'samochod',
//                "description" => "input_sredni_price",
//                "season" => "sredni",
//                "date_start" => "2019-09-01",
//                "date_end" => "2019-09-30"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 200,
//                'type' => 'samochod',
//                "description" => "input_sredni_2_price",
//                "season" => "sredni",
//                "date_start" => "2019-05-06",
//                "date_end" => "2019-06-19"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 200,
//                'type' => 'samochod',
//                "description" => "input_wysoki_price",
//                "season" => "wysoki",
//                "date_start" => "2019-06-20",
//                "date_end" => "2019-08-31"
//            ));
//            $wpdb->insert($this->table->kamperowanicalculatortable(),array(
//                "price" => 200,
//                'type' => 'samochod',
//                "description" => "input_wysoki_2_price",
//                "season" => "wysoki",
//                "date_start" => "2019-04-27",
//                "date_end" => "2019-05-05"
//            ));
    }

}
