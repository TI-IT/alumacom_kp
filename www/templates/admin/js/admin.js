/**
 * получение данных с формы
 */
function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
        if(this.name && this.name !=''){
            hData[this.name] = this.value;
            console.log('hData[' + this.name + '] = ' + hData[this.name]);
        }
    });
    console.log(hData);
    return hData;
};

/**
 * добавление новой категории
 */
function newCategory(){
    var postData = getData('#blockNewCategory');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewcat/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newCategoryName').val('');
                location.reload();
            }else{
                alert(data['message']);
            }
        }
    })
}

/**
 * добавление нового материала
 */
function newMaterials(){
    var postData = getData('#blockNewMaterials');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewmaterial/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newMaterialsName').val('');
            }else{
                alert(data['message']);
            }
        }
    })
}

/**
 * добавление новой категории
 */
function newSpecies(){
    var postData = getData('#blockNewSpecies');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewspecies/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newSpeciesName').val('');
            }else{
                alert(data['message']);
            }
        }
    })
}

/**
 * добавление нового клиента
 */
function newSpecies(){
    var postData = getData('#blockNewSpecies');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewspecies/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newSpeciesName').val('');

            }else{
                alert(data['message']);
            }
        }
    })
}

/**
 * добавление физ лица
 */
function newPerson(){
    var postData = getData('#blockNewPersons');
    var phone = $('#newPersonPhone').val();

    var phoneData = {
        phone
    }
    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewpersons/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newSpeciesName').val('');

                $.ajax({
                    type: "POST",
                    async: false,
                    url: "/admin/addnewphone/",
                    data: phoneData,
                    dataType: "json",
                    success: function(data){
                        if(data['success']){
                            $('#newSpeciesName').val('');
                            location.reload();
                        }else{
                            alert(data['message']);
                        }
                    }
                })

                // location.reload();
            }else{
                alert(data['message']);
            }
        }
    })
}

/**
 * добавление нового поставщика
 */
function newSuppliers(){
    var postData = getData('#blockNewSuppliers');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewsuppliers/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newSpeciesName').val('');
                location.reload();
            }else{
                alert(data['message']);
            }
        }
    })
}

function addProduct(){
    var itemName = $('#newItemName').val();
    var itemPrice = $('#newItemPrice').val();
    var itemCatId = $('#newItemCatId').val();
    var itemDesc = $('#newItemDesc').val();

    var postData = {
        itemName,
        itemPrice,
        itemCatId,
        itemDesc
    };

    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/addproduct/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            if(data['success']){
                $('#newItemName').val('');
                $('#newItemPrice').val('');
                $('#newItemCatId').val('');
                $('#newItemDesc').val('');
            }
        }
    })
}

function updateCat(itemId){
    var parentId = $('#parentId_' + itemId).val();
    var newName = $('#itemName_' + itemId).val();
    var postData = {
        itemId,
        parentId,
        newName
    };
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatecategory/",
        data: postData,
        dataType: 'json',
        success: function (data){
            location.reload();
        }
    })
}

function updateSuppliers(itemId){
    var categoryId = $('#categoryIdSuppliers_' + itemId).val();
    var newName = $('#itemNameSuppliers_' + itemId).val();
    var postData = {
        itemId,
        categoryId,
        newName
    };
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatesuppliers/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            location.reload();
        }
    })
}

function updatePersons(itemId){
    var Surname = $('#itemSurname_' + itemId).val();
    var name = $('#itemName_' + itemId).val();
    var patronymic = $('#itemPatronymic_' + itemId).val();
    var date_of_birth = $('#itemDate_of_birth_' + itemId).val();
    var passport_number = $('#itemPassport_number_' + itemId).val();
    var address = $('#itemResidential_address_' + itemId).val();

    var postData = {
        itemId,
        Surname,
        name,
        patronymic,
        date_of_birth,
        passport_number,
        address
    };
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatepersons/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            location.reload();
        }
    })
}

function updateSpecies(itemId){
    var parentId = $('#parentIdSpe_' + itemId).val();
    var newName = $('#itemNameSpe_' + itemId).val();
    var postData = {
        itemId,
        parentId,
        newName
    };
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatespecies/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            location.reload();
        }
    })
}

function updateMaterials(itemId){
    var parentId = $('#parentIdMat_' + itemId).val();
    var newName = $('#itemNameMat_' + itemId).val();
    var postData = {
        itemId,
        parentId,
        newName
    };
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatematerials/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            location.reload();
        }
    })
}

function updateProduct(itemId){
    var itemName =   $('#itemName_' + itemId).val();
    var itemPrice =  $('#itemPrice_' + itemId).val();
    var itemCatId =  $('#itemCatId_' + itemId).val();
    var itemDesc =   $('#itemDesc_' + itemId).val();
    var itemStatus = $('#itemStatus_' + itemId).attr('checked');

    if(! itemStatus){
        itemStatus = 1
    }else{
        itemStatus = 0
    }

    var postData = {
        itemId,
        itemName,
        itemPrice,
        itemCatId,
        itemDesc,
        itemStatus
    };

    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updateproduct/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            location.reload();
        }
    })
}

//Запрос по АПИ
function getApiInnData(){
    var postData = getData('#blogGetApiInn');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/getapiinndata/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
            }else{
                alert(data['message']);
            }
        }
    })
}

//Запрос по АПИ
function getApiBankData(){
    var postData = getData('#blogGetApiBank');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/getapibankdata/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
            }else{
                alert(data['message']);
            }
        }
    })
}