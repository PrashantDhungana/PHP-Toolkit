## PHP Toolkit - Utility and Helper Library for Business Applications

This library holds commonly used helper functions used in many business applications. All features used PHP's native APIs and there are no third party dependencies.

### Installation

Install via composer

```
composer require elegantmedia/php-toolkit
```

### Available Commands

#### Array Helpers

``` php
use \ElegantMedia\PHPToolkit\Arr;

// Check if an array is an associative array
Arr::isAssoc($array);

// get matching subset of array. Similar to `array_intersect`, but does recursively.
Arr::intersectRecursiveintersectRecursiveintersectRecursive($source, $subset);

// Implode, but exclude empty values
Arr::implodeIgnoreEmpty($array);
```

#### Conversions

``` php
use \ElegantMedia\PHPToolkit\Conversion;

// Convert bytes to a human readble format
// Example output: '200 KB', '1 MB', '3 TB' etc
Conversion::bytesToHumans($bytes, $precision = 2);

// Converts a string with numbers to a full number
// Example: 1,232.12 -> becomes -> (int) 1232
Conversion::stringToInt($string);

// Convert a string numeric to a float
// Example: 1,232.12 -> becomes -> (float) 1232.12
Conversion::stringToFloat($value);
```

#### Directory Handling

``` php
use \ElegantMedia\PHPToolkit\Dir;

// Create a directory if it doesn't exist
Dir::makeDirectoryIfNotExists($dirPath, $permissions = 0775, $recursive = true);

// Delete a directory
Dir::deleteDirectory($dirPath);

// Delete files in a directory by extension
Dir::cleanDirectoryByWildcard('/my-dir-path/', 'txt');

// Delete files in a directory by (glob) wildcard
Dir::cleanDirectoryByWildcard('/my-dir-path/', '*.txt');
```

#### File Editor

``` php
use \ElegantMedia\PHPToolkit\FileEditor;

// Append a stub to a file, identified by the unique first line
FileEditor::appendStubIfSectionNotFound($filePath, $stubPath)

// Append a stub to a file
FileEditor::appendStub($filePath, $stubPath, $verifyPathsExists = true)

// Check if a string is in file
FileEditor::isTextInFile($filePath, $string, $caseSensitive = true)

// Check if two files are similar (by size and hash)
FileEditor::areFilesSimilar($path1, $path2)

// Read the first line from a file
FileEditor::readFirstLine($filePath, $trim = true);

// Get the classname and namespace from a while (by reading the file)
FileEditor::getClassname('/my-path/file.php');
```


#### Loader

``` php
use \ElegantMedia\PHPToolkit\Loader;

// Include all php files from a given directory
Loader::includeAllFilesFromDir($dirPath);

// Include all files recursively
Loader::includeAllFilesFromDirRecursive($dirPath);
```

#### Path

``` php
use \ElegantMedia\PHPToolkit\Path;

Path::withEndingSlash($path);
Path::withoutEndingSlash($path);
Path::withoutStartingSlash($path);

// remove dot segments from paths
// Example: Convert `/folder1/folder2/./../folder3` to `/folder1/folder3`
Path::canonical($path);
```

#### Reflector

``` php
use ElegantMedia\PHPToolkit\Reflector;

// Get an inherited class' directory path
Reflector::classPath($object, $pathSuffix = null);
```

#### Text

``` php
use \ElegantMedia\PHPToolkit\Text;

// Convert a block of text and split it into lines
/*
Example:
one, two,   three
four
five

Returns:
['one', 'two', 'three', 'four', 'five']
*/
Text::textToArray($text, $delimiters = null);

// Convert an 'existing_snake_case' to 'existing snake case'
Text::reverseSnake($string);

// Generate a random string without any ambiguous characters
// So it'll be easier to spell or read. For example, `AIilO01` will not be generated.
Text::randomUnambiguous($length = 16)
```

#### Timing
``` php
use \ElegantMedia\PHPToolkit\Timing;

// Get formatted microtimestamp. Example: `2008_07_14_010813.98232`
Timing::microTimestamp()
```

### Global Functions

#### Validation

``` php
// Check all values are !empty. Throws an exception if at least one value is empty
// if APP_DEBUG=true ENV variable is set, you'll be able to see which variable was missing
validate_all_present();

// Example: validate_all_present($var1, $var2, $var5)
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

Copyright (c) 2020 Elegant Media.
















