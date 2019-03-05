const tmp = () => {
    /*******A D D  U S E R********/
    $('.addUserAdmin').on('click',() => {
        let name = $('#name').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let activeStatus = $('#active').val();
        let role = $('#role').val();

        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            data : {
                addUser : true,
                name,
                username,
                email,
                password,
                activeStatus,
                role
            },
            success(data){
                console.log(data);
            },
            error(err){
                console.error(err);
            }
        })
    });
    /***D E L E T E  U S E R ***/
    $('.deleteUser').on('click',function () {
        let id = $(this).data('id');

        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            data : {
                deleteUser : true,
                id
            },
            success(data){
                if(data)
                    $(`.deleteUser[data-id="${id}"]`).parents()[1].remove();
                else
                    console.log('There was mistake');
            },
            error(err){
                console.error(err);
            }
        })
    });
    /****U P D A T E  U S E R****/
    $('.updateUser').on('click',function () {
        let id = $(this).data('id');
        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            dataType :'json',
            data : {
                update : true,
                id
            },success(data){
                let status = [
                    {id : 0, status : 'Inactive'},
                    {id:1, status:'Active'}
                    ];
                let html = '<div class="row">';

                   html += `<form>
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control" value="${data[0].userName}">                        
                      </div>
                      <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" id="username" value="${data[0].username}">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" id="email" value="${data[0].email}">
                      </div>
                      <label>Role</label>
                      <select class="form-control form-control-sm" id="role">`;
                            for(let i = 0 ; i < 2 ; i++){
                                if(data[0].role_id == i+1)
                                    html += `<option value="${i+1}" selected>${data[1][i].name}</option>`;
                                else
                                    html += `<option value="${i+1}">${data[1][i].name}</option>`
                            }
                      html +=`</select> <label class="mt-2">Status</label>`;
                      html += `<select class="form-control form-control-sm" id="status">`;
                                for(let i = 0 ; i < status.length ; i++){
                                    if(data[0].active == i)
                                        html += `<option value="${i}" selected>${status[i].status}</option>`;
                                    else
                                        html += `<option value="${i}">${status[i].status}</option>`
                                }
                      html += `</select></br>`;
                      html +=` <button type="button" class="btn btn-primary updateChanges mt-3" data-uid="${data[0].userID}">Submit</button>
                                </form> </div>`;
                $('.showUser').html(html);
            },
            error(err){
                console.log(err);
            }
        })
    });
    /***U P D A T E  U S E R****/
    $(document).on('click','.updateChanges',function () {
        let uid = $(this).data('uid');
        let name = $('#name').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let role = $('#role').val();
        let status = $('#status').val();

        /*****R E G U L A R   E X P R E S S I O N S*****/
        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            data : {
                updateUser : true,
                name,
                username,
                email,
                role,
                status,
                uid
            },
            success(data){
                if(data){
                    alert('You have successfully changed data');
                    window.location.href = 'index.php?page=admin';
                }
            },
            error(err){
                console.error(err)
            }
        })
    });
    /***A D D  B R A N D **/
    $('.addBrand').on('click',() => {
        let name = $('#brand').val();

        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            data : {
                brand : true,
                name
            },
            success(data){
                console.log(data);
            },
            error(err){
                console.log(err);
            }
        })
    });

    /***D E L E T E  P R O D U C T****/
    $('.deleteProduct').on('click',function () {
        let id = $(this).data('id');
        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            data : {
                deleteProduct : true,
                id
            },
            success(data){
                if(data)
                    $(`.deleteProduct[data-id="${id}"]`).parents()[1].remove();
            },
            error(err){
                console.log(err);
            }
        })
    })
    /***U P D A T E  P R O D U C T**/
    $('.updateProduct').on('click',function () {
        let id = $(this).data('id');
        $.ajax({
            url : 'php/admin/admin.php',
            method : 'POST',
            dataType :'json',
            data : {
                updateProduct : true,
                id
            },success(data){
                console.log(data);
                let html = '<div class="row">';

                html += `<form enctype="multipart/form-data" action = "index.php?page=updateProduct" method="POST">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="${data.title}">
                      </div>
                      <div class="form-group" >
                        <label>Picture</label>
                        <img src="${data.picture}" width="100px"/> </br> 
                        <label>Add new picture</label></br> 
                        <input name="file" class="input-file" type="file"  id="file" value="${data.picture}"/>                      
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="description">
                            ${data.description}
                        </textarea>
                      </div> 
                      <div class="form-group">
                        <label>Active ingridients : </label>
                        <input type="text" name="ingrd" class="form-control" value="${data.active_ingrd}">
                      </div> 
                      <div class="form-group">
                        <label>Price : </label>
                        <input type="text" name="price" class="form-control" value="${data.price}">
                      </div>
                        <input type="hidden" name="id" class="form-control" value="${data.productID}">`;

                html +=` <button type="submit" name="updateProduct" class="btn btn-primary mt-3" data-uid="">Submit</button>
                                </form> </div>`;
                $('.showProduct').html(html);
            },
            error(err){
                console.log(err);
            }
        })
    });
};
document.addEventListener('DOMContentLoaded', tmp);

