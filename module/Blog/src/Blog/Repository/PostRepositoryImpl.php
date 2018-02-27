<?php

namespace Blog\Repository;

use Blog\Entity\Post;
use Zend\Db\Adapter\AdapterAwareTrait;

class PostRepositoryImpl implements PostRepository
{
    use AdapterAwareTrait;

    public function save(Post $post)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values([
                'title' => $post->getTitle(),
                'slug' => $post->getSlug(),
                'content' => $post->getContent(),
                'category_id' => $post->getCategory(),
                'created' => time()
            ])
            ->into('post');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
    }
}
