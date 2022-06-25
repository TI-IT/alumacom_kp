<h2>Вид отделки</h2>
<div id="blockNewMaterials">
    Новый материал:
    <input type="text" name="newMaterialsName" id="newMaterialsName" value="">
    <br />

    является подкатегорией для
    <select name="generalMaterials">
        <option value="0">Главная категория
            {foreach $rsMaterials as $item}
        <option value="{$item['id']}">{$item['name']}
            {/foreach}
    </select>
    <br />
    <input type="button" onclick="newMaterials();" value="добавить категорию" />
</div>

<div id="blockUpdateMateriasl">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>ID</th>
            <th>Название</th>
            <th>Родительская категория</th>
            <th>Действие</th>
        </tr>
        {foreach $rsMaterials as $item name=materials}
            <tr>
                <td>{$smarty.foreach.materials.iteration}</td>

                <td>{$item['id']}</td>
                <td>
                    <input size="30px" type="edit" id="itemNameMat_{$item['id']}" value="{$item['name']}" />
                </td>
                <td>
                    <select id="parentIdMat_{$item['id']}">
                        <option value="0">Главная категория
                            {foreach $rsMainMaterials as $mainItem}
                        <option value="{$mainItem['id']}"
                                {if $item['parent_id'] == $mainItem['id']}selected{/if}>
                            {$mainItem['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <input type="button" value="сохранить" onclick="updateMaterials({$item['id']});" />
                </td>
            </tr>

        {/foreach}
    </table>
</div>

