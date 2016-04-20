<?php
namespace serrg1994\csvexport;
use yii\base\Exception;

/**
 * Created by PhpStorm.
 * User: serhiy
 * Date: 20.04.16
 * Time: 12:35
 */
class CSVExport
{
    private static $data;
    private static $dirName;
    private static $fileName;

    /**
     * @param array $options
     * @return string
     * @throws \yii\base\Exception
     */
    public static function Export(array $options = [])
    {
        static::$data = $options['data'] ? $options['data'] : [];
        static::$fileName = $options['fileName'] ? $options['fileName'] : 'file.csv';

        if (!isset($options['dirName'])) {
            throw new Exception('You must set dirName');
        }

        static::$dirName = $options['dirName'];

        return self::array2csv(static::$data, static::$dirName, static::$fileName);
    }

    /**
     * @param array $array
     * @param $dirName
     * @param $fileName
     * @return string
     */
    private static function array2csv(array &$array, $dirName, $fileName)
    {
        if (!is_dir($dirName)) {
            mkdir($dirName);
        }

        ob_start();
        $df = fopen($dirName . $fileName, 'w');
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        ob_get_clean();
        return $dirName . $fileName;
    }
}