### Уcтановка

###### Установка обычная для Yii2-advanced

Login: 
```admin```

Password:
```123456789```



### Техническое задание.

Реализовать упрощенный каталог товаров с публичной и административной частью. Товар будет иметь поля:  Название, slug(алиас на латинице), цена, валюта, статус.
#### Административная часть.
Создание и редактирование товара: 
1)	Название товара обязательно для заполнения. 
2)	Slug должен быть уникальным. Если slug не указан - должен генерироваться автоматически из названия.
3)	Создаваться товар должен со статусом «черновик».  
4)	Цена может быть указана в рублях, долларах или евро. Для этого в форму добавить выпадающий список с валютой. 
5)	Цена обязательна, только если товар активен.<br><br>
Изменение статусов вынести в отдельные действия:<br><br>
1)	Активировать товар можно только если указана цена. (При попытке его активировать выводить сообщение «Не указана цена товара»)
2)	Нельзя удалить активный товар. При попытке его удалить выводить соответствующее сообщение.
#### Публичная часть. 
Сделать html страницу со списком товаров и пагинацией.
1)	Выводить только активные товары
2)	Основная цена выводится в рублях. 
3)	Вывести дополнительно оригинальную цену, если она указана в долларах или евро.
4)	Написать дополнительный action, где будут возвращаться те же данные для вывода только в формате json.

#### Дополнительное задание.
Реализовать промокоды со скидками.
##### Административная часть:
1)	Сделать отдельный модуль  промокодоа со скидками на конкретные товары. 
2)	Для каждого промокода должна быть возможность выбрать товары, на которых будет распространяться скидка
3)	Скидка может быть указана в процентах либо в рублях.
##### Публичная часть:
1)	Над списком товаров добавить форму для ввода промокода. 
2)	Если промокод уже применен, то вместо формы вывести примененный промокод с возможностью его отменить.
3)	При применении промокода у товаров должна выводиться старая (зачеркнутая) и новая цена. С указанием скидки в процентах или рублях.

Административную часть реализовать без авторизации и контроля прав доступа.
Оцениваться будет исключительно backend в первую очередь архитектурный подход.
