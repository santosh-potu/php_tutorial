<?php
try{
$x = <<<'EOF'
        Interface Logger{
    public function log(string $msg);
}

class Application{
    private $ logger;
    
    public function setLogger(Logger $ logger){
        $ this->logger = $ logger;
    }
    
    public function getLogger(): Logger{
        return $ this->logger;
    }
}

$ app = new Application();
$ app->setLogger(new class implements Logger{
    public function log(string $ msg) {
        echo $ msg;
    }
});

var_dump($ app);
EOF;

echo nl2br($x);

Interface Logger{
    public function log(string $msg);
}

class Application{
    private $logger;
    
    public function setLogger(Logger $logger){
        $this->logger = $logger;
    }
    
    public function getLogger(): Logger{
        return $this->logger;
    }
}

$app = new Application();
$app->setLogger(new class implements Logger{
    public function log(string $msg) {
        echo $msg;
    }
});
echo '<br/>';
var_dump($app);
} catch (Throwable $e){
    echo '<br/>';
    echo $e->getMessage();
    echo '<br/>';
    echo $e->getLine();
    echo '<br/>';
    echo $e->getCode();
}