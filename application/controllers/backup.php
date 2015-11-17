<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
        $cnt_backups = 14;
        $path = "../backups";
        $date = mktime(date("H")-CORRECTION_DATE, date("i"), date("s"), date("m"), date("d"), date("Y"));
        $dump_name2 = date("__Y-m-d__H-i-s__", $date)."dump.sql"; //имя файла
        $dump_name = "$path/$dump_name2.zip"; //имя архива
        
        $prefs = array(
                'tables'      => array(),  // Массив таблиц для бэкапа.
                'ignore'      => array(),           // Массив таблиц, не нужных в бэкапе 
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => $dump_name2,    // Имя файла - ТОЛЬКО ДЛЯ ZIP ФАЙЛОВ 
                'add_drop'    => TRUE,              // позволяем дописать параметр DROP TABLE в бэкап 
                'add_insert'  => TRUE,              // позволяем дописать параметр INSERT в бэкап 
                'newline'     => "\n"               // Символ новой строки 
              );
        
		// Загружаем класс DB utility
        $this->load->dbutil();
        
        // Создаем бэкап текущей бд и ассоциируем его с переменной 
        $backup =& $this->dbutil->backup($prefs);
        
        // Загружаем хелпер file и записываем бэкап в файл 
        $this->load->helper('file');
        write_file($dump_name, $backup);
        echo "Backup \"$dump_name\" created<br>";
        
        // Загружаем хелпер download и отправляем бэкап пользователю 
        //$this->load->helper('download');
        //force_download("$dump_name", $backup);
        
        //удаляем старые бэкапы
        $count = count(scandir($path))-2; //количество бэкапов
        while ($count>$cnt_backups)
        {
                $arr = scandir($path);
                $name = "$path/$arr[2]";
                echo "Backup \"$name\" removed<br>";
                $b = unlink($path."/".$arr[2]);
                $count = count(scandir($path))-2;
        }
	}
}