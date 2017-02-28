<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($basePath = '')
    {

        $root = 'uploads/';

        $file = $basePath . '/' . date('Ym') . '/' . uniqid() . '.' . $this->imageFile->extension;

        if (!file_exists($root . dirname($file))) {
            mkdir(dirname($root . $file), 0777, true);
        }

        if ($this->validate()) {
            $this->imageFile->saveAs($root . $file);
            return $file;
        } else {
            return false;
        }
    }
}
