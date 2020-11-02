$(($) => {
    $('form').on('submit', function(e){
        e.preventDefault();
        let form = document.forms.user_form,
            formData = new FormData(form);
        $.ajax({
            url:'/server.php',
            method:'POST',
            data:formData,
            success:function(){
                alert('Успешно');
            },
            processData: false,
            contentType: false,
        })
    })

    let inp = $('#user_file');

    inp.change(function(){
        let file_name;
        if (inp[0].files.length > 0)
        {
            file_name = inp[0].files[0].name;

        }
        else
        {
            file_name = 'Прикрепить файл;'
        }
        inp.html(file_name);
    })
})