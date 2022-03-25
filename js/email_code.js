function cap(){
    var alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'
     ,'W','X','Y','Z','1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i',
     'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '!','@','#','$','%','^','&','*','+'];
     var a = alpha[Math.floor(Math.random()*71)];
     var b = alpha[Math.floor(Math.random()*71)];
     var c = alpha[Math.floor(Math.random()*71)];
     var d = alpha[Math.floor(Math.random()*71)];
     var e = alpha[Math.floor(Math.random()*71)];
     var f = alpha[Math.floor(Math.random()*71)];

     var final = a+b+c+d+e+f;
     document.getElementById("captcha_code1").value=final;
}
$(function(){
    cap()
});
 
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function submit_form()
{
    var name1 = $('#name1').val();
    var mobile1 = $('#mobile1').val();
    var email1 = $('#email1').val();
    var movingDate1 = $('#movingDate1').val();
    var movingFrom1 = $('#movingFrom1').val();
    var movingTo1 = $('#movingTo1').val();
    var textarea1 = $('#textarea1').val();
    var captcha_code1 = $('#captcha_code1').val();
    var captcha_code2 = $('#captcha_code2').val();

    if(captcha_code2 != '')
    {
        if(captcha_code1 != captcha_code2)
        {
            alert('Please enter the correct captcha');
            return false;
        }
        else
        {
            send_email(name1, mobile1, email1, movingDate1, movingFrom1, movingTo1, textarea1);
      
            $('#name1').val('');
            $('#mobile1').val('');
            $('#email1').val('');
            $('#movingDate1').val('');
            $('#movingFrom1').val('');
            $('#movingTo1').val('');
            $('#textarea1').val('');
            $('#captcha_code2').val('');
            $('#success-msg').text('Enquiry has been sent successfully...');
            $('#myModal').modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
              });
        }
    }
}
    
function send_email(name1, mobile1, email1, movingDate1, movingFrom1, movingTo1, textarea1)
{
    $.ajax({
        url : 'email_code.php',
        type : 'POST',
        data : {full_name:name1, email:email1, mobile:mobile1, movingDate:movingDate1, movingFrom:movingFrom1, movingTo:movingTo1, textarea:textarea1},
        success : function(data){
            // alert(data)
        }
    });
}