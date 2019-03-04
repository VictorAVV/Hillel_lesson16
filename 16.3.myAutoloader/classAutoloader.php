<?php
/**
 * 3. Напишите свою реализацию класса Autoloader для автоматической загрузки классов
 */

class Autoloader {
    private static $loader;
    //список каталогов, где хранятся классы и интерфейсы
    private static $dirArray = array();

    public static function init()
    {
        if (self::$loader == NULL) {
            self::$loader = new self();
        }
        return self::$loader;
    }

    private function __construct()
    {
        spl_autoload_register(array($this,'loadClass'));
    }
    
    private function loadClass($class)
    {
        $file = realpath($class . '.php');
        if ($file) {
            include_once $file;
        } else {
            foreach (self::$dirArray as $dir) {
                $file = realpath($dir . DIRECTORY_SEPARATOR . $class . '.php');
                if ($file) {
                    include_once $file;
                    break;
                }   
            }
        }
    }

    public static function setDirectories($dirs)
    {   
        //убираем лишние пробелы в начале и в конце названий каталогов
        $dirs = explode(',', preg_replace('/,\s+/', ',', trim($dirs)));
        self::$dirArray = $dirs;
    }

    public static function addDirectory($dir)
    {   
        $dir = trim($dir);
        if (!in_array($dir, self::$dirArray)) {
            self::$dirArray[] = $dir;
        }
    }
    public static function removeDirectory($dir)
    {   
        $dir = trim($dir);
        $index = array_search($dir, self::$dirArray);
        if ($index) {
            unset(self::$dirArray[$index]);
            return true;
        }
        return false;
    }
    
    private function __clone()
    {
    }
    private function __sleep()
    {
    }
    private function __wakeup()
    {
    }
}

Autoloader::init();
$obj = new MyClass1();
echo '<br>';

//Autoloader::setDirectories(' controlers, classes,  interfaces,  ..\outerdir, ..\another directory   ');

Autoloader::addDirectory(' classes');
echo MyClass2::$msg;

Autoloader::addDirectory(' interfaces');
class Foo implements iTest {}

//Autoloader::removeDirectory(' interfaces');
