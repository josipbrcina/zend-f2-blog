<?php

namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Form\Add;
use Blog\InputFilter\AddPost;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([
            'paginator' => $this->getBlogService()->fetch($this->params()->fromRoute('page'))
            ]
        );
    }

    public function addAction()
    {
        $form = new Add();
        $variables = [
            'form' => $form,
            'success' => false
        ];

        if ($this->request->isPost()) {
            $blogPost = new Post();
            $form->bind($blogPost);
            $form->setInputFilter(new AddPost());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $this->getBlogService()->save($blogPost);
                $variables['success'] = true;
            }
        }

        return new ViewModel($variables);
    }

    public function viewPostAction()
    {
        $categorySlug = $this->params()->fromRoute('categorySlug');
        $postSlug = $this->params()->fromRoute('postSlug');
        $post = $this->getBlogService()->find($categorySlug, $postSlug);

        if ($post === null) {
            $this->getResponse()
                ->setStatusCode(Response::STATUS_CODE_404);
        }

        return new ViewModel([
            'post' => $post
        ]);
    }

    /**
     * @return \Blog\Service\BlogService
     */
    protected function getBlogService()
    {
        return $this->getServiceLocator()->get('Blog\Service\BlogService');
    }

}
