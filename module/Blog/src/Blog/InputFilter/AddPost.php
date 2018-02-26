<?php

namespace Blog\InputFilter;

use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

class AddPost extends InputFilter
{
    public function __construct()
    {
        $title = new Input('title');
        $title->setRequired(true);
        $title->setValidatorChain($this->getTitleValidatorChain());
        $title->setFilterChain($this->getStringTrimFilterChain());

        $slug = new Input('slug');
        $slug->setRequired(true);
        $slug->setValidatorChain($this->getSlugValidatorChain());
        $slug->setFilterChain($this->getStringTrimFilterChain());

        $content = new Input('content');
        $content->setRequired(true);
        $content->setValidatorChain($this->getContentValidatorChain());
        $content->setFilterChain($this->getStringTrimFilterChain());

        $this->add($title);
        $this->add($slug);
        $this->add($content);
    }

    /**
     * @return FilterChain
     */
    protected function getStringTrimFilterChain()
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());

        return $filterChain;
    }

    /**
     * @return ValidatorChain
     */
    protected function getContentValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(10);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    /**
     * @return ValidatorChain
     */
    protected function getSlugValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(5);
        $stringLength->setMax(50);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    /**
     * @return ValidatorChain
     */
    protected function getTitleValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(5);
        $stringLength->setMax(50);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }
}
