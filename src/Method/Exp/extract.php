<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author stevebauman <https://github.com/stevebauman>
 * Extract values from the haystack using the given template pattern.
 * @return array<string,string>
 */
function extract(string $haystack, string $pattern)
{
    $placeholders = \Inilim\Tool\Method\Str\matchAll('/\{([^{}]+)}/', $pattern);

    $pattern = \preg_quote($pattern, '/');

    foreach ($placeholders as $placeholder) {
        $pattern = \Inilim\Tool\Method\Str\replace(
            \preg_quote('{' . $placeholder . '}', '/'),
            '(?<' . $placeholder . '>[^\/]+?)',
            $pattern,
        );
    }

    $pattern = \Inilim\Tool\Method\Str\replace(
        ['\*', '\{', '\}'],
        ['.*?', '{', '}'],
        $pattern
    );

    if (\preg_match("/^$pattern$/i", $haystack, $matches)) {
        return \array_intersect_key($matches, \array_flip($placeholders));
    }

    return [];
}

// Usage

// // ['last_4' => '5000']
// Exp::extract(
//     '4242-4242-4242-5000', 
//     '*-*-*-{last_4}'
// );

// // ['area_code' => '800']
// Exp::extract(
//     'Phone Number: 1-(800)-555-5555', 
//     '*1-({area_code})-*'
// );

// // ['email' => 'john.doe@example.com']
// Exp::extract(
//     'Contact us at john.doe@example.com.', 
//     '* at {email}.'
// );

// // ['user_id' => '1', 'post_id' => '2']
// Exp::extract(
//     '/users/1/posts/2/comments', 
//     '/users/{user_id}/posts/{post_id}/*'
// );

// // ['day' => '1st', 'month' => 'January']
// Exp::extract(
//     'My birthday is on the 1st of January', 
//     'My birthday is on the {day} of {month}'
// );

// // ['Expeet' => '123 Main St', 'city' => 'Anytown', 'region' => 'CA']
// Exp::extract(
//     'The address is 123 Main St, Anytown, CA.', 
//     '*address is {street}, {city}, {region}.'
// );