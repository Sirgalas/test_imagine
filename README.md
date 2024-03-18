# test_imagine
после развертывания проекта надо добавить frontend.local и backend.local в etc/hosts
1. я не нашел просрачного анимированого gif проверял только на png с гифами он работае не очень. Но если будет gif думаю если заменить common\Modules\Image\Services в строке 71 imagecreatefrompng на imagecreatefromgif должно заработать
2. задание находтится на странице /site/follow в меню тоже есть 
3. если мною правильно понятно задание 3 то вот запрос 
`select id
from transaction
where amount < 0
order by date desc
limit 1;`