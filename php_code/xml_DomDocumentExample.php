<?php
require_once "library".DIRECTORY_SEPARATOR."config.php";
$page_numbers = array(
                '978-1594489501' => '384', // A Thousand Splendid Suns
                '978-1594489587' => '352', // The Brief Wondrous Life of Oscar Wao
                '978-0545010221' => '784', // Harry Potter and the Deathly Hallows
        );

$dom = new DOMDocument();
$dom->load('xml'.DIRECTORY_SEPARATOR.'books.xml');
$dompath = new DOMXPath($dom);

$books = $dompath->query('book');

foreach($books as $book)
{
        $book->appendChild($dom->createElement('pages', $page_numbers[$book->getAttribute('isbn')]));
}

$dom->save('xml'.DIRECTORY_SEPARATOR.'books2.xml');

display_books($dom);

$authors = $dompath->query('book/author');
foreach($authors as $author)
{
        $a          = $author->nodeValue; // shortcut
        $last_name  = substr($a, strrpos($a, ' ')+1);
        $first_name = substr($a, 0, strrpos($a, ' '));
        $author->nodeValue = "{$last_name}, {$first_name}";
}

$dom->save('xml'.DIRECTORY_SEPARATOR.'books3.xml');
display_books($dom);



$books = $dompath->query('book');
foreach($books as $book)
{
        $author     = $book->getElementsByTagName('author')->item(0);
        $a          = $author->nodeValue; // shortcut
        $last_name  = substr($a, strrpos($a, ' ')+1);
        $first_name = substr($a, 0, strrpos($a, ' '));
        
        $book->removeChild($author);
        $book->appendChild($dom->createElement('author_firstname', $first_name));
        $book->appendChild($dom->createElement('author_lastname', $last_name));
}

$dom->save('xml'.DIRECTORY_SEPARATOR.'books4.xml');

display_mybooks($dom);

function display_mybooks($dom){
    
  $books =  $dom->getElementsByTagName('book');
$tr = "";   
foreach($books as $book) {
    if($book->hasChildNodes()){
        $td = "";
        foreach($book->childNodes as $c){
           
          if($c->nodeType == XML_ELEMENT_NODE) { 
            if(strlen($tr)==0){
              $th .="<th>".ucfirst($c->nodeName)."</th>";
            }   
            $td .="<td>".$c->nodeValue."</td>";
          }
        }
        if(strlen($tr)==0){
              $tr = "<thead>$th</thead>";
          } 
        $tr .= "<tr>$td</tr>";
    }
    
}
echo <<<EOF
<table border='1'>
    $tr
 </table>
EOF;
}
function display_books($dom){

    $books =  $dom->getElementsByTagName('book');
    echo <<<EOF
<table border="1" >
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
    
    $authors = $book->getElementsByTagName( "author" );
  $author = $authors->item(0)->nodeValue;
  
  $publishers = $book->getElementsByTagName( "publisher" );
  $publisher = $publishers->item(0)->nodeValue;
  
  $titles = $book->getElementsByTagName( "title" );
  $title = $titles->item(0)->nodeValue;
  
  $amazon_prices = $book->getElementsByTagName( "amazon_price" );
 
  $amazon_price= $amazon_prices->item(0)->nodeValue;
  
        echo <<<EOF
        <tr>
                <td>{$title}</td>
                <td>{$author}</td>
                <td>{$publisher}</td>
                <td>{$amazon_price}</td>
                <td>{$book->getAttribute('isbn')}</td>
        </tr>

EOF;
}
echo '</table>';
}


?>
