<?php

namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Form\Add;
use Blog\Form\Edit;
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
        ];

        if ($this->request->isPost()) {
            $blogPost = new Post();
            $form->bind($blogPost);
            $form->setInputFilter(new AddPost());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $this->getBlogService()->save($blogPost);
                $this->flashMessenger()->success('The post has been added!');
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

    public function editAction()
    {
        $form = new Edit();

        if ($this->request->isPost()) {
            $post = new Post();
            $form->bind($post);
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $this->getBlogService()->update($post);
                $this->flashMessenger()->addSuccessMessage('Post has been updated!');
            }
        } else {
            $post = $this->getBlogService()->findById($this->params()->fromRoute('postId'));

            if ($post === null) {
                $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            } else {
                $form->bind($post);

                $form->get('slug')->setValue($post->getSlug());
                $form->get('id')->setValue($post->getId());
                $form->get('category_id')->setValue($post->getCategory()->getId());
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function deleteAction()
    {
        $this->getBlogService()->delete($this->params()->fromRoute('postId'));
        $this->flashMessenger()->addSuccessMessage('The post has been deleted!');
        return $this->redirect()->toRoute('blog');
    }

    /**
     * @return \Blog\Service\BlogService
     */
    protected function getBlogService()
    {
        return $this->getServiceLocator()->get('Blog\Service\BlogService');
    }

}
