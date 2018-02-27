<?php

namespace Blog\Repository;

use Application\Repository\RepositoryInterface;
use Blog\Entity\Post;

interface PostRepository extends RepositoryInterface
{
    /**
     * Saves a blog post
     * @param Post $post
     * @return mixed
     */
    public function save(Post $post);

    /**
     * Fetches all posts.
     * @return Post[]
     */
    public function fetchAll();

}
