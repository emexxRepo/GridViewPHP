<?php
namespace Test;

require_once 'Core' . DIRECTORY_SEPARATOR . 'Layout' . DIRECTORY_SEPARATOR . 'Grid.php';
use Core\Layout\Grid;
use Core\Layout\Table;

try{
    $dbConnect = new \PDO("mysql:host=localhost;dbname=majormvc","root","123456");

}catch (\PDOException $e){
    echo $e->getMessage();
}

$dataSource = $dbConnect->query('SELECT * FROM users')->fetchAll(\PDO::FETCH_ASSOC);
print_r($dataSource);
echo Grid::view(
    [
        'type'          => new Table(600,300,1),
        'dataSource'    => $dataSource,
        'th'            => ['ID','Username','Password','Email','Fname','Lname'],
        'hiddenFields'   => ['deleted','acl'],
    ]
);
