# PHP Functions Universe 🚀

**Complete collection of PHP functions with lazy loading**

## 📌 About the Project

A library that gathers all possible PHP functions in one place with a lazy loading system. No more needing to include dozens of separate files or heavy classes - functions are loaded only when they are actually needed.

## 🌟 Advantages

### 🚀 Complete Independence
- **No dependencies** - works on pure PHP
- **Compatible with any projects** - from legacy to modern ones
- **No Composer required** (though it supports it)

### 🏎 Lazy Loading
- Functions are loaded **only on first call**
- No unnecessary loading of unused code
- Works on the `autoload` principle, but for functions

### 🧠 Memory Efficiency
- **Lower** RAM consumption compared to static classes
- No overhead for class and method declaration
- Only the code that is actually used

### ⚡ Optimized Code
- All functions are minified
- Accelerated PHP parsing

## 🌟 Usage Features

### 🚀 Inside a Loop

#### Bad
```php
use \Inilim\Tool\Arr;

$array = [/** big array */];

foreach($array as $item){
    Arr::sortBy($item, 'key');
}
```
#### Good
```php
use \Inilim\Tool\Arr;

$array = [/** big array */];
$sortBy = Arr::__asClosure('sortBy');

foreach($array as $item){
    $sortBy($item, 'key');
}
```

### 🚀 Modifying an argument by reference "&"

```php
use \Inilim\Tool\Arr;

$array = ['a' => 1, 'b' => 2];

// Since the call goes through __callStatic(), arguments cannot be passed by reference.
// Such functions return a \Closure object with the implementation.
Arr::pull()($array, 'a');

/**
 * $array ['b' => 2]
 */

```

## 📥 Installation

```bash
composer require inilim/tools:dev-main
```