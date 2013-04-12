<?php

class FileController extends Controller
{
  /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	
	
public function actionUploadfile($id)
	{
		$this->layout = '//layouts/column1';
		$model=new Upload;
		$id = $_GET['id'];
		if(isset($_POST['Upload']))
        {
        	if(is_dir('upload/'.$id))
        	{
	        	$model->attributes=$_POST['Upload'];
	            $model->image = CUploadedFile::getInstance($model,'image');
	 			if($model->image->saveAs('upload/'.$id."/".$model->image))
	 			{
	 				$sql = "insert into attach (type,type_id,name,uploaded) values
	 				(
	 					'PERONAL',:type_id,:name,:uploaded
	 				)";
	 				
	 				$cmd = Yii::app()->db->createCommand($sql);
	 				$cmd->bindValue(':type_id',$id);
	 				$cmd->bindValue(':name',$model->image);
	 				$cmd->bindValue(':uploaded',date('Y-m-d'));
	 				$cmd->execute();
	 				
	 				$this->redirect('?r=students/uploadfile&id='.$id);
	 			}
	 			else{
	 				echo '<h1>Upload Failed</h1>';
	 			}	
        	}
        	else {
	        		mkdir("upload/".$id,0777);
	        		$model->attributes=$_POST['Upload'];
		            $model->image = CUploadedFile::getInstance($model,'image');
		 			if($model->image->saveAs('upload/'.$id."/".$model->image))
		 			{
		 				
		 				$sql = "insert into attach (type,type_id,name,uploaded) values
		 				(
		 					'PERONAL',:type_id,:name,:uploaded
		 				)";
		 				
		 				$cmd = Yii::app()->db->createCommand($sql);
		 				$cmd->bindValue(':type_id',$id);
		 				$cmd->bindValue(':name',$model->image);
		 				$cmd->bindValue(':uploaded',date('Y-m-d'));
		 				$cmd->execute();
		 				$this->redirect('?r=students/uploadfile&id='.$id);
		 			}
		 			else{
		 				echo 'puyg';
		 			}	
	        	
        	}
		}
        $this->render('uploadfile/upload', array(
        'id'=>$id,
        'model'=>$model));
		//$this->render('upload');
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new File;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['File']))
		{
			$model->attributes=$_POST['File'];
			$model->uploaded_by = Yii::app()->user->name;
			$model->uploaded_date = date('Y-m-d');
			$model->filename = "sample";
			if($model->save())
			{
				$folder=ResourceActiveRecord::getFolderName($model->file_id);
				if(is_dir('upload/'.$folder))
		        {
			        $model->attributes=$_POST['Upload'];
			        $model->filename = CUploadedFile::getInstance($model,'filename');
			        if($model->filename->saveAs("upload/$folder/" . $model->filename))
			        {
			        	$this->redirect(array('view','id'=>$model->file_id));
			        }
		        }
		        	
				else {
					$folder=ResourceActiveRecord::getFolderName($model->file_id);
					
			       	mkdir("upload/".$folder,0777);
			        $model->attributes=$_POST['File'];
				    $model->filename = CUploadedFile::getInstance($model,'filename');
					if($model->filename->saveAs("upload/$folder/" . $model->filename))
			        {
			        	$this->redirect(array('view','id'=>$model->file_id));
			        }
				}
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['File']))
		{
			$model->attributes=$_POST['File'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->file_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('File');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new File('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['File']))
			$model->attributes=$_GET['File'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=File::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
