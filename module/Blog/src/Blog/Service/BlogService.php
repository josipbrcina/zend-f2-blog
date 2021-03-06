<?php

namespace Blog\Service;

use Blog\Entity\Post;

interface BlogService
{
    /**
     * Saves a blog post
     *
     * @param Post $post
     * @param int $authorId
     *
     * @return void
     */
    public function save(Post $post, $authorId);

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

    /**
     * @param $postId
     *
     * @return Post|null
     */
    public function findById($postId);

    /**
     * @param Post $post
     * @return void
     */
    public function update(Post $post);

    /**
     * @param $postId
     * @return void
     */
    public function delete($postId);
}
