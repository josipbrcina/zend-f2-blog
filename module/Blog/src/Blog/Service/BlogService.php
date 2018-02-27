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
     * Fetches all blog posts
     * @return Post[]
     */
    public function fetchAll();

}
