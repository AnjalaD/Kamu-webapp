//get this to work with autofill in edge

document.addEventListener("DOMContentLoaded", function () {

  // HTML5 form validation

  var supports_input_validity = function () {
    var i = document.createElement("input");
    return "setCustomValidity" in i;
  }

  if (supports_input_validity()) {
    var firstnameInput = document.getElementById("first_name");
    firstnameInput.setCustomValidity(firstnameInput.title);

    var lastnameInput = document.getElementById("last_name");
    lastnameInput.setCustomValidity(lastnameInput.title);

    var emailInput = document.getElementById("email");
    emailInput.setCustomValidity(emailInput.title);

    var pwd1Input = document.getElementById("password");
    pwd1Input.setCustomValidity(pwd1Input.title);

    var pwd2Input = document.getElementById("confirm");

    // input key handlers

    firstnameInput.addEventListener("keyup", function (e) {
      firstnameInput.setCustomValidity(this.validity.patternMismatch ? firstnameInput.title : "");
    }, false);

    lastnameInput.addEventListener("keyup", function (e) {
      lastnameInput.setCustomValidity(this.validity.patternMismatch ? lastnameInput.title : "");
    }, false);

    emailInput.addEventListener("keyup", function (e) {
      emailInput.setCustomValidity(this.validity.patternMismatch ? emailInput.title : "");
    }, false);

    pwd1Input.addEventListener("keyup", function (e) {
      this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
      if (this.checkValidity()) {
        pwd2Input.pattern = RegExp.escape(this.value);
        pwd2Input.setCustomValidity(pwd2Input.title);
      } else {
        pwd2Input.pattern = this.pattern;
        pwd2Input.setCustomValidity("");
      }
    }, false);

    pwd2Input.addEventListener("keyup", function (e) {
      this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
    }, false);

  }
}, false);

//to escape special regEx characters in password
if (!RegExp.escape) {
  RegExp.escape = function (s) {
    return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
  };
}
