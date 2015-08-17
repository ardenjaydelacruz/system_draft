<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Countries extends ActiveRecord\Model {
    static $table_name = 'tbl_countries';
    static $primary_key = 'country_code';
}