<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Controller extends BaseCommand
{
    protected $group       = 'Controller';
    protected $name        = 'make:controller';
    protected $description = 'Dynamically create a controller file for you with preset codes';

    public function run(array $params)
    {
        helper('filesystem');
        $dpath = $params[0];
        $minePath = APPPATH.'Controllers/'.$dpath;
        
        //* Create a controller file
        $data = file_get_contents(WRITEPATH.'zub_ci4/controller.conf');
        $file = end($params).'.php';
        $path = APPPATH.'Controllers/'.$dpath.'/'.$file;
        $data = str_replace("%names%", str_replace("~~", "", "Controllers\~~".$dpath), $data);
        $className = end($params);

        //* Check for folders
        if(! is_dir($minePath))
        {
            mkdir($minePath, 0755);
        }

        //* Write the file
        $data = str_replace('%classname%', $className, $data);
        write_file($path, $data);
        CLI::write("{$params[1]} has been created Successfully!", 'green');
    }
}