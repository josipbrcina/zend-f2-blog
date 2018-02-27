<?php

namespace Blog\Service;

use Blog\Entity\Post;

interface BlogService
{
    /**
     * Saves a blog post
     * @param Post $post
     * @return Post
     */
    public function save(Post $post);

    /**
     * @param $page int
     * @return \Zend\Paginator\Paginator
     */
    public function fetch($page);

    /**
     * @param $categorySlug string
     * @param $postSlug string
     *
     * @return Post|null
     */
    public function find($categorySlug, $postSlug);
}
