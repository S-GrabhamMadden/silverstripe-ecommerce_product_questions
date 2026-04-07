<?php



/**
 * adds functionality to Products
 *
 *
 *
 */
class ProductQuestion_ProductVariationsAdditions extends DataExtension
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $many_many =
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'ProductQuestion_ProductVariationsAdditions';

    private static $many_many = array(
        'ProductAttributeTypes' => 'ProductAttributeType',
        'ProductAttributeValues' => 'ProductAttributeValue',
        'ProductVariations' => 'ProductVariation'
    );

    public function updateCMSFields(FieldList $fields)
    {
    }

    public function onAfterWrite()
    {
        //go through types to add to variations
        //go through values to add to variations
    }
}

