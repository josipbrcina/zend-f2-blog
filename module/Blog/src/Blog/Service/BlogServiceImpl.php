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
    }
}
