<?php
namespace thyseus\files\behaviors;

use thyseus\files\models\File;
use yii\base\Behavior;

class HasFilesBehavior extends Behavior
{
    public function getFiles()
    {
        $identifierAttribute = 'id';

        if (method_exists($this->owner, 'identifierAttribute'))
            $identifierAttribute = $this->owner->identifierAttribute();

        return $this->owner->hasMany(File::className(), ['target_id' => $identifierAttribute]);
    }
}