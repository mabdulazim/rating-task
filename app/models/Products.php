<?php

namespace App\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Regex as RegexValidator;

class Products extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $code;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            "code",
            new RegexValidator(
                [
                    "pattern" => "/^[0-9]{6}$/",
                    "message" => "code must be 6 digits"
                ]
            )
        );

        $validator->add(
            "name",
            new StringLength(
                [
                    "max"             => 150,
                    "min"             => 10,
                    "messageMaximum"  => "max length for name is 150 chars",
                    "messageMinimum"  => "min length for name is 10 chars",
                ]
            )
        );        

        $validator->add(
            "price",
            new DigitValidator(
                [
                    "message" => "Price must be numeric."
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cubicfox_task_db");
        $this->setSource("products");
        $this->hasMany('id', 'App\Models\Rates', 'product_id', ['alias' => 'Rates']);
        $this->belongsTo('user_id', 'App\Models\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'products';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products[]|Products|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
