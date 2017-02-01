<?php

namespace SpryngPaymentsApiPhp\Helpers;

use SpryngPaymentsApiPhp\Object\Mandate;
use SpryngPaymentsApiPhp\Object\Card;
use SpryngPaymentsApiPhp\Object\Customer;

class CustomerHelper
{

    static $SPECIAL_PARAMETERS = [
        'cards',
        'mandates'
    ];

    public static function fillCustomerObject($response)
    {
        $customer = new Customer();

        foreach($response as $key => $parameter)
        {
            if (!in_array($key, self::$SPECIAL_PARAMETERS))
            {
                $customer->$key = $parameter;
            }
            else
            {
                switch($key)
                {
                    case 'cards':
                        foreach($response->$key as $customerCard)
                        {
                            $card = new Card();
                            $card->_id = $customerCard;
                            array_push($customer->cards, $card);
                        }
                        break;
                    case 'mandates':
                        foreach($response->$key as $customerMandate)
                        {
                            $mandate = new Mandate(
                                $customerMandate->merchant,
                                $customerMandate->processor,
                                $customerMandate->reference,
                                $customerMandate->signed_at,
                                $customerMandate->status,
                                $customerMandate->_type
                            );
                            array_push($customer->mandates, $mandate);
                        }
                        break;
                }
            }
        }

        return $customer;
    }

    public static function validateNewCustomerArguments($arguments)
    {

    }
}