# libsjte-php
PHP Implementation of the Steinhaus–Johnson–Trotter Algorithm with Even's speedup for calculating all possible permutations of a given set.

Implements the Steinhaus-Johnson-Trotter Algorithm in a form that can be used like an iterator. It has been heavily optimized, using the various language constructs of php.

## Use

If you wish to use the most optimized version simply use sjtePermutation. You can use it in a for loop as so

```php
$perm = new sjtePermutation(array(1,2,3,4));
for(sjtePermutation::rewind($perm);sjtePermutation::next($perm);sjtePermutation::valid($perm)){
    $current = sjtePermutation::current($perm);
    $reverse = array_reverse($current);
    $key = sjtePermutation::key($key);
    /*stuffs and things and stuff*/
}
```
or like so

```php
$perm = new sjtePermutation(array(1,2,3,4));
for($perm::rewind($perm);$perm::next($perm);$perm::valid($perm)){
    $current = $perm::current($perm);
    $reverse = array_reverse($current);
    $key = $perm::key($key);
    /*code!!!*/
}
```

If speed is not your concern. I have included an iterator implementation allowing use in a foreach loop.

```php
$perm = new sjtePermutationWrapper(array(1,2,3,4));
foreach($perm as $key => $current){
    $reverse = array_reverse($current);
    /*do magical stuff*/
}
```

## Why STJE?

I created this library for a /r/DailyProgrammer challenge. It had to do with calculating all possible solutions to a particular problem set. This is obviously a problem requiring permutations.

There is no included library in PHP for permutations, obviously since it is most often used as a Web Application language, and for what purpose would a web application calculate permutations.

A brief peruse of googles search results turned up recursive implementations. Which, if you don't know anything about PHP can be a problem. Most installations of PHP have in it's configuration a maximum stack function nesting value, limiting the possible recursion level of function calls. When you want to calculate a couple million permutations you can imagine that that would quickly become a problem.

You can easily change this setting if you access to the php.ini for your installation or have a php configuration that allows you change ini values dynamically with `ini_set`. But then you have that pesky little problem called limited memory... Which, if you, like me, are testing your code on a different machine that you develop it, a digital ocean vps for example, and don't want to shell out your hard earned cash to upgrade the memory of your machine, vps, whatever, can quickly become a problem and will eventually result in what php gives you, a segfault. So how do you calculate millions of permutations without using too much memory or without recursion. A non-recursive implementation of permutation calculation. Better yet, a symmetrical permutation algorithm, which, is what STJ is.

STJ calculates a permutation of a given set by swapping pairs of the set in a calculated order. This calculation can be sped up by caching the direction of each item's movement and the order of the swaps that you have yet to commit, the Even's Speedup. This algorithm results in a symmetrical set of permutations. This allows you to simply calculate half of the possible permutations, and then when you evaluate a particular permutation, evaluate the reverse of it. This allows for the calculation time to be cut in half. Which, when you are calculating millions of permutations can be significant.

Another interesting note is that the STJE algorithm will always calculate permutations in the same order. Which is actually what the value `stjePermutation::key()` returns. This implementation does not cache any of the calculated permutations to save on memory space. So if you wish to have say the 21001st calculated permutation, you can a) store it yourself, or b) recalculate it. The 21001st permutation of any set with at least 21001 permutations will always be the same as long as the set is not altered in any way.

## Ye gods, whatta meesa sayin'?

Yes stjePermutation.php is not the prettiest thing in the php universe, and there is a reason for that. In php pretty things are not particularly fast things... PHP has many quirks that make it an interesting language to optimize. If you wish to know why I do something the way I do you can read up about 'php micro optimization' on google.

There are many differing opinions about what works and what doesn't and why. I have found that most articles on it know what they are talking about, kind-of. I ran through many different versions of my code until I came to this version that while still implementing some idea of OOD does not sacrifice too much speed to do so.

Just little things like making the methods of stjePermutation static, and hoisting, and using local references improved benchmarks considerably. In it's current form stjePermutation can calculate about 20k permutations in a approximately a quarter of a second.

## Benchmarks
All benchmarks below were ran on php 5.5.9 in a Digital Ocean vps with 512 mb.
