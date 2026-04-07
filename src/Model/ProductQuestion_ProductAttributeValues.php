<?php



/**
 * adds functionality to Products
 *
 *
 *
 */

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD:  extends DataExtension (ignore case)
  * NEW:  extends DataExtension ...  (COMPLEX)
  * EXP: Check for use of $this->anyVar and replace with $this->anyVar[$this->owner->ID] or consider turning the class into a trait
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
class ProductQuestion_ProductAttributeValues extends DataExtension
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $many_many =
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'ProductQuestion_ProductAttributeValues';

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

