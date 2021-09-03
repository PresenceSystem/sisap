<?php
class MiCDbHttpSession extends CDbHttpSession{
 
protected function createSessionTable($db,$tableName){
$driver=$db->getDriverName();
if($driver==='mysql')
$blob='LONGBLOB';
elseif($driver==='pgsql')
$blob='BYTEA';
else
$blob='BLOB';
$db->createCommand()->createTable($tableName,array(
'id'=>'CHAR(32) PRIMARY KEY',
'usuario'=>'integer',
'ip'=>'CHAR(45)',
'expire'=>'integer',
'data'=>$blob,
));
}
 
public function writeSession($id,$data){
try
{
$expire=time()+$this->getTimeout();
$db=$this->getDbConnection();
if($db->createCommand()->select('id')->from($this->sessionTableName)->where('id=:id',array(':id'=>$id))->queryScalar()===false)
$db->createCommand()->insert($this->sessionTableName,array(
'id'=>$id,
'usuario'=>Yii::app()->user->id,
'ip'=>$_SERVER['REMOTE_ADDR'],
'data'=>$data,
'expire'=>$expire,
));
else
$db->createCommand()->update($this->sessionTableName,array(
'usuario'=>Yii::app()->user->id,
'ip'=>$_SERVER['REMOTE_ADDR'],
'data'=>$data,
'expire'=>$expire
),'id=:id',array(':id'=>$id));
}
catch(Exception $e)
{
if(YII_DEBUG)
echo $e->getMessage();
// it is too late to log an error message here
return false;
}
return true;
}
}