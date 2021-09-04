<?php

return [
    [
        '/\/(?:user)\/([\d]+)/' => [
            'controller' => 'user',
            'action' => 'viewUser',
            'validator' => 'Regex'
        ]
    ]
];
