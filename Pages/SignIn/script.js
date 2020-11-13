//SHOW PASSWORD

function show_hide_password(target){
    let input;
    if (target.classList[0] == "password-first-check")
      input = document.getElementById('first-password-input'); 
    else if (target.classList[0] == "password-second-check")
      input = document.getElementById('second-password-input');
  
      if (input.getAttribute('type') == 'password') {
          target.classList.add('show');
          target.classList.remove('hide');
          input.setAttribute('type', 'text');
      } else {
          target.classList.add('hide');
          target.classList.remove('show');
          input.setAttribute('type', 'password');
      }
      return false;
  }

  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    var checkbox1 = document.getElementById("password-first-check");
    checkbox1.classList.add("hide");
  } else {

    let first_input_form = document.getElementById("first-password-input");
    first_input_form.addEventListener('input', function() {
        var checkbox = document.getElementById("password-first-check");
        if (first_input_form.textLength > 0){
            if (first_input_form.getAttribute('type') == 'password')
                checkbox.classList.add("hide");
            else
                checkbox.classList.add("show");
        }
        else{
            checkbox.classList.remove("hide");
            checkbox.classList.remove("show");
        }
      });
  
}
  
  let first_input_form = document.getElementById("first-password-input");
  
  first_input_form.addEventListener('input', function() {
      var checkbox = document.getElementById("password-first-check");
      if (first_input_form.textLength > 0){
          if (first_input_form.getAttribute('type') == 'password')
              checkbox.classList.add("hide");
          else
              checkbox.classList.add("show");
      }
      else{
          checkbox.classList.remove("hide");
          checkbox.classList.remove("show");
      }
    });
