CHAOS.Portal.Client-PHP
=========================

This is a PHP Portal API Client. It enables easy communication with a CHAOS Portal API (protocol version 4).

## Requirements
 - PHP 5.3.5+ is required.
 - The CURL plugin must be enabled in PHP.
 - The iconv plugun must be enables in PHP (it is by default).

## Code
The source code is located in the *src* folder.  
The file structure matches the namesspaces used and should be preserved for easy use (see examples).  
All public functions and classes have been documented in-code with [PHPDoc](http://www.phpdoc.de/) syntax,
which should enable code completion and type hinting in most modern code IDE's.

## Tutorials
The tutorials are located in the *tutorials* folder.  
They can also be found online on [this project's Github pages](http://chaos-community.github.com/CHAOS.Portal.Client-PHP/).

## Examples
The examples are located in the *examples* folder.  
By default the examples will add *\_\_dir\_\_/../src* to the include path, this will allow PHP to locate the source files from the namespace.
Make sure to update this if you move the examples before running them (see **How to use PortalClient**).

## How to use PortalClient
Make sure the *CHAOS* folder (located in the *src* folder) is copied to a location where PHP is configured to look for classes.
This can be the same folder as the PHP-script that is using PortalClient, or a location added to the [include path](http://php.net/manual/en/function.set-include-path.php).
The examples all use the latter method.

## Tests
The tests are located in the *tests* folder and uses [PHPUnit](http://phpunit.de/manual/current/en/index.html) by Sebastian Bergmann.  
With the tests comes a handy script `run-tests`, located under *bin* , which is required to run the test suite. The tests *cannot* simply be run by `phpunit`.  

With the script you can:

 - Test different service providers
 - Test different protocol versions
 - Test different methods of authentication
 - Test different users
 - Test different data sets

In *tests/bin/* are different sample JSON files. Those include config files, with and without authentication using the `EmailPassword` extension, and data sets. If no data file is specified when running the script, it defaults to `default.json`.

If you want to run all tests (from the *tests* directory), using the CHAOS API v4 (*http://api.chaos-systems.com/v4/*):
    
    bin/run-tests --config chaos.v4 .
    
For more information on how to use the script, run it with the help argument
    
    bin/run-tests --help

##Reporting problems
If you encounter any problems using this project, please report them using the [Issues](https://github.com/CHAOS-Community/CHAOS.Portal.Client-PHP/issues) section of the projects Github page.

## Links
 - [Official CHAOS Community website](http://www.chaos-community.org/)
 - [This project on GitHub](https://github.com/CHAOS-Community/CHAOS.Portal.Client-PHP)
 - [Portal project on GitHub](https://github.com/CHAOS-Community/Portal)
 - [TypeScript (JavaScript) client on GitHub](https://github.com/CHAOS-Community/CHAOS.Portal.Client-TypeScript)
 - [.NET client on GitHub](https://github.com/CHAOS-Community/CHAOS.Portal.Client-.NET)

## License
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with this program.  If not, see <[http://www.gnu.org/licenses/](http://www.gnu.org/licenses/)>.

Copyright 2012 CHAOS ApS
