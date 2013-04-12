public function actionCreate()
  {
		$model=new FileType;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileType']))
		{
			$model->attributes=$_POST['FileType'];
			if($model->save())
			{
				if(Yii::app()->request->isPostRequest)
				{
					echo CJSON::encode(
						array(
						'status'=>'success',
						'div'=>'Classrom successfully added',
						'bunga'=>'lampet',
						)
					);
					exit;
				}
				else $this->redirect(array('view','id'=>$model->id));
			}
		}
		
		if(Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				'status'=>'failure',
				'div'=>$this->renderPartial('_formjs',array('model'=>$model), true)));
			exit;
		}
		else
		$this->render('create',array(
			'model'=>$model,
		));
	}
