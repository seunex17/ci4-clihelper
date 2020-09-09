<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Model extends BaseCommand
{
    protected $group       = 'Model';
    protected $name        = 'make:model';
    protected $description = 'Dynamically create a model file for you with preset codes';

    public function run(array $params)
    {
        helper('filesystem');
        $dpath = $params[0];
        $minePath = APPPATH.'Models/'.$dpath;
        
        //* Create a mdoel file
        $data = file_get_contents(WRITEPATH.'zub_ci4/model.conf');
        $file = end($params).'.php';
        $path = APPPATH.'Models/'.$dpath.'/'.$file;
        $data = str_replace("%names%", str_replace("~~", "", "Models\~~".$dpath), $data);
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