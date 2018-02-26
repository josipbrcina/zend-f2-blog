<?php

namespace Blog;

use Blog\Service\BlogServiceImpl;

return [
    'invokables' => [
        'Blog\Service\BlogService' => BlogServiceImpl::class,
    ]
];
