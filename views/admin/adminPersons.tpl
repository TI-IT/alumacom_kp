<h2>Добавление Физ лица</h2>

<div id="blockNewPersons">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Телефон</th>
        </tr>
        <tr>
            <td>
                <input size="30px" type="text" name="newPersonSurname" id="newPersonSurname" value="">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonName" id="newPersonName" value=""
                       style="background-color: pink">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonPatronymic" id="newPersonPatronymic" value="">
            </td>
            <td>
                <input type="tel" id="newPersonPhone" name="newPersonPhone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                       style="background-color: pink">
            </td>
            <td>
                <input size="30px" type="button" onclick="newPerson();" value="добавить физ лицо"/>
            </td>
        </tr>
    </table>

</div>


<br>
<h2>Изменение Физ лица</h2>
{if $rsPersons}
    <div id="blockUpdatePersons">
        <table border="1" cellpadding="1" cellspacing="1">
            <tr>
                <th>№</th>
                <th>id</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Телефон</th>
                <th>Дата рождения</th>
                <th>Номер паспорта</th>
                <th>Адрес проживания</th>
            </tr>
            {foreach $rsPersons as $item name=persons}
                <tr>
                    <td>
                        {$smarty.foreach.persons.iteration}
                    </td>
                    <td>
                        {$item['id']}
                    </td>
                    <td>
                        <input size="30px" type="edit" id="itemSurname_{$item['id']}" value="{$item['surname']}"/>
                    </td>
                    <td>
                        <input size="30px" type="edit" id="itemName_{$item['id']}" value="{$item['name']}"/>
                    </td>
                    <td>
                        <input size="30px" type="edit" id="itemPatronymic_{$item['id']}" value="{$item['patronymic']}"/>
                    </td>
                    <td>
                        {foreach $rsPhone as $itemPhone}
                            <div>
                                {if $item['id'] == $itemPhone['person_id']}
                                    {$itemPhone['phone']}
                                {/if}
                            </div>
                        {/foreach}
                    </td>
                    <td>
                        <input size="30px" type="date" id="itemDate_of_birth_{$item['id']}"
                               value="{$item['date_of_birth']}"/>
                    </td>
                    <td>
                        <input size="30px" type="edit" id="itemPassport_number_{$item['id']}"
                               value="{$item['passport_number']}"/>
                    </td>
                    <td>
                        <input size="30px" type="edit" id="itemResidential_address_{$item['id']}"
                               value="{$item['residential_address']}"/>
                    </td>
                    <td>
                        <input type="button" value="Изменить физ лицо" onclick="updatePersons({$item['id']});"/>
                    </td>
                </tr>
            {/foreach}
        </table>
    </div>
{/if}


<hr>