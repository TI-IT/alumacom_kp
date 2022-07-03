<h2>Заказы</h2>
<div id="blockNewClient">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№ Заказа</th>
            <th>ID</th>
            <th>Имя</th>
            <th>Телефон</th>
        </tr>
        <tr>
            <td>
                <input type="text" name="newClientname" id="newPersonSurname" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input type="text" name="newPersonName" id="newPersonName" value=""
                       style="background-color: pink">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonPatronymic" id="newPersonPatronymic" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="date" name="newPersonDate_of_birth" id="newPersonDate_of_birth" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonPassport_number" id="newPersonPassport_number" value="0"
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonResidential_address" id="newPersonResidential_address" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="button" onclick="newOrder();" value="добавить заказ"/>
            </td>
        </tr>
    </table>
    Новый Клиент:
    <input type="text" name="newClientName" id="newClientName" value="">
    <br />

    является подкатегорией для
    <select name="generalSpeciesId">
        <option value="0">Клиент
            {foreach $rsMainClients as $item}
        <option value="{$item['id']}">{$item['name']}
            {/foreach}
    </select>
    <br />
    <input type="button" onclick="newClient();" value="добавить вид товара" />
</div>

<div id="blockUpdateSpecies">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>ID</th>
            <th>Название</th>
            <th>Родительская категория</th>
            <th>Действие</th>
        </tr>
        {foreach $rsClients as $item name=species}
            <tr>
                <td>{$smarty.foreach.species.iteration}</td>

                <td>{$item['id']}</td>
                <td>
                    <input size="30px" type="edit" id="itemNameClient_{$item['id']}" value="{$item['name']}" />
                </td>
                <td>
                    <select id="parentClientId_{$item['id']}">
                        <option value="0">Клиент
                            {foreach $rsMainClients as $mainItem}
                        <option value="{$mainItem['id']}"
                                {if $item['parent_id'] == $mainItem['id']}selected{/if}>
                            {$mainItem['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <input type="button" value="сохранить" onclick="updateClient({$item['id']});" />
                </td>
            </tr>

        {/foreach}
    </table>
</div>
<hr>


