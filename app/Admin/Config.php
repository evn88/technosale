<?php
//use App\Peoples;
use App\Config;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Config::class, function(ModelConfiguration $model){
    $model->setTitle('Конфигурация');

    $model->onDisplay(function (){
        $display = AdminDisplay::datatables();

        $display->setColumns([
                   AdminColumn::text('name')->setLabel('Название параметра'),
                   AdminColumn::text('param')->setLabel('Значение параметра'),
                ]);
        return $display;
    });

    $model->onCreateAndEdit(function (){
        $form = AdminForm::panel()
                ->addBody([
                     AdminFormElement::text('name','Название параметра')->required(),
                     AdminFormElement::text('param','Значение параметра')->required(),
                ]);
        $form->getButtons()->setSaveButtonText('Сохранить')->hideSaveAndCloseButton();
        return $form;
    });
});
