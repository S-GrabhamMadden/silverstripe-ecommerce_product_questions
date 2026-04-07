<?php

namespace Sunnysideup\EcommerceProductQuestions\Model;

use DataExtension;


/**
 * adds functionality to OrderItems
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
class ProductQuestion_OrderExtension extends DataExtension
{

    /**
     *
     * @return null | array
     */
    public function updateSubmitErrors()
    {
        $array = [];
        foreach ($this->owner->OrderItems() as $item) {
            if (!$item->AllRequiredQuestionsAnswered()) {
                $txt = _t("ProductQuestion.PROVIDE_MORE_INFORMATION", "Please answer question in relation to:");
                $array[$item->ID] = $txt." <em>".$item->getTableTitle()."</em>";
            }
        }
        return count($array) ? $array : null;
    }
}

