<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property string $nama_kategori
 * @property int $id_kategori
 *
 * @property Artikel[] $artikels
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kategori'], 'required' ],
            [['nama_kategori'], 'match', 'pattern' => '/[A-Z0-9]/', 'message' => 'Huruf Besar'], //VAlidate with message
            [['nama_kategori'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nama_kategori' => 'Nama Kategori',
            'id_kategori' => 'Id Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtikels()
    {
        return $this->hasMany(Artikel::className(), ['id_kategori' => 'id_kategori']);
    }
}
