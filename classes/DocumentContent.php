<?php
namespace app\content;

use Slim\App;

class DocumentContent {
    private $app;

    function __construct(App $app)
    {
        $this->app = $app;
    }

    public function saveDocs ($doc)
    {
        return 'sweet ' . $doc;
    }
}