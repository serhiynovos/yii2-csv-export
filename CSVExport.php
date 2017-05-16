<?php
namespace serrg1994\csvexport;
use yii\base\Exception;

/**
 * Class for export array data to csv file
 *
 *
 * CSVExport::Export([
    'dirName' => Yii::getAlias('@webroot'),
    'fileName' => 'users.csv',
    'data' => [
            ['#', 'User Name', 'Email'],
            ['1', 'Serhiy Novoseletskiy', 'novoseletskiyserhiy@gmail.com']
        ]
    ]);
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
        static::$data = isset($options['data']) ? $options['data'] : [];
        static::$fileName = isset($options['fileName']) ? $options['fileName'] : 'file.csv';

        if (!isset($options['dirName'])) {
            throw new Exception('You must set dirName');
        }

        static::$dirName = $options['dirName'];

        if (static::$dirName[strlen(static::$dirName) - 1] !== '/') {
            static::$dirName .= '/';
        }

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
