const load = () => {
    /*****R E G I S T E R  U S E R ****/
    $('.register').on('click',() => {
        let name,username,email,password;
        name = $('#name').val();
        username = $('#username').val();
        email = $('#email').val();
        password = $('#password').val();

        let regName = /^[A-Z][a-z]{2,12}$/;
        let regUsername = /^\w{4,20}$/;
        let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let regPass = /^\w{8,50}$/;

        let err = [];

        /*Regular expression*/
        if(!regName.test(name))
            err.push('Name is not ok, first letter must be capital');
        if(!regEmail.test(email))
            err.push('Email is not ok, entar valid one');
        if(!regUsername.test(username))
            err.push('Username is not ok, username must be at least 4 characters long');
        if(!regPass.test(password))
            err.push('Password is not ok, password must be at least 8 characters long');

        if(err.length) {
            let elem = '<ul>';
                for(let i = 0 ; i < err.length ; i++){
                    elem += `<li class="text-danger"> ${err[i]} </li>`
                }
            elem += '</ul>';
            $('.errors').html(elem)

        }else {
            $('.errors').html('');
            $.ajax({
                url : 'php/register.php',
                method : 'POST',
                data : {
                    send : true,
                    name,
                    username,
                    email,
                    password
                },
                success: function (data) {
                    if(data === '200')
                        alert("Please check your mail. Verification mail is sent to you");
                    else
                        alert('neki zajeb')
                },
                error: function (xhr,status,msg) {
                    console.log(xhr.status);
                }
            });
        }
    });

    /*****L O G I N  U S E R ****/
    $('.btnSubmit').on('click',() => {
        let email = $('.email').val();
        let password = $('.password').val();

        /*Regular expression*/
        let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let regPass = /^\w{8,50}$/;

        let err = [];

        if(!regEmail.test(email))
            err.push('Email is not ok,entar valid one');
        if(!regPass.test(password))
            err.push('Password is not ok, password must be at least 8 characters long');
        if(err.length){
            let elem = '<ul>';
            for(let i = 0 ; i < err.length ; i++){
                elem += `<li class="text-light"> ${err[i]} </li>`
            }
            elem += '</ul>';
            $('.loginErr').html(elem);
        }else {
            console.log('usao u else');
            $.ajax({
                url:'php/login.php',
                method : 'POST',
                data : {
                    send:true,
                    email,
                    password
                },
                success(data){
                    console.log('ovo je stiglo sa server' + data);
                    if(data === '200'){
                        alert('uspesno ste se logovali');
                        window.location = "http://192.168.0.101/site/index.php";
                    }
                    if(data === '300'){
                        let elem = '<p class="text-light">Sorry, your password or email was incorrect</p>';
                        $('.loginErr').html(elem);
                        //window.location.href = 'index.php';
                    }

                },
                error(xhr,status,msg){
                    console.error(xhr.status)
                }
            });
        }
    });

    /****L O G O U T****/
    $('.logout').on('click',() => {
        $.ajax({
            url : 'php/logout.php',
            method : 'POST',
            data : {
                send : true
            },
            success(data){
                if(data === '200'){
                    window.location = "http://192.168.0.101/site/index.php?page=login";
                }else{
                    console.log('nesto ne valja');
                    window.location.href = 'index.php';
                }
            },
            error(err){
                console.error(err);
            }
        })
    });

    /******S U P P O R T********/
    $('.sendMail').on('click',() => {
        let subject = $('#emailSubject').val();
        let text = $('#emailTxt').val();
        let email = $('#email').val();
        let username = $('#username').val();
        /***Regular expressions***/

        $.ajax({
            url : 'php/support.php',
            method : 'GET',
            data : {
                support : true,
                subject,
                text,
                email,
                username
            },
            success(data){
                if(data === '200')
                    alert('uspesno ste poslali poruku');
                else
                    alert('neki zajeb');
            },
            error(err){
                console.log(err);
            }
        })
    });

    /*****C O L L E C T I N G   D A T A  F R O M  S U R V E I******/
    $('.survey').on('click',() => {
        let userID = $('.userID').data('id');
        alert(userID);
        let q1 = $('#q1').data('id');
        let q2 = $('#q2').data('id');
        let q3 = $('#q3').data('id');
        let a1 = null ;
        let a2 = null ;
        let a3 = null ;
        let tmp1 = $('.form-group1 input');
        for(let i = 0 ; i < tmp1.length ; i++){
            if($(tmp1[i]).is(':checked'))
                a1 = $(tmp1[i]).data('id');
        }
        let tmp2 = $('.form-group2 input');
        for(let i = 0 ; i < tmp2.length ; i++){
            if($(tmp2[i]).is(':checked'))
                a2 = $(tmp2[i]).data('id');
        }
        let tmp3 = $('.form-group3 input');
        for(let i = 0 ; i < tmp3.length ; i++){
            if($(tmp3[i]).is(':checked'))
                a3 = $(tmp3[i]).data('id');
        }
        let objQ= {
            q1,
            q2,
            q3,
        };
        let objA = {
            a1,
            a2,
            a3
        };
        $.ajax({
            url : 'php/ajax.php',
            method : 'GET',
            data : {
                survey : true,
                objQ,
                objA,
                userID
            },
            success(data){
                console.log(data);
            },
            error(err){
                console.log(err);
            }
        })

    });

    /*******A D D  P R O D U C T  T O  C A R T****/
    $('.addToCart').on('click',function() {
        let userID = $(this).data('uid');
        let productID = $(this).data('pid');

        $.ajax({
            url : 'php/ajax.php',
            method : 'GET',
            data : {
                add:true,
                userID,
                productID
            },
            success(data){

            },
            error(err){

            }
        })
    });

    /***********R E M O V E  F R O M  C A R T*******/
    $('.remove').on('click',function () {
        let userID = $(this).data('uid');
        let productID = $(this).data('pid');

        $.ajax({
            url: 'php/ajax.php',
            method : 'POST',
            data : {
                remove : true,
                userID,
                productID
            },
            success(data){
                $(`.remove[data-pid="${productID}"]`).parents()[3].remove()
            },
            error(data){

            }
        })
    });

    /*********B U Y  P R O D U C T S*********/
    $('.buy').on('click',() => {
        let tmp = $('.remove ');
        let userID = $('.buy').data('uid');
        let productID = [];
        for(let i = 0 ; i < tmp.length ; i++){
            productID.push($(tmp[i]).data('pid'))
        }
        //console.log(productID);
        let  temp =  JSON.stringify(productID);

        $.ajax({
            url : 'php/ajax.php',
            method : 'POST',
            data : {
                buy : true,
                temp,
                userID
            },
            success(data){
                if(data)
                    $('.cart').children().remove()
            },
            error(err){
                console.error(err);
            }
        })
    })

};
document.addEventListener('DOMContentLoaded', load());
