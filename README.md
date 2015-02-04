# yii2-status
Status module for Yii2.
Not ready yet. Do not use it.

# Usage
1. Add behavior to model
    ```php
    public function behaviors() {
            return [
                [
                    'class' => \itzen\status\behaviors\StatusableBehavior::className(),
                ],
                // Other behaviors
            ];
    }
    ```

2. Create new status for usage in specific model

    ```php
    $model = new Article(); // or any instance of model with StatusableBehavior 
    $status = new \itzen\status\models\Status();
    $status->name = 'Status name';
    if ($model->addStatus($status)) {
        // Success
    } else {
        echo Html::errorSummary($status);
    }
    ```
    
3. Get status name
    
    `$model->status->name` // Will be translated with Yii::t() function with category from $translateCategory in module
