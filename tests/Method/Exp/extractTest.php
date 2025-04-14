<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

class formatByPatternTest extends TestCase
{
    function test()
    {
        // Basic extraction
        $this->assertSame(['last_4' => '5000'], Exp::extract('4242-4242-4242-5000', '*-*-*-{last_4}'));
        $this->assertSame(['last_4' => '{5000}'], Exp::extract('4242-4242-4242-{5000}', '*-*-*-{last_4}'));
        $this->assertSame(['area_code' => '800'], Exp::extract('Phone Number: 1-(800)-555-5555', '*1-({area_code})-*'));
        $this->assertSame(['email' => 'john.doe@example.com'], Exp::extract('Contact us at john.doe@example.com.', '* at {email}.'));
        $this->assertSame(['user_id' => '1', 'post_id' => '2'], Exp::extract('/users/1/posts/2', '/users/{user_id}/posts/{post_id}'));
        $this->assertSame(['day' => '1st', 'month' => 'January'], Exp::extract('My birthday is on the 1st of January', 'My birthday is on the {day} of {month}'));
        $this->assertSame(['street' => '123 Main St', 'city' => 'Anytown', 'region' => 'CA'], Exp::extract('The address is 123 Main St, Anytown, CA.', '*address is {street}, {city}, {region}.'));

        // Extraction with wildcard
        $this->assertSame(['user_id' => '1', 'post_id' => '2'], Exp::extract('/users/1/posts/2', '/users/{user_id}/posts/{post_id}'));
        $this->assertSame(['user_id' => '1', 'post_id' => '2'], Exp::extract('/users/1/posts/2', '/users/{user_id}*posts/{post_id}'));
        $this->assertSame(['user_id' => '1?', 'post_id' => '2-'], Exp::extract('/users/1?/posts/2-', '/users/{user_id}/posts/{post_id}'));
        $this->assertSame(['user_id' => '1_a', 'post_id' => '2.b'], Exp::extract('/users/1_a/posts/2.b', '/users/{user_id}/posts/{post_id}'));
        $this->assertSame(['user_id' => '1', 'post_id' => '2'], Exp::extract('/users/1/posts/2/comments', '/users/{user_id}/posts/{post_id}/*'));
        $this->assertSame(['user_id' => '1', 'post_id' => '2'], Exp::extract('https://foo.com/users/1/posts/2/comments', '*users/{user_id}/posts/{post_id}/*'));

        // Extraction with multiple wildcards
        $this->assertSame(['user_id' => '1', 'post_id' => '2'], Exp::extract('/users/1/posts/2/comments/3', '*/users/{user_id}/posts/{post_id}/*'));
        $this->assertSame(['user_id' => '1', 'comment_id' => '3'], Exp::extract('/users/1/posts/2/comments/3/replies/4', '*users/{user_id}/*/comments/{comment_id}*'));
        $this->assertSame(['user_id' => '1', 'post_id' => '2', 'comment_id' => '3'], Exp::extract('/users/1/posts/2/comments/3/replies/4', '/users/{user_id}/posts/{post_id}*/comments/{comment_id}*'));

        // Extraction with numbers and sequences in the pattern
        $this->assertSame(['id' => '123'], Exp::extract('ID: 123, ID: 456', 'ID: {id},*'));
        $this->assertSame(['param' => 'with.dots'], Exp::extract('?param=with.dots&another=value', '?param={param}&*'));
        $this->assertSame(['file_name' => '123-abc'], Exp::extract('/files/123-abc.pdf', '/files/{file_name}.pdf'));
        $this->assertSame(['file_name' => '123-abc'], Exp::extract('/user/home/files/123-abc.pdf', '*/{file_name}.pdf'));
        $this->assertSame(['file_name' => 'my_file_(1).txt'], Exp::extract('/path/to/my_file_(1).txt', '/path/to/{file_name}'));
        $this->assertSame(['product_id' => 'abc-123', 'category' => 'electronics'], Exp::extract('/products/abc-123/electronics', '/products/{product_id}/{category}'));
        $this->assertSame(['uuid' => 'a1b2c3d4-e5f6-7890-1234-567890abcdef'], Exp::extract('/users/a1b2c3d4-e5f6-7890-1234-567890abcdef/profile', '/users/{uuid}/profile'));

        // Edge cases
        $this->assertSame(['foo' => '{bar}'], Exp::extract('{bar}', '{foo}'));
        $this->assertSame(['foo' => '{bar}'], Exp::extract('{\\{bar}\\}', '*{\{foo}\}*'));
        $this->assertSame(['foo' => '{bar}'], Exp::extract('foo bar* {{bar}}', '* {{foo}}'));
        $this->assertSame(['foo' => 'bar'], Exp::extract('{(|\*&!@$/\bar/|*}', '*/\{foo}/*'));
        $this->assertSame(['foo' => '{{bar}}'], Exp::extract('foo bar {{{bar}}}', '* {{foo}}'));
        $this->assertSame(['foo' => 'bar'], Exp::extract('{(|\*&!@$/\bar/|}', '{(|\*&!@$/\{foo}/|}'));
        $this->assertSame(['foo' => '{bar}'], Exp::extract('Example: \\{{bar}\\}', 'Example: \\{{foo}\\}'));
        $this->assertSame(['first' => '131415*\\', 'second' => '\\d+d'], Exp::extract('123/131415*\\/\\d+d/7\\8\\9/101112', '*/{first}/{second}/*'));

        $this->assertSame([], Exp::extract('/users/1/posts/2', '')); // Empty pattern
        $this->assertSame([], Exp::extract('', '/users/{user_id}/posts/{post_id}')); // Empty haystack
        $this->assertSame([], Exp::extract('/users/1/posts', '/users/{user_id}/posts/{post_id}')); // Missing segment in haystack
        $this->assertSame([], Exp::extract('/users/1/posts/2', '/users/{user_id}/posts/{post_id}/comments/{comment_id}')); // Missing segment
    }
}
