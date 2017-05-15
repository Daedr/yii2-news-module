##Test task

- Модуль News находится в common/modules/news

- Применить миграции 

    `yii migrate --migrationPath=@common/modules/news/migrations`

- Подключить модуль в common/config/main.php
```
    'modules' => [
        'news' => [
            'class' => 'common\modules\news\Module',
        ],
    ],
```
