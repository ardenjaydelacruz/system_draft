<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Clients_model extends ActiveRecord\Model {
    static $table_name = 'tbl_client';
    static $primary_key = 'client_id';
}