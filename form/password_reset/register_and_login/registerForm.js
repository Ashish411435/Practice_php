function formSubmit() {
    var myName = document.getElementById("myName").value;
    var myEmail = document.getElementById("myEmail").value;
    var myPassword = document.getElementById("myPassword").value;
    var myConfirmPassword = document.getElementById("myConfirmPassword").value;

    if (myName == "") {
        alert("Please Enter Name");
        return false;
    }
    if (myEmail == "") {
        alert("Please Enter Email");
        return false;
    }
    if (myPassword == "") {
        alert("Please Enter Password");
        return false;
    }
    if (myConfirmPassword == "") {
        alert("Please Confirm Your Password");
    }
}