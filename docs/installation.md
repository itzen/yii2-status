# Getting started with sonkei/google-map

### 1. Download

`sonkei/yii2-status` can be installed using composer. Run following command to download and install `sonkei/yii2-status`:

```bash
composer require sonkei/yii2-status
```

### 2. Configure

#### 1. Register module
In you project configuration register `sonkei/yii2-status` module

```php
'modules' => [
    // ...
    'status' => [
        'class' => 'sonkei\status\Module'
    ]
    // ...
]
```

#### 2. Apply migration
Copy migrations that could be found in `vendor/sonkei/yii2-status/dist/migrations` and run yii2 migration tool.
Or you can apply migration straight from vendor
```bash
yii migrate/up --migrationPath=@vendor/sonkei/yii2-status/dist/migrations
```

#### 3. Add relation to status linking table (object_status) to your model

```php
// ...
function getStatuses()
{
    return $this->hasMany(Status::className(), ['id' => 'status_id'])
        ->viaTable(ObjectStatus::tableName(), ['object_id' => 'id']);
}
// ...
```

#### 4. Add behavior to your model

```php
// ...
function behaviors() {
    return [
        // ...
        [
            'class' => 'sonkei\status\behaviors\StatusableBehavior',
            'status_relation' => 'statuses' // The relation connecting statuses and your object
        ],
        // ...
    ];
}
// ...
```

#### 5. Configure statuses
Configure available statuses within the module (http://mysupercoolsite.com/status)

#### 6. Use it

```php
$user->addStatus(Status::getByStatusLabel('Заблокирован'))
```