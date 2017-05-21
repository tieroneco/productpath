<?php
namespace app\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class LogoUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $logoFile;

    public function rules()
    {
        return [
            [['logoFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $fileName = \yii::getAlias('@web').'logo/' . $this->logoFile->baseName . '.' . $this->logoFile->extension;
            $this->logoFile->saveAs($fileName);
            Image::getImagine()->open($fileName)->thumbnail(new Box(155, 24))->save($fileName , ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }
}