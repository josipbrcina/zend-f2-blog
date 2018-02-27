<?php

namespace Blog\Service;

use Blog\Entity\Post;

class BlogServiceImpl implements BlogService
{
    /**
     * @var \Blog\Repository\PostRepository $postRepository
     */
    protected $postRepository;

    /**
     * @return \Blog\Repository\PostRepository
     */
    public function getPostRepository()
    {
        return $this->postRepository;
    }

    /**
     * @param \Blog\Repository\PostRepository $postRepository
     */
    public function setPostRepository($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Saves a blog post
     * @param Post $post
     * @return Post
     */
    public function save(Post $post)
    {
        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param $page int
     * @return \Zend\Paginator\Paginator
     */
    public function fetch($page)
    {
        return $this->postRepository->fetch($page);
    }

    /**
     * @param $categorySlug string
     * @param $postSlug string
     *
     * @return Post|null
     */
    public function find($categorySlug, $postSlug)
    {
        return $this->postRepository->find($categorySlug, $postSlug);
    }

    /**
     * @param $postId
     *
     * @return Post|null
     */
    public function findById($postId)
    {
        return $this->postRepository->findById($postId);
    }

    /**
     * @param Post $post
     * @return void
     */
    public function update(Post $post)
    {
        $this->postRepository->update($post);
    }
}
