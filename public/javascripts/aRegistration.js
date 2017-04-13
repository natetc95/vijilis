function generatePassword(length=12) {
    var charlist = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890!@#$%^&*()-+<>";
    var password = "";
    for (var i = 0; i < length; i++) {
        var x = Math.floor(Math.random() * charlist.length);
        password += charlist.charAt(x);
    }
    document.getElementById('gpass').value = password;
}