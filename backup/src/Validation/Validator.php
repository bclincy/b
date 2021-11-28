<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 11:41 AM
 */

namespace App\Validation;

use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;


class Validator
{
    protected $errors;

    /**
     * @param Request $req
     * @param array $rules
     * @return self $this
     */
    public function validate (Request $req, array $rules)
    {
        $request = $req->getParsedBody();
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucwords($field))->assert($request[$field]);
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function failed ()
    {
        return !empty($this->errors);
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }


}