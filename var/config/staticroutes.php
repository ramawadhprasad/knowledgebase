<?php 

return [
    1 => [
        "id" => 1,
        "name" => "articles",
        "pattern" => "/(.*)_b([\\d]+)/",
        "reverse" => "%prefix/%text_b%id",
        "module" => NULL,
        "controller" => "@AppBundle\\Controller\\ArticleController",
        "action" => "detail",
        "variables" => "text,id",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 1,
        "legacy" => FALSE,
        "creationDate" => 1543580436,
        "modificationDate" => 1548167992
    ],
    2 => [
        "id" => 2,
        "name" => "kb_login",
        "pattern" => "@^/secure/login\$@",
        "reverse" => "/secure/login",
        "module" => NULL,
        "controller" => "@AppBundle\\Controller\\SecureController",
        "action" => "login",
        "variables" => "",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1548238034,
        "modificationDate" => 1548490427
    ],
    3 => [
        "id" => 3,
        "name" => "kb_logout",
        "pattern" => "@^/secure/logout\$@",
        "reverse" => "/secure/logout",
        "module" => NULL,
        "controller" => "@AppBundle\\Controller\\ArticleController",
        "action" => "logout",
        "variables" => "",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1548238168,
        "modificationDate" => 1548490420
    ],
    4 => [
        "id" => 4,
        "name" => "kb_ask",
        "pattern" => "@^/questions/ask\$@",
        "reverse" => "/questions/ask",
        "module" => NULL,
        "controller" => "@AppBundle\\Controller\\ArticleController",
        "action" => "ask",
        "variables" => "",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1548317098,
        "modificationDate" => 1548500029
    ],
    5 => [
        "id" => 5,
        "name" => "kb_register",
        "pattern" => "@^/secure/register\$@",
        "reverse" => "/secure/register",
        "module" => NULL,
        "controller" => "@AppBundle\\Controller\\SecureController",
        "action" => "register",
        "variables" => "",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1548429019,
        "modificationDate" => 1548490417
    ],
    6 => [
        "id" => 6,
        "name" => "kb_users",
        "pattern" => "@^/kbusers/index\$@",
        "reverse" => "/kbusers/index",
        "module" => NULL,
        "controller" => "@AppBundle\\Controller\\UserController",
        "action" => "index",
        "variables" => "",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1548576163,
        "modificationDate" => 1548577942
    ]
];
