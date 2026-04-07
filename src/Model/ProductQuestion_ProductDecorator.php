<?php

namespace Sunnysideup\EcommerceProductQuestions\Model;







use Sunnysideup\EcommerceProductQuestions\Model\ProductQuestion;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataExtension;





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
class ProductQuestion_ProductDecorator extends DataExtension
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $db
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'ProductQuestion_ProductDecorator';

    private static $db = array('ConfigureLabel' => 'Varchar(50)');

    private static $belongs_many_many = array('ProductQuestions' => ProductQuestion::class);

    public function updateCMSFields(FieldList $fields)
    {
        $productQuestions = ProductQuestion::get();
        if ($productQuestions->count()) {
            $fields->addFieldToTab("Root.Questions", new TextField("ConfigureLabel", _t("ProductQuestion.CONFIGURE_LINK_LABEL", "Configure link label")));
            $fields->addFieldToTab(
                "Root.Questions",
                $gridField = new CheckboxSetField(
                    'ProductQuestions',
                    _t("ProductQuestion.PLURAL_NAME", "Product Questions"),
                    ProductQuestion::get()->map("ID", "Title")->toArray()
                )
            );
        }
        $fields->addFieldToTab("Root.Questions", new LiteralField("EditProductQuestions", "<h2><a href=\"/admin/product-config/ProductQuestion/\">"._t("ProductQuestion.EDIT_PRODUCT_QUESTIONS", "Edit Product Questions")."</a></h2>"));
        foreach ($this->owner->ApplicableProductQuestions() as $productQuestion) {
            $fields->addFieldToTab(
                "Root.Questions",
                new LiteralField(
                    "EditProductQuestion".$productQuestion->ID,
                    "<h5><a href=\"".$productQuestion->CMSEditLink()."\">"._t("ProductQuestion.EDIT", "Edit")." ".$productQuestion->Title."</a></h5>"
                )
            );
        }
    }

    public function ProductQuestionsAnswerFormLink($id = 0)
    {
        return $this->owner->Link("productquestionsanswerselect")."/".$id."/?BackURL=".urlencode(Controller::curr()->Link());
    }

    /**
     * returns a label that is used to allow customers to open the form
     * for answering the Product Questions.
     * @return String
     */
    public function CustomConfigureLabel()
    {
        if ($this->HasProductQuestions()) {
            if ($this->owner->ConfigureLabel) {
                return $this->owner->ConfigureLabel;
            } else {
                return _t("ProductQuestion.CONFIGURE", "Configure");
            }
        }
    }

    /**
     * Does this buyable have product questions?
     * @return Boolean
     */
    public function HasProductQuestions()
    {
        if ($applicable = $this->owner->ApplicableProductQuestions()) {
            if ($applicable->count()) {
                return true;
            }
        }
        return false;
    }

    public function ApplicableProductQuestions()
    {
        $productQuestions = $this->owner->ProductQuestions();
        $productQuestionsArray = array(0 => 0);
        if ($productQuestions && $productQuestions->count()) {
            $productQuestionsArray = $productQuestions->map("ID", "ID")->toArray();
        }
        $productQuestionsForAll = ProductQuestion::get()->filter(array("ApplyToAllProducts" => 1));
        if ($productQuestionsForAll && $productQuestionsForAll->count()) {
            $productQuestionsForAllArray = $productQuestionsForAll->map("ID", "ID")->toArray();
            $productQuestionsArray += $productQuestionsForAllArray;
        }
        return ProductQuestion::get()->filter(array("ID" => $productQuestionsArray));
    }
}

