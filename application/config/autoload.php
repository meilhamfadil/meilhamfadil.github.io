<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array("database", "session", "Template", "MyLibrary", "FormCreator", "Privileges", "Navigation");
$autoload['drivers'] = array();
$autoload['helper'] = array("url", "function");
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array("MyModel");
