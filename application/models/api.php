<?php

/**
 * ACICRUD
 * @author Samuel Sanchez <samuel.sanchez.work@gmail.com>
 * @copyright © 2008 - 2009 - 2010 Samuel Sanchez - All rights reserved / Tous droits réservés
 * @tutorial Set the class name and the constructor method name to your model name, then rename 'table_name' into your sql table name.Optionnaly give the database group name to use or the database object to the second parameter of the parent constructor.
 *
 */
class api extends Acicrud {

    //CONSTRUCTOR   
   
    public function __construct()
    {
        parent::__construct('api');
    }

    //CUSTOM METHODS
     
}
 
?>