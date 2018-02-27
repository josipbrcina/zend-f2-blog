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
     * @param $page int
     * @return \Zend\Paginator\Paginator
     */
    public function fetch($page);

}
