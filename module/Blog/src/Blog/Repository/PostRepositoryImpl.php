<?php

namespace Blog\Repository;

use Blog\Entity\Hydrator\CategoryHydrator;
use Blog\Entity\Hydrator\PostHydrator;
use Blog\Entity\Post;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

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

    public function fetchAll()
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->columns([
            'id',
            'title',
            'slug',
            'content',
            'created'
        ])
            ->from(['p' => 'post'])
            ->join(
                ['c' => 'category'], // Table name
                'c.id = p.category_id', // Condition
                ['category_id' => 'id', 'name', 'category_slug' => 'slug']  // Columns
            )
            ->order('p.id DESC');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new Post());
        $resultSet->initialize($result);

        $posts = [];

        foreach ($resultSet as $post) {
            /**
             * @var \Blog\Entity\Post $post
             */
            $posts[] = $post;
        }

        return $posts;
    }
}
