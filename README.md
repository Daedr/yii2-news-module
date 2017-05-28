## Test task

- Модуль News находится в common/modules/news

- Применить миграции 

    `yii migrate --migrationPath=@common/modules/news/migrations`
    
- Загрузить тестовые данные

    `php yii fixture/load '*'`
    
- Подключить модуль в common/config/main.php
```
    'modules' => [
        'news' => [
            'class' => 'common\modules\news\Module',
        ],
    ],
```
- Frontend

    localhost/frontend/web/news
    
- Backend

    localhost/backend/web
    
- Login: admin, pass: 111111