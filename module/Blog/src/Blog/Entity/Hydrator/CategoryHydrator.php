<?php

namespace Blog\Entity\Hydrator;

use Blog\Entity\Category;
use Blog\Entity\Post;
use Zend\Stdlib\Hydrator\HydratorInterface;

class CategoryHydrator implements HydratorInterface
{

    /**
     * Extract values from object
     * @param object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Post || $object->getCategory() === null) {
            return [];
        }

        /**
         * @var Category $category
         */
        $category = $object->getCategory();

        return [
          'id' => $category->getId(),
          'name' => $category->getName(),
          'slug' => $category->getSlug(),
        ];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof Post) {
            return $object;
        }

        $category = new Category();
        $category->setId(isset($data['id']) ? intval($data['id']) : null);
        $category->setName(isset($data['name']) ? $data['name'] : null);
        $category->setSlug(isset($data['slug']) ? $data['slug'] : null);
        $object->setCategory($category);

        return $object;
    }
}
