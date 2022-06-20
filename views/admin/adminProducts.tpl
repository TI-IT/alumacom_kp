<h2>Товары</h2>

<table border="1" cellpadding="1" cellspacing="1">
    <caption>добавить товар</caption>
    <tr>
        <th>название</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Описание</th>
        <th>Сохранить</th>
    </tr>

    <tr>
        <td>
            <input type="edit" id="newItemName" value="" />
        </td>
        <td>
            <input type="edit" id="newItemPrice" value="" />
        </td>

        <td>
            <select id="newItemCatId">
                <option value="0">Главная категория</option>
                {foreach $rsCategories as $itemCat}
                    <option value="{$itemCat['id']}">{$itemCat['name']}</option>
                {/foreach}
            </select>
        </td>
        <td>
            <textarea id="newItemDesc"></textarea>
        </td>
        <td>
            <input type="button" value="Сохранить" onclick="addProduct();" />
        </td>
    </tr>
</table>

<table border="1" cellpadding="1" cellspacing="1">
    <caption>редактировать</caption>
    <tr>
        <th>№</th>
        <th>ID</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Описание</th>
        <th>Удалить</th>
        <th>Изображение</th>
        <th>Сохранить</th>
    </tr>
</table>