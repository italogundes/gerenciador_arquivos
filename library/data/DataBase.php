<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataBase
 *
 * @author PABLO
 */
require_once("AcessoDados.php");
require_once("library/config/config.php");
class DataBase {
    //put your code here

    function __construct()
    {
        // Cria na propriedade 'db' o objeto da classe Database
        $this->db = new AcessoDados(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

}
