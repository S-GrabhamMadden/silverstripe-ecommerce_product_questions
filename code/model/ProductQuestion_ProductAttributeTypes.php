<?php



/**
 * adds functionality to Products
 *
 *
 *
 */
class ProductQuestion_ProductAttributeTypes extends DataExtension
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $many_many =
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'ProductQuestion_ProductAttributeTypes';

    private static $many_many = array(
        'ProductQuestions' => 'ProductQuestion'
    );

    public function updateCMSFields(FieldList $fields)
    {
    }

    public function onAfterWrite()
    {
        foreach ($this->ProductQuestions() as $question) {
            $question->write();
        }
    }
}

