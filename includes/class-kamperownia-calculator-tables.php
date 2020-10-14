<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class   Kamperownia_Calculator_Tables{
    
    public function kamperowanicalculatortable(){
            global $wpdb;
            return $wpdb->prefix.'kamperowniacalculator';
        }
    
}

