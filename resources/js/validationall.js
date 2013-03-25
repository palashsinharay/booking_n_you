
$(document).ready(function(){
    $('form').submit(function(){

        var v_error = '1px solid #f32517';
        var v_ok = '1px solid #b8bab8';
        var validate = true;
        var retype_failed = false;

        $("form :input")
            .not(':button, :submit, :reset, :hidden, [valid="not"]')
            .each(function(){
                var value = $.trim($(this).val());
                //console.log($(this).attr('name') + '=' + value);
                if( value == ''){
                    $(this).css('border', v_error);
                    validate = false;
                } else if($(this).attr('valid') == 'alfa'){
                    var regexLetter = /^[a-zA-Z0-9._-]$/;
                   if(!regexLetter.test(value)){
                        $(this).css('border', v_error);
                        validate = false;
                    }else{
                        $(this).css('border', v_ok);
                    }
                } else if($(this).attr('valid') == 'alfanum'){
                    var regexLetter = /^[A-Za-z0-9]+$/;
                   if(!regexLetter.test(value)){
                        $(this).css('border', v_error);
                        validate = false;
                    }else{
                        $(this).css('border', v_ok);
                    }
                } else if($(this).attr('name') == 'mobile'){
                    if(isNaN(value) || value.length != 10 ){
                        $(this).css('border', v_error);
                        validate = false;
                    }else{
                        $(this).css('border', v_ok);
                    }
                } else if($(this).attr('valid') == 'num'){
                    if(isNaN(value)){
                        $(this).css('border', v_error);
                        validate = false;
                    }else{
                        $(this).css('border', v_ok);
                    }
                }else if($(this).attr('name') == 'email'){
                    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                    if(pattern.test(value)){
                        $(this).css('border', v_ok);
                    }else{
                        $(this).css('border', v_error);
                        validate = false;
                    }
                }else if($(this).attr('retypewith')){

                    var compare_val = $.trim($("#"+$(this).attr('retypewith')).val());
                    if($.trim($(this).val()) != compare_val)
                    {
                        retype_failed = true;
                    }
                }
                else{
                        $(this).css('border', v_ok);
                }

        });



        $('select').not('[valid="not"]').each(function(){
            if(!$(this).attr('disabled')){
                if($(this).val()=='-1'){
                     $(this).css('border', v_error);
                     validate = false;
                }else{
                    $(this).css('border', v_ok);

                }
            }
        });

        if(validate == false){
            $('.mandatory_txt').fadeOut(1000, function(){
                $(this).html('Please correct red marked field(s)');
                $(this).fadeIn(1000).fadeOut(1000).fadeIn(1000);

            });
        }

        if(retype_failed)
        {
            $('.mandatory_txt').fadeOut(1000, function(){
                $(this).html('New Password and Confirm Password are not same.');
                $(this).fadeIn(1000).fadeOut(1000).fadeIn(1000);
            });

            validate = false;
        }

        return validate;
    });
});
