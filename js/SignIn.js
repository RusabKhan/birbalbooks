
let error = document.querySelector('.error');
let email = document.querySelector('#email');
let password = document.querySelector('#password');
let signUp = document.querySelector('.signInBtn');
let query = '';

signUp.addEventListener('click', (e) => {

    if (password.value.length > 0 && email.value.length > 0) {
        query = `select * from client_info_login where email ='${email.value}' and password='${password.value}'`;
        addClient();
    }

});



function addClient() {
    var xhhtp = new XMLHttpRequest();
    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 1)
                console.log('CREATED');
        }
    }
    xhhtp.withCredentials = true;
    xhhtp.open('POST', 'database/fetchQuery.PHP', false);
    xhhtp.send(query);
};
