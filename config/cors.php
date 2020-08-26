<?php

return [

/*
|--------------------------------------------------------------------------
| Laravel CORS
|--------------------------------------------------------------------------
|
| allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
| to accept any value.
|
*/

'supportsCredentials' => false,
'allowedOrigins' => ['*'],
'allowedHeaders' => ['PUT,POST,DELETE,GET,OPTIONS'],
'allowedMethods' => ['Accept,Authorization,Content-Type'],
'exposedHeaders' => [],
'maxAge' => 0,

];