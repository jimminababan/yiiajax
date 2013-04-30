<?php
/* @var $this FileTypeController */
/* @var $model FileType */
/* @var $form CActiveForm */
?>

blablablablablabla blablablablablabla

<?php echo CHtml::link('Create classroom', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{addClassroom(); $('#dialogClassroom').dialog('open');}"));?>


<div id="bla"></div>

    <?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogClassroom',
    'options'=>array(
        'title'=>'Create classroom',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>550,
        'height'=>470,
    ),
));?>
<div class="divForForm"></div>




<script type="text/javascript">
function addClassroom()
{
    <?php echo CHtml::ajax(array(
            'url'=>array('fileType/create'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogClassroom div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#dialogClassroom div.divForForm form').submit(addClassroom);
                }
                else
                {
                    $('#dialogClassroom div.divForForm').html(data.div);
                    $('#bla').html(data.bunga);
                    $('#file-type-form div.divForForm').html(data.div);
                    
                    setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
                }
 
            } ",
            ))?>;
    return false; 
 
}
 
</script>

<?php $this->endWidget();?>



