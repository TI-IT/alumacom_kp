<h2>Добавление Организации</h2>

<h3>Заполнить по ИНН</h3>
<div id="blogGetApiInn">
    <input type="text" id="getApiInn" name="getApiInn" value="">
    <input type="button" value="запрос" onclick="getApiInnData();">
</div>
<br>

<div id="blockNewPersons">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>Название Организации</th>
            <th>ОГРН</th>
            <th>ИНН</th>
            <th>КПП</th>
            <th>Адрес</th>
            <th>ОКПО</th>
            <th>ОКВЕД</th>
        </tr>
        <tr>
            <td>
                <input size="30px" type="text" name="newPersonSurname" id="newPersonSurname" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonName" id="newPersonName" value=""
                       style="background-color: pink">
            </td>
            <td>
                <input size="30px" type="text" name="newPersonPatronymic" id="newPersonPatronymic" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input type="tel" id="newPersonPhone" name="newPersonPhone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
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
                <input size="30px" type="text" name="newPersonResidential_address" id="newPersonResidential_address"
                       value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="button" onclick="newPerson();" value="добавить физ лицо"/>
            </td>
        </tr>
    </table>

</div>


<br>
<h2>Изменение Физ лица</h2>
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
                    <input size="30px" type="edit" id="itemDate_of_birth_{$item['id']}"
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
                    <input type="button" value="сохранить" onclick="updatePersons({$item['id']});"/>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
<hr>