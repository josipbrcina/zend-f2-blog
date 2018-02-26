<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Add extends Form
{
    public function __construct()
    {
        parent::__construct('add');

        $title = new Element\Text('title');
        $title->setLabel('Title');
        $title->setAttribute('class', 'form-control');

        $slug = new Element\Text('slug');
        $slug->setLabel('Slug');
        $slug->setAttribute('class', 'form-control');

        $content = new Element\Textarea('content');
        $content->setLabel('Content');
        $content->setAttribute('class', 'form-control');

        $category = new Element\Select('category');
        $category->setLabel('Category');
        $category->setAttribute('class', 'form-control');
        $category->setValueOptions([
            1 => 'PHP',
            2 => 'Zend Framework',
            3 => 'MySQL',
        ]);

        $submit = new Element\Submit('submit');
        $submit->setValue('Add Post');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($title);
        $this->add($slug);
        $this->add($content);
        $this->add($category);
        $this->add($submit);
    }
}
