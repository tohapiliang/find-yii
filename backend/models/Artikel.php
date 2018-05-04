<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "artikel".
 *
 * @property int $id
 * @property string $judul
 * @property string $isi_artikel
 * @property string $jumlah_baca
 * @property string $create_time
 * @property int $update_by
 * @property string $update_time
 * @property int $create_by
 * @property int $id_kategori
 *
 * @property Kategori $kategori
 * @property User $updateBy
 * @property User $createBy
 * @property Komentar[] $komentars
 */
class Artikel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artikel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['update_by', 'create_by', 'id_kategori'], 'default', 'value' => null],
            [['update_by', 'create_by', 'id_kategori'], 'integer'],
            [['judul', 'isi_artikel', 'jumlah_baca'], 'string', 'max' => 255],
            [['id_kategori'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::className(), 'targetAttribute' => ['id_kategori' => 'id_kategori']],
            [['update_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['update_by' => 'id']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'isi_artikel' => 'Isi Artikel',
            'jumlah_baca' => 'Jumlah Baca',
            'create_time' => 'Create Time',
            'update_by' => 'Update By',
            'update_time' => 'Update Time',
            'create_by' => 'Create By',
            'id_kategori' => 'Id Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['id_kategori' => 'id_kategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'update_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomentars()
    {
        return $this->hasMany(Komentar::className(), ['id_artikel' => 'id']);
    }
}
