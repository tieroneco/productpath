<?php
namespace app\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;

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
            
            $this->logoFile->saveAs(\yii::getAlias('@web').'logo/' . $this->logoFile->baseName . '.' . $this->logoFile->extension);
            return true;
        } else {
            return false;
        }
    }
}