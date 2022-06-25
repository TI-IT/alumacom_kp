<h2>Поставщики</h2>

<div id="blockNewSuppliers">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>Товар</th>
            <th>Название компании</th>
            <th>Сотрудник</th>
            <th>Действие</th>
        </tr>
        <tr>
            <td>
                <select id="categoriesId_{$itemCat['id']}" name="selectCategoriesSuppliersId">
                    <option value="0">
                        {foreach $rsCategories as $itemcat}
                    <option value="{$itemcat['id']}"
                            {if $itemcat['parent_id'] == $itemcat['id']}selected{/if}>
                        {$itemcat['name']}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <input type="text" name="newSuppliersName" id="newSuppliersName" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <select id="clientsId_{$itemCat['id']}" name="selectClientsSuppliersId">
                    <option value="0">
                        {foreach $rsClients as $itemclient}
                    <option value="{$itemclient['id']}"
                            {if $itemclient['category_id'] == $itemclient['id']}selected{/if}>
                        {$itemclient['name']}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <input type="button" onclick="newSuppliers();" value="добавить поставщика"/>
            </td>
        </tr>
    </table>

</div>


<br>
<h2 style="background-color: red">Изменение поставщика</h2>
<div id="blockUpdateSuppliers">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>Товар</th>
            <th>Название компании</th>
            <th>Сотрудник</th>
            <th>Действие</th>
        </tr>
        {foreach $rsSuppliers as $itemSup name=suppliers}
            <tr>
                <td>{$smarty.foreach.suppliers.iteration}</td>
                {foreach $rsCategories as $itemcatsup}
                    {if $itemSup['category_id'] == $itemcatsup['id']}
                        <td>
                            <select id="categoriesId_{$itemcatsup['id']}" name="selectCategoriesSuppliersId">
                                <option value="0">{$itemcatsup['name']}
                                    {foreach $rsCategories as $itemcat}
                                <option value="{$itemcat['id']}"
                                        {if $itemcat['parent_id'] == $itemcat['id']}selected{/if}>
                                    {$itemcat['name']}</option>
                                {/foreach}
                            </select>
                        </td>
                    {/if}
                {/foreach}
                <td>
                    <input size="30px" type="edit" id="itemName_{$itemSup['id']}" value="{$itemSup['name']}"/>
                </td>
                <td>
                    <select id="categoryId{$var}_{$itemSup['id']}">
                        <option value="0">
                            {foreach $rsCategories as $itemcat}
                        <option value="{$itemcat['id']}"
                                {if $itemcat['parent_id'] == $itemcat['id']}selected{/if}>
                            {$itemcat['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <input type="button" value="сохранить" onclick="updateSuppliers({$itemcat['id']});"/>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
<hr>