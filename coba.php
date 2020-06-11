<?php 
  setcookie('jos', 'tai', time() +60);
 ?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <style>
    .popover.right .arrow:after {
      border-right-color: red;

    }
    .popover{background:red; color : white; font-weight: bold; position: absolute;}
    .fa-check-circle{color: lightblue;}
    #good{display: none; padding: 5px}

    .invalid{
      border-color: #E9322D!important;
      box-shadow: 0 0 6px #F8B9B7!important;
    }
  </style>
</head>
<body style="margin: 20px; padding: 5px">
<!--   <div class="container">
    <h3>Bootstrap Live Form Validation with Popover</h3>
    <p class="page-header text-success">Start typing in the fields..</p>
    <form class="form-horizontal col-sm-8">
      <div class="form-group"><label>Gender</label><select class="form-control required gender" data-placement="top" data-trigger="manual" data-content="You must choose a gender."><option value="">Please choose a gender</option>
        <option value="1">Male</option><option value="2">Female</option><option value="3">Unisex</option> </select></div>
        <div class="form-group"><label>Name</label><input class="form-control required name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text"></div>
        <div class="form-group"><label>Password</label><input class="form-control required pass" data-placement="top" data-trigger="manual" data-content="Must be at least 6 characters long, and contain at least one number, one uppercase and one lowercase letter." type="password"></div>
        <div class="form-group"><label>E-Mail</label><input class="form-control email" data-placement="top" data-trigger="manual" data-content="Must be a valid e-mail address (user@gmail.com)" type="text"></div>
        <div class="form-group"><label>Phone</label><input class="form-control phone" placeholder="999-999-9999" data-placement="top" data-trigger="manual" data-content="Must be a valid phone number (999-999-9999)" type="text"></div>
        <div class="form-group"><label>Bio</label><textarea id="bio" name="bio" type="text" data-content="Must be at least 3 characters long" data-trigger="manual" data-placement="left" class="form-control required body" cols="50" rows="6" data-original-title="" title=""></textarea></div>
        <div class="form-group"><button type="submit" class="btn btn-default pull-left">Submit</button> <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p></div>

          
      </form>

    </div> -->
    <a href="coba2.php">dfdfd</a>
    <br><br><br><br>
    <form method="post">

      nama <input minlength="3" type="text" name="nama" id="nama"  required pattern=".{0}|.{3,}"><br>
      nomor <input type="number" name="tlp" min="0" required=""><br>
      password <input type="password" name="pass" required=""><br>
      Ulani-password <input type="password" name="pass2" required=""><br>
      email <input type="email" name="email" required=""><br>
      <button style="submit">go</button>
    </form>
    <br>
    <br>
    <script type="text/javascript">
      $.fn.goValidate = function() {
        var $form = this,
        $inputs = $form.find('input:text, input:password'),
        $selects = $form.find('select'),
        $textAreas = $form.find('textarea');
        
        var validators = {
          name: {
            regex: /^[A-Za-z]{3,}$/
          },
          username: {
            regex: /^[A-Za-z]{6,}$/
          },
          firstName: {
            regex: /^[A-Za-z]{3,}$/
          },
          lastName: {
            regex: /^[A-Za-z]{3,}$/
          },
          town: {
            regex: /^[A-Za-z]{3,}$/
          },
          postcode: {
            regex: /^.{3,}$/
          },
          password1: {
            regex: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
          },
          password1_repeat: {
            regex: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
          },
          email: {
            regex: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/
          },
          phone: {
            regex: /^[2-9]\d{2}-\d{3}-\d{4}$/,
          },
          body: {
            regex: /^.{3,}$/
          },
          country: {
            regex: /^(?=\s*\S).*$/,
          }
        };
        var validate = function(klass, value) {
          var isValid = true,
          error = '';
          
          if (!value && /required/.test(klass)) {
            error = 'This field is required';
            isValid = false;
          } else {
            klass = klass.split(/\s/);
            $.each(klass, function(i, k){
              if (validators[k]) {
                if (value && !validators[k].regex.test(value)) {
                  isValid = false;
                  error = validators[k].error;
                }
              }
            });
          }
          return {
            isValid: isValid,
            error: error
          }
        };
        var showError = function($e) {
          var klass = $e.attr('class'),
          value = $e.val(),
          test = validate(klass, value);
          
          $e.removeClass('invalid');
          $('#form-error').addClass('hide');
          
          if (!test.isValid) {
            $e.addClass('invalid');
            
            if(typeof $e.data("shown") == "undefined" || $e.data("shown") == false){
             $e.popover('show');
           }
           
         }
         else {
          $e.popover('hide');
        }
      };
      
      $inputs.keyup(function() {
        showError($(this));
      });
      $selects.change(function() {
        showError($(this));
      });
      $textAreas.keyup(function() {
        showError($(this));
      });
      
      $inputs.on('shown.bs.popover', function () {
        $(this).data("shown",true);
      });
      
      $inputs.on('hidden.bs.popover', function () {
        $(this).data("shown",false);
      });
      
      $form.submit(function(e) {
        
        $inputs.each(function() { /* test each input */
          if ($(this).is('.required') || $(this).hasClass('invalid')) {
            showError($(this));
          }
        });
        $selects.each(function() { /* test each input */
          if ($(this).is('.required') || $(this).hasClass('invalid')) {
            showError($(this));
          }
        });
        $textAreas.each(function() { /* test each input */
          if ($(this).is('.required') || $(this).hasClass('invalid')) {
            showError($(this));
          }
        });
        if ($form.find('input.invalid').length) { /* form is not valid */
          e.preventDefault();
          $('#form-error').toggleClass('hide');
        }
      });
      return this;
    };



    $('form').goValidate();


    
//     // email validate
//     var email = document.querySelector('input[name="email"]');
//     email.setCustomValidity('Email Wajib di Isi!!!');

//     email.addEventListener('input', function () {
//   // Note: if (this.checkValidity()) won't work
//   // as setCustomValidity('with a message') will set
//   // the field as invalid.
//   if (this.value.trim() === '') {
//     this.setCustomValidity('Email Wajib di Isi!!!');
//   }
//   else {
//     this.setCustomValidity('');
//   }
// }, false);

//     email.addEventListener('input', function () {
//       if (email.validity.typeMismatch) {
//         email.setCustomValidity("Email Anda Tidak Valid!!!")
//       }
//     }, false);

//     // text validate
//     var nama = document.querySelector('input[name="nama"]');
//     nama.setCustomValidity('Nama Wajib di Isi!!!');

//     nama.addEventListener('input', function () {
//   // Note: if (this.checkValidity()) won't work
//   // as setCustomValidity('with a message') will set
//   // the field as invalid.
//   if (this.value.trim() === '') {
//     this.setCustomValidity('Nama Wajib di Isi!!!');
//   }
//   else {
//     this.setCustomValidity('');
//   }
// }, false);

//     nama.addEventListener('input', function () {
//       if (nama.validity.patternMismatch) {
//         nama.setCustomValidity("Nama Minimal 3 Karkter!!!")
//       }

//     }, false);


//     // // sdsd
//     // function InvalidMsg(textbox) {

//     //   if (textbox.value == '') {
//     //     textbox.setCustomValidity('isi dong');
//     //   }
//     //   else if(textbox.validity.typeMismatch){
//     //     textbox.setCustomValidity('number dong');
//     //   }
//     //   else {
//     //     textbox.setCustomValidity('');
//     //   }
//     //   return true;
//     // }
//   </script>

//   <form method="post" id="fom" action="tes.php">
  //     Enter your name: <br><input type="text" id="fname"><br>
  //     RE-Enter your name: <div>
    //       <input type="text" id="fname2" name="fname2" class="test" data-toggle="popover" data-placement="right" data-content="Password Tidak Sama!!!"><label id="good" for="fname2" ><i class="fa fa-check-circle"></i></label>
  //     </div>
  //     <button type="submit">klik</button>
//   </form>

//   <script>
//     $("#fname2").keyup(function(){
//       if ($("#fname2").val() != $("#fname").val()) {
//         $("#fname2").css("border-color", "red");
//         $('[data-toggle="popover"]').popover('show');
//         $("#good").css("display", "none");

//       }else{
//         $('[data-toggle="popover"]').popover('destroy');
//         $("#fname2").css("border-color", "");
//         $("#good").css("display", "inline");


//       }

//     });
//     $("#fom").submit(function(){
//       if ($("#fname2").val() != $("#fname").val()) {
//         return false;
//       }else{
//         return true;
//       }

//     });
</script>

</body>
</html>

<li>\2013</li>
<h3>A demonstration of how to access a Text Field</h3>

<input type="text" id="nama" onKeyup="myFunction()">


<p id="demo"></p>

<script>
  function myFunction() {
    var x = document.getElementById("nama").value;
    document.getElementById("demo").innerHTML = x;
  }
</script>

<script>
  function killcomma(field)
  {
   field.value = field.value.replace(' ','.');
 }
</script>
<label for="rplc">input spasi ganti dengan koma</label><br>
<input name="rplc" type ="text" onkeyup="killcomma(this)">
<form name="form1">
 <div>
  <label for="checkbox">Checkbox:</label>
  <input type="checkbox" name="one" id="checkbox" />
</div>
<div>
  <label for="checkbox">Checkbox:</label>
  <input type="checkbox" name="two" id="checkbox" />
</div>
<div>
  <label for="checkbox">Checkbox:</label>
  <input type="checkbox" name="three" id="checkbox" />
</div>
<div>
  <label for="checkbox">Checkbox:</label>
  <input type="checkbox" name="four" id="checkbox" />
</div>
<div>
  <input type="button" value="Submit" class="submitnow"/>
</div>
</form>
<script> 
  $(".submitnow").click(function(){
    var chkd = document.form1.one.checked || document.form1.two.checked|| document.form1.three.checked|| document.form1.four.checked;
    if (chkd) {
    	alert ("Well done");
    } else {
      alert ("Please check a checkbox");
      return false; //Prevent it from being submitted
    }
  });

</script>
<input onblur="checkLength(this)" id="groupidtext" type="text" style="width: 100px;" maxlength="6" />
<!-- or use event onkeyup instead if you want to check every character strike-->
<script type="text/javascript">

  function checkLength(el) {
    if (el.value.length != 6) {
      alert("length must be exactly 6 characters")
    }
  }
</script>

<form id="form_elem" action="/sdas" method="post">
 <input type="text" id="example" maxlength="10"></input>
 <!-- <span id="error_msg" style="color:red"></span> -->
 <input type="button" id="validate" value="validate"></input>
</form>
<script type="text/javascript">
  $("#validate").onKeyup(function(){
    var inputStr = $("#example").val();
    if(inputStr.length<5)
      $("#error_msg").html("enter atleast 5 chars in the input box");
    else
      $("#form_elem").submit();      
  })
</script>
<br>
<br>
<label for="test">maxleght</label>
<input id="test" type="text" maxlength="11" /><br>
<span id="error_msg" style="color:red; display: none;"><p>karaker maximal</p></span>
<script type="text/javascript">
	$("#test").on("keyup",function() {
    var maxLength = $(this).attr("maxlength");
    if(maxLength == $(this).val().length) {
    // alert("You can't write more than " + maxLength +" chacters")
    $("#error_msg").show();
  }else{
  	$("#error_msg").hide();
  }
})
</script>
<br>
<br>
<h2>untuk number max</h2>
<label for="test1">maxleght</label>
<input id="test" type="number" pattern="^\d{13}$" /><br>
<span id="error_msg" style="color:red; display: none;"><p>karaker maximal</p></span>
<script type="text/javascript">
	$("#test").on("KeyPress",function(evt) {
    var maxLength = $(this).attr("if(this.value.length==10) return false;");
    if(maxLength) {
    // alert("You can't write more than " + maxLength +" chacters")
    $("#error_msg").show();
  }else{
  	$("#error_msg").hide();
  }
})
</script>
<br><br>
<input class="required" id="myfield" type="text" maxlength="3" pattern="([0-9]|[0-9]|[0-9])" name="cvv"/><br>
<input type="number" onKeyPress="if(this.value.length==10) return false;" />
<script type="text/javascript">
  $("#myField").keyup(function() {
    $("#myField").val(this.value.match(/[0-9]*/));
  });
</script>
<form><input type="text" pattern="\d*" maxlength="4" required="">
  <button type="submit">joss</button>
  <h1 style="right: 0;top: 0
  "></h1>
  <h1>onftim passowe</h1>
</form>
<form>
  <label>password :
    <input name="password" id="password" type="password" />
  </label>
  <br>
  <label>confirm password:
    <input type="password" name="confirm_password" id="confirm_password" />
    <span id='message'></span>
  </label>
  <button type="submit">tambah</button>
</form>
<script type="text/javascript">
  $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
      $('#message').html('Matching').css('color', 'green');
    } else 
    $('#message').html('Not Matching').css('color', 'red');
  });
</script>
<br>
<br>

<form method="post">
  <input type="text" name="barcode">
</form>
<?php 

$barcode = $_POST['barcode'];
if ($barcode == "") 
{
 echo "Barcode Kosong";
}else{
  echo $barcode;
} 
?>
</body>
</html>

