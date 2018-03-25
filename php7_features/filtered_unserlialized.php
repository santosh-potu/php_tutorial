<?php
ini_set('display_errors', 'on');
set_include_path('..'.DIRECTORY_SEPARATOR.'php_code'.DIRECTORY_SEPARATOR);
require_once 'library'.DIRECTORY_SEPARATOR.'config.php';

$x = <<<EOF
        class User{
    public $ name;
    public function __construct($ name) {
        $ this->name = $ name;
    }
}

class Admin extends User{
    public \$superpowers = true;
}

\$lynda = new User('Lynda');
\$string = serialize(\$lynda);
echo \$string;

$ bad_string = str_replace('4:"User"', '5:"Admin"', $ string);

echo $ bad_string;


$ new_user = unserialize($ bad_string);

echo ' Name:<br/>';
echo $ new_user->name;
echo ' Class:<br/>';
echo get_class($ new_user);



echo $ new_user->superpowers? 'true':'false';

$ options = array('allowed_classes'=>false);

$ new_user = unserialize($ bad_string,$ options);

var_dump($ new_user);

echo get_class($ new_user);
               
EOF;

echo nl2br($x);
class User{
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
}

class Admin extends User{
    public $superpowers = true;
}

$lynda = new User('Lynda');
$string = serialize($lynda);
echo $string;

$bad_string = str_replace('4:"User"', '5:"Admin"', $string);
echo '<br/>';
echo $bad_string;

echo '<br/>';
$new_user = unserialize($bad_string);

echo ' Name:<br/>';
echo $new_user->name;
echo ' Class:<br/>';
echo get_class($new_user);

echo '<br/>';

echo $new_user->superpowers? 'true':'false';

$options = array('allowed_classes'=>false);

$new_user = unserialize($bad_string,$options);

echo ' <br/>';
var_dump($new_user);
echo ' <br/>Class:<br/>';
echo get_class($new_user);
/*
 * Now, all of those Is and Ss and everything in there have meaning to PHP because what we want is a flat represenation of this complex structure and then later we can call unserialize on it and it turns it back into the data structure. In this case, an array. Then we can work with it like an array. I can tell the array to return me the item in index 2 and I get back c. Now, that's working with an array. We can do the same thing if we have an object. Let's say we have a class like User and I'm going to put an attribute in that class.

It's going to be name and the construct function, we'll just set that attribute equal to whatever value's passed in. I instantiate a new user and I pass in Lynda as the name. I now have a user object, an instance stored in user. I can call serialize on that and the string that I get back will be a representation of that object and you can see that it has the attribute and it has the values of that instance stored in it. Again, the main reason we want to serialize it and turn it into a string is because probably later we're going to want to unserialize that same string.

When we call unserialize on the string, we get back that complex data structure, in this case an object. An instance of user. Then we can call name it on it. We can ask it for its class and it'll tell us that its class is user. Okay, so that's how serialize and unserialize work and that's true in both PHP 5 and PHP 7. That hasn't changed, but let's image for a moment that we have a second class for Admin which is going to extend our user class. The key difference is that an Admin gets some kind of extra permissions that a normal user would not have.

Okay, now let's look at our string again. Let's suppose that a hacker was able to modify our string. Maybe we serialized this string and we stored it in the database and they used an SQL injection to make changes or maybe the string was stored in a browser cookie or session and they were able to edit it. I'm going to simulate this by just using string replace in order to replace 4:User with 5:Admin inside my string and I'll take those results and I'll store it in bad string just so we can really see the difference.

It's labeled bad string now. Now, the reason I changed 4: to 5: is because that number is significant. It says how many characters there are, how long the string is. User has four characters so it has a four in front of it. Admin has five characters so it has a five in front of it, but once I make that substitution in my bad string, then this is a perfect serialization of an Admin object. If we call unserialize on that bad string, PHP happily does the job for us and it unserializes it and turns it into an Admin object.

You can see that with get class, we get back the class of Admin. We ask it does it have super powers? The answer is true. A hacker has been able to transform whatever entry was from a basic user into a Admin user with super powers now. That's potentially very bad. What PHP 7 gives us is the opportunity to filter out the classes that are allowed to be serialized and that's because now unserialize takes a second argument which is an options array.

In that options array, there's really only one possible value at the moment which is allowed_classes. By default, that's set to true. If you don't pass anything, it's the same as having allowed classes true and it allows all classes through, just like PHP 5 did. However, if we pass in allowed classes false, now it won't serialize any classes for us. Instead, what it will do is it will turn it in to a fake class, something that it calls __PHP_Incomplete_Class and that's going to be the class of the object.

It does perform the unserialization for you. You do get back an object, but it's not one of your classes. It's the special PHP class instead and that's more safe. Now, there are times when you do want to allow things to be serialized and in that case, you can white list the classes you want to allow. We can have our options array. Instead of having allowed classes false, it can be equal to an array of the classes we want to allow. Here, I'm just using one which is user, but you can easily have comma and then another class after that, another class after that, and so on.

I'm taking that option array and I'm passing it in. Now, when I unserialize the bad string which is still Admin, it still comes up with that PHP incomplete class object, but if I use my good string, well now it's allowed to pass through because it's been white listed. Therefore, when I call get class on that new object, I get back the class of user, as we would want. To recap, unserialize works exactly the same way as it did in PHP 5, as it does in 7 by default. What PHP 7 adds is the ability to control the allowed classes through this extra options argument.

You can turn off all classes or you can white list only the classes you want to allow.
 */
