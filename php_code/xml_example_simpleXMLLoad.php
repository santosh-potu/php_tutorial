<?php

 
$string  = <<<XML
<?xml version='1.0'?> 
<document> 
    <cmd>login</cmd> 
    <login>Richard</login> 
</document> 
XML;
                                                                        
echo '<pre>';                                           
$xml = simplexml_load_string($string); 
print_r($xml); 
$login = $xml->login; 
print_r($login); 
$login = (string) $xml->login; 
print_r($login); 

//$books = new SimpleXMLElement('xml'.DIRECTORY_SEPARATOR.'books.xml', null, true);
$books = simplexml_load_file('xml'.DIRECTORY_SEPARATOR.'books.xml');
echo <<<EOF
<table>
        <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Price at Amazon.com</th>
                <th>ISBN</th>
        </tr>

EOF;
foreach($books as $book) // loop through our books
{
        echo <<<EOF
        <tr>
                <td>{$book->title}</td>
                <td>{$book->author}</td>
                <td>{$book->publisher}</td>
                <td>\${$book->amazon_price}</td>
                <td>{$book['isbn']}</td>
        </tr>

EOF;
}
echo '</table>';
$titles = $books->xpath('book/title');
foreach($titles as $title)
{
        echo '<br/>'.$title.PHP_EOL;
}
?> 

