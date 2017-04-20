<?php
namespace common\models\project;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public static function tableName()
    {
        return 'm_image';
    }

    public function rules()
    {
        return [
            [['logo','product_id','imageFiles'],'safe'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload()
    {
//        if ($this->validate()) {
//            foreach ($this->imageFiles as $file) {
//                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
//            }
//            return true;
//        } else {
//            return false;
//        }

    }
}
?>